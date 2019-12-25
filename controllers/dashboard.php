<?php
include_once '../env.php';
include_once '../includes/MysqliDb.php';
include_once '../includes/Config.php';
include_once '../includes/Common.php';


$requestType = $_GET['action'];

if($requestType == "expenses"){
	showExpensesTable();
} elseif ($requestType == "transction"){
    transction();
} elseif ($requestType == "transctionmodalbody") {
    getTransctionModalbody();
}

	
function showExpensesTable(){

	if(isset($_REQUEST['draw'])) {
    	$recordsTotal = 0;
        $draw = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $condition = "";
        $columns = ['expenses.user_id','expenses.item_price','expenses.total_price','expenses.created_at'];
        $apisearch = false;
        if(!empty($_REQUEST['search']['value'])){
            $searchValue = trim($_REQUEST['search']['value']);
            $condition = " WHERE ";
            foreach($columns as $column){
                $condition .= " $column LIKE '$searchValue%' OR ";
            }
            $condition = rtrim($condition,'OR ');
            $apisearch = true;
        }
        if(!empty($_REQUEST['columns'][4]['search']['value'])){
            $seachValue = $_REQUEST['columns'][4]['search']['value'];
            if(!empty($condition)){
                 $condition .= " AND ";
            }else {
                $condition = "WHERE ";
            }
            $today = Date('Y-m-d');
            $month = Date('Y-m');
            switch ($seachValue) {
                case 'today':
                    $condition .= "  `expenses`.`created_at` LIKE '$today%' ";
                    break;
                case 'month':
                    $condition .= "  `expenses`.`created_at` LIKE '$month%' ";
                    break;
                case 'all':
                    $condition .= "  `expenses`.`created_at` <= DATE_SUB(NOW(), INTERVAL 0 MINUTE) ";
                    break;    
            }
            $apisearch = true;

        }
        $columnNumber = 0;
        if(!empty($_REQUEST['order'][0]['dir'])){
            $orderBY = $_REQUEST['order'][0]['dir'];
            $columnNumber = $_REQUEST['order'][0]['column'];
            switch ($columnNumber) {
                case 0:
                    $condition .=" ORDER BY expenses.id $orderBY ";
                    break;
                case 1:
                    $condition .=" ORDER BY expenses.user_id $orderBY ";
                    break;
                case 4:
                    $condition .=" ORDER BY expenses.created_at $orderBY ";
                    break;    
            }
                    
            $apisearch = true;
        }   
        $condition .= " LIMIT $length OFFSET $start";
        $result = $GLOBALS['db']->rawQuery("SELECT COUNT(`expenses`.`id`) as count FROM expenses INNER JOIN users ON `expenses`.`user_id` = `users`.`id` $condition");
        $recordsTotal = $result[0]['count'];
        $recordsFiltered = $recordsTotal;
        $finalArray = [
            "draw" => intval($draw),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered
        ];
        if($recordsTotal>0) {
            $QUERY = "SELECT `expenses`.`id`,`expenses`.`user_id`,`expenses`.`item_price`,`expenses`.`total_price`,`expenses`.`created_at`,`expenses`.`updated_at`,`users`.`first_name`,`users`.`last_name` FROM expenses INNER JOIN users ON `expenses`.`user_id` = `users`.`id` $condition";
            $result = $GLOBALS['db']->rawQuery($QUERY);
            if (is_array($result)) {
                foreach ($result as $key => $item) {
                    $userName = $item['first_name'].' '.$item['last_name'] .'<small> ( Search by User Id : '.$item['user_id'].' )</small>';
                    $itemPriceTags = '';
                    $itemPriceArr = explode(',',$item['item_price']);
                    foreach ($itemPriceArr as $itemPrice):
                        $itemPriceTags .= '<span class="badge badge-info">'.$itemPrice.'</span>&nbsp;';
                    endforeach;
                    $totalPrice = $item['total_price'];
                    $createdAt = date_format(new DateTime($item['created_at']), 'Y-m-d');
                    $updatedAt = date_format(new DateTime($item['updated_at']), 'Y-m-d');
                    $action = 'action';

                $finalArray['data'][] = array( $userName, $itemPriceTags, $totalPrice, $createdAt,$updatedAt,$action);
                }
            }    
        }else {
            $finalArray['data'] = array();
        }
        echo json_encode($finalArray);
    }
}

function transction(){
    if(isset($_REQUEST['draw'])) {
        $recordsTotal = 0;
        $draw = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        //$condition = "";
        $currentMonth = Date('Y-m');
        $condition .= " LIMIT $length OFFSET $start";
        $QUERY = "SELECT COUNT(`users`.`id`) AS count FROM expenses INNER JOIN users ON `expenses`.`user_id` = `users`.`id` WHERE `expenses`.`user_id` = `users`.`id` AND `expenses`.`created_at` LIKE '$currentMonth%'  GROUP BY `expenses`.`user_id` ";
        $result = $GLOBALS['db']->rawQuery($QUERY);
        $recordsTotal = $result[0]['count'];
        $recordsFiltered = $recordsTotal;
        $finalArray = [
            "draw" => intval($draw),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered
        ];
  
        if($recordsTotal>0) {
            $QUERY = "SELECT SUM(`expenses`.`total_price`) AS total_spent,`users`.`first_name`,`users`.`last_name`,`users`.`id` FROM expenses INNER JOIN users ON `expenses`.`user_id` = `users`.`id` WHERE `expenses`.`user_id` = `users`.`id` AND `expenses`.`created_at` LIKE '$currentMonth%'  GROUP BY `expenses`.`user_id`";
            $result = $GLOBALS['db']->rawQuery($QUERY);

            $totalSpentByAll = 0;
            foreach ($result as $key => $value) {
                $totalSpentByAll += $value['total_spent'];
            }
            $totalusers = count($result);
            if (is_array($result)) {
                foreach ($result as $key => $value){
                    $average = (float)($totalSpentByAll/$totalusers);
                    $creditOrDebit = ((float)$value['total_spent'] - $average );
                    $finalArray['data'][] = [
                        $value['first_name'].' '.$value['last_name'],
                        $value['total_spent'],
                        'Total : '.$totalSpentByAll .'|| To paid : '. $totalSpentByAll/$totalusers,
                        ($creditOrDebit > 0) ?  '<span class="badge badge-success">+'.($creditOrDebit).'</span>&nbsp;' : '<span class="badge badge-danger">'.($creditOrDebit) .'</span>',
                        ($creditOrDebit > 0 ) ? '--' : '<a data-toggle="modal" data-target="#transactionModal" class="badge badge-info" data-user='.$value['id'].'><i class="fa fa-plus" aria-hidden="true"></i></a>'
                    ];    
                }
            }    
        }else {
            $finalArray['data'] = array();
        }
        echo json_encode($finalArray);
    }
}

function getTransctionModalbody(){
    // debug($_GET,1);
    $userId = $_GET['user_id'];
    $currentMonth = Date('Y-m');

    $QUERY = "SELECT SUM(`expenses`.`total_price`) AS total_spent,`users`.`first_name`,`users`.`last_name`,`users`.`id` FROM expenses INNER JOIN users ON `expenses`.`user_id` = `users`.`id` WHERE `expenses`.`user_id` = `users`.`id` AND `expenses`.`created_at` LIKE '$currentMonth%'  GROUP BY `expenses`.`user_id` ";

        $result  = $GLOBALS['db']->rawQuery($QUERY);
    if (is_array($result)) {
        $totalSpentByAll = 0;
        $payableAmount = 0;
        $totalusers = count($result);
        $average = 0.00;
        foreach ($result as $key => $value) {
            $totalSpentByAll += $value['total_spent'];
            $average = (float)($totalSpentByAll/$totalusers);
        }
        foreach ($result as $key => $value) {
            if($value['id'] == $userId){
                $payableAmount = ((float)$value['total_spent'] - $average );
            }    
        }

        $html ='<div class="row">
            <label class="form-check-label col-sm-12 col-md-12 bold">Payable Amount : <span id="payable-amount" class="badge badge-info">'.ltrim($payableAmount,'-').'</span> </label>
            </div><br>';

        foreach ($result as $key => $value){
            $creditOrDebit = ((float)$value['total_spent'] - $average );
            if($creditOrDebit > 0){
                $html .='<div class="col-md-12 col-sm-12 form-group">';
                $html .='<div class="toast toast-error hide" data-autohide="false" style="max-width: 100%;background: #ca2d22d4;color: #ffffff;">
                        <div class="toast-body" style="text-align: center !important;">
                            <span> </span>
                        </div>
                    </div>';
                $html .='<div class="row">
                            <label class="form-check-label col-sm-4 col-md-4">
                                &nbsp;<input class="form-check-input" type="checkbox" name="user_id_'.$value['id'].'" onchange="enableDisableField(this);"> '.$value['first_name'].'
                            </label>
                            <label class="badge badge-info amount-to-pay-to-each" style="line-height:2 !important;">'.$creditOrDebit.'</label>&nbsp;&nbsp;
                            <input type="number" name="amount[]" class="form-control col-sm-5 col-md-5 amount-paid" value=""; onkeyup="checkPayablePrice(this);" disabled="true" placeholder="Select user to pay">
                        </div>';
                $html .='</div>';
            }

            $finalArray['data'][] = [
                $value['first_name'].' '.$value['last_name'],
                $value['total_spent'],
                'Total : '.$totalSpentByAll .'|| To paid : '. $totalSpentByAll/$totalusers,
            ];    
        }
        http_response_code(200);
        echo json_encode($html);
    } else {
        http_response_code(422);
        echo json_encode("Some error occured. Please try later");
    } 

}            

?>
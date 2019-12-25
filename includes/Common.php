<?php
# Debugger 
function debug($message,$exit=false){
	echo "<pre>";
	print_r($message);
	echo "\n";
	if($exit){
		exit;
	}
}

# Gets row based on user id and current date
function getEntryForCurrentDate($userId){
	try {
		$currentDate = date('Y-m-d');
		$GLOBALS['db']->where('user_id',$userId);
		$GLOBALS['db']->where('created_at',$currentDate.'%','like');
		$items = $GLOBALS['db']->getOne("expenses");
		return $items;
	} catch (Exception $e) {
        return false;
    }
	       
}

function getSpentDataDetail (){
	$currentMonth = Date('Y-m');
	//try {
  		$QUERY = "SELECT SUM(`expenses`.`total_price`) AS total_spent,`users`.`first_name`,`users`.`last_name`,`users`.`id` FROM expenses INNER JOIN users ON `expenses`.`user_id` = `users`.`id` WHERE `expenses`.`user_id` = `users`.`id` AND `expenses`.`created_at` LIKE '$currentMonth%'  GROUP BY `expenses`.`user_id` ";
  		$row  = $GLOBALS['db']->rawQuery($QUERY);
  		return $row;
	// } catch (Exception $e) {
	// 	debug($e->getMessage());
 //        return false;
 //    }

}
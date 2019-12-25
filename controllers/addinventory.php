<?php
include_once '../env.php';
include_once '../includes/MysqliDb.php';
include_once '../includes/Config.php';
include_once '../includes/Common.php';

parse_str($_POST['formData'],$formData);

$itemsPrice = "";
$totalPrice = 0;
$errorMessage = "";
$flag = false;
$userId = $formData['user_id'];

if(empty($formData)){
	http_response_code(422);
	echo json_encode("You have submitted empty form");
	exit;
}
if(empty($userId)){
	http_response_code(422);
	echo json_encode("You have not selected user");
	exit;
}

foreach ($formData['item'] as $itemKey => $itemValue) {
	$itemsPrice .= $itemValue .'-'. $formData['price'][$itemKey] .",";
	$totalPrice += $formData['price'][$itemKey];
	if(!isset($formData['price'][$itemKey])){
		$flag = true;
		$errorMessage = "Price for $itemValue is not valid";
		break;
	}  

	if($itemValue == '' || $itemValue == null || $formData['price'][$itemKey] == 0){
		$flag = true;
		$errorMessage = "Item is invalid or price is 0";
		break;
	}
}
if($totalPrice != $formData['total_price']){
	$flag = true;
	$errorMessage = "Total price is not equal to sum of item prices";
}
if($flag){
	http_response_code(422);
	echo json_encode($errorMessage);
	exit;
}

try {
	# Check if user has any entry on current date
	$result = getEntryForCurrentDate($userId);
	$query = "";

	# If user has entry for current date than update row
	if(is_array($result)){
		$itemsPrice = $result['item_price'] .','. rtrim($itemsPrice,',');
		$totalPrice = $formData['total_price'] + $result['total_price'];
		
		$updateArr = [
			'item_price' => $itemsPrice,
			'total_price' => $totalPrice,
		];
		$db->where('user_id',$userId);
		$currentDate = date('Y-m-d');
		$db->where('created_at',$currentDate.'%','like');
		if($db->update('expenses',$updateArr)){
			http_response_code(200);
			echo json_encode("Data updated successfully");
			exit;
		} else {
			http_response_code(422);
			echo json_encode("Error is saving data");
			exit;
		}
	} 

	$itemsPrice = rtrim($itemsPrice,',');
	$insertArr = [
		'item_price' => $itemsPrice,
		'total_price' => $totalPrice,
		'user_id' => $userId
	];

	if($db->insert('expenses',$insertArr)){
		http_response_code(200);
		echo json_encode("Data inserted successfully");
		exit;
	}
    
} catch (Exception $e) {
	http_response_code(422);
	echo json_encode($e->getMessage());
	exit;
}


	
?>


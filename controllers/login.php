<?php
session_start();

if(isset($_SESSION['auth'])){
	header("Location:../index.php?page=dashboard");
}


include_once '../env.php';
include_once '../includes/MysqliDb.php';
include_once '../includes/Config.php';
include_once '../includes/Common.php';

$db->where('email',$_POST['email']);
$user = $db->getOne('users');
if(!is_null($user)){
	if(password_verify($_POST['password'],$user['password'])){
		$_SESSION["auth"]= $user;
		$_SESSION["success"]= "Successfully logged in.";
		unset($_SESSION['error']);
		header("Location:../index.php?page=dashboard");
	} else {
		$_SESSION["error"]= "Password is incorrect.";
		header("Location:../views/login.php");
	}
} else {
	$_SESSION["error"]= "User does not exists.";
	header("Location:../views/login.php");
}
	
?>
<?php 
	session_start(); 
  	unset($_SESSION["auth"]);
  	session_destroy();
  	$_SESSION["error"] = "Logged out. Login to continue;";
  	header("Location:../index.php");

?>
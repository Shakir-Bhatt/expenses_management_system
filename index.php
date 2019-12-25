<?php
    
    error_reporting(E_ALL);
    define('ROOT',__DIR__);
    session_start();

    if(!isset($_SESSION["auth"])){
        if(!isset($_SESSION["error"])){
            $_SESSION["error"] = "Your session has been expired. Plese login to continue.";
        }
        header("Location: views/login.php");
    }


    include_once ROOT.'/env.php';
    include_once ROOT.'/includes/MysqliDb.php';
    include_once ROOT.'/includes/Config.php';
    include_once (ROOT.'/includes/header.php');
    
    if(isset($_SESSION["auth"])){
        include_once ('includes/navbar.php');
    }
    if(isset($_GET['page'])){
        if(file_exists("views/".$_GET['page'].".php")){
            
            

            include_once ("views/".$_GET['page'].".php");
        } else {
            include_once ("views/error.php");
        } 
    } else {
        include_once ("views/home.php");
    }

    include_once ('includes/footer.php');
?>        


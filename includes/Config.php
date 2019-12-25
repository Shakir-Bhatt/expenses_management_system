<?php


// include_once("../env.php");
// include_once("../includes/MysqliDb.php");

$db = new MysqliDb(SERVERNAME, USERNAME, PASSWORD, DBNAME);
$GLOBALS['db'] = $db;







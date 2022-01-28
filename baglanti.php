<?php

error_reporting(1);

ob_start();
try {
     $db = new PDO("mysql:host=localhost;dbname=kys;charset=utf8", "root","", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";
	 $db->exec("set names utf8");
} catch ( PDOException $e ){
     print $e->getMessage();
	 
}
?>
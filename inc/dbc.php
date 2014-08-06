<?php
ob_start();
session_start();

$dsn = "mysql:host=localhost;dbname=jc-admin";
$db = new PDO($dsn, 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
?>

<?php
session_start();

//ÅÐ¶ÏÊÇ·ñµÇÂ½
if(empty($_SESSION["cai_admin"])){
    header ( 'Location: http://www.gamebaike.com/jc_admin/login.php' );
    exit;
}


ob_start();
$dsn = "mysql:host=192.168.0.180;dbname=cai_yxpopo";
$db = new PDO($dsn, 'dian_user', 'dian~2011~2011@@', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
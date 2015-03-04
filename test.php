<?php
session_start();
include '../include/ConnectMySql.php';
include 'inc/func.php';

//模拟投注
$s = (int)$_GET['s'];
$j = (int)$_GET['j'];
if(1 == $s){
    //$re = guess_result(6,2);
    //var_dump($re);
}

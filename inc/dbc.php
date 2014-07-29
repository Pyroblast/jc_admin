<?php
ob_start();
session_start();
$mysql_servername = "localhost"; //主机地址
$mysql_username = "root"; //数据库用户名
$mysql_password =""; //数据库密码
$mysql_database ="jc-admin"; //数据库
mysql_connect($mysql_servername , $mysql_username , $mysql_password);
mysql_select_db($mysql_database); 
mysql_query("set character set 'utf8'");//读库
mysql_query("set names 'utf8'");//写库

if(mysqli_connect_errno())
{
echo "连接数据库失败";
exit;
}
?>

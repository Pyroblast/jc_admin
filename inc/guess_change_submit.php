<?php
include("dbc.php");
$id = $_SESSION['id'];
$result=$_POST['result'];
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">


    <title>比赛结果更改</title>

    <link href="/jc-admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="/jc-admin/css/alert.css" rel="stylesheet">

  </head>

  <body>
	<div class="container" style="width:600px">
		<?php
		if ($id) {
			$sql = "update guess set result = '$result' where guess_id = '$id'";
			mysql_query($sql);
			echo "<div class='alert alert-success'>更改成功！</div>";
		}else{
			echo "<div class='alert alert-danger'>更改失败...</div>";
		}
		?>
    </div>
  </body>
</html>

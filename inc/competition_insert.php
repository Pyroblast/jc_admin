<?php
include("dbc.php");

	$game_name=$_POST['game_name'];
	$competition_name=$_POST['competition_name'];
	$competition_time=$_POST['competition_time'];
	$information=$_POST['information'];

	$rs = $db->query("select game_id from game where game_name = '$game_name'");
	$row = $rs->fetch();
	$game_id = $row[0];

?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">


    <title>赛事信息添加</title>

    <link href="/jc_admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="/jc_admin/css/alert.css" rel="stylesheet">

  </head>

  <body>
	<div class="container" style="width:600px">
<?php
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 100000))
	  {
	  if ($_FILES["file"]["error"] > 0)
	    {
	    header("refresh:2;url=/jc_admin/insert/competition_insert.html");
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	    }
	  else
	    {
	    if (file_exists("../competition_logo/" . $_FILES["file"]["name"]))
	      {
	      header("refresh:2;url=/jc_admin/insert/competition_insert.html");
	      echo $_FILES["file"]["name"] . " 已存在。 ";
	      }
	    else
	      {

	      move_uploaded_file($_FILES["file"]["tmp_name"],"../competition_logo/" . $_FILES["file"]["name"]);
	      $competition_logo_url = "/jc_admin/competition_logo/" . $_FILES["file"]["name"];
			if ($game_id && $competition_name && $competition_time && $information && $competition_logo_url){
			
				$sql="SELECT * FROM competition WHERE game_id = '$game_id' and competition_name = '$competition_name'";
				$rs = $db->query($sql);
				$rows = $rs->fetch();

					if($rows){
								echo "	<!DOCTYPE html>
									  	<html>
										<head>
										<meta charset='utf-8'>
										<title>赛事信息添加</title>
										</head><script language='javascript'>alert('该赛事已存在');history.back();</script>
										</html>";
								exit;
							 }
				$sql="insert into competition(game_id,competition_name,competition_time,information,competition_logo_url) values('$game_id','$competition_name','$competition_time','$information','$competition_logo_url')"; 
				$res = $db->exec($sql);
					if($res == 1){

						header("refresh:2;url=/jc_admin/insert/competition_insert.html");
						echo "<div class='alert alert-success'>添加成功！2秒后自动返回</div>";

					}else{
						header("refresh:2;url=/jc_admin/insert/competition_insert.html");
						echo "<div class='alert alert-danger'>添加失败...2秒后自动返回</div>";

					}
				}
			else 
			{
				echo "			<!DOCTYPE html>
							  	<html>
								<head>
								<meta charset='utf-8'>
								<title>赛事信息添加</title>
								</head><script language='javascript'>alert('信息不完整');history.back();</script>
								</html>";
			}
		}
	  }
	}
else
  {
	header("refresh:2;url=/jc_admin/insert/team_insert.html");
	echo "<div class='alert alert-danger'>添加失败...2秒后自动返回</div>"; 
	}
		?>
    </div>
  </body>
</html>
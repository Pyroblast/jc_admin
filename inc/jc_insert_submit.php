<?php
include("dbc.php");
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">


    <title>竞猜信息添加</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/alert.css" rel="stylesheet">

  </head>

  <body>
	<div class="container" style="width:600px">
<?php

	$game_name=$_POST['game_name'];
	$competition_name=$_POST['competition_name'];
	$state=$_POST['state'];
	$home_team_name=$_POST['home_team_name'];
	$guest_team_name=$_POST['guest_team_name'];
	$start_time=$_POST['start_time'];
	$end_time=$_POST['end_time'];
	$match_time=$_POST['match_time'];
	$win_odds=$_POST['win_odds'];
	$lose_odds=$_POST['lose_odds'];
	$draw_odds=$_POST['draw_odds'];
	$create_time=date("Y-m-d H:i:s");
	$update_time=date("Y-m-d H:i:s");

	$game_id_result = $db->query("select * from game where game_name = '$game_name'");
	$rs1 = $game_id_result->fetch();
	$game_id = $rs1[0];

	$competition_id_result = $db->query("select * from competition where competition_name = '$competition_name' and game_id = '$game_id'");
	$rs2 = $competition_id_result->fetch();
	$competition_id = $rs2[0];

	$home_team_id_result = $db->query("select * from team where team_name = '$home_team_name' and game_id = '$game_id'");
	$rs3 = $home_team_id_result->fetch();
	$home_team_id = $rs3[0];

	$guest_team_id_result = $db->query("select * from team where team_name = '$guest_team_name' and game_id = '$game_id'");
	$rs4 = $guest_team_id_result->fetch();
	$guest_team_id = $rs4[0];

	if ($game_id && $competition_id && $home_team_id && $guest_team_id && $start_time && $end_time && $match_time && $win_odds && $lose_odds && isset($draw_odds) && $create_time && $update_time){
	
		$sql="insert into guess(game_id,competition_id,state,home_team_id,guest_team_id,start_time,end_time,match_time,win_odds,lose_odds,draw_odds,create_time,update_time) values('$game_id','$competition_id','$state','$home_team_id','$guest_team_id','$start_time','$end_time','$match_time','$win_odds','$lose_odds','$draw_odds','$create_time','$update_time')"; 
		$res = $db->exec($sql);
			if($res == 1){

				header("refresh:2;url=/jc_admin/insert/jc_insert.php");
				echo "<div class='alert alert-success'>添加成功！2秒后自动返回</div>";

			}else{
				header("refresh:2;url=/jc_admin/insert/jc_insert.php");
				echo "<div class='alert alert-danger'>添加失败...2秒后自动返回</div>";

				}
			}
			else
			{
				echo "			<!DOCTYPE html>
							  	<html>
								<head>
								<meta charset='utf-8'>
								<title>竞猜信息添加</title>
								</head><script language='javascript'>alert('信息不完整');history.back();</script>
								</html>";
			}
		?>
    </div>
  </body>
</html>

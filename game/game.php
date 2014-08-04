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
$page=$_GET['page'];  

$game_id = $_GET['game_id'];
$game = mysql_query("select * from game where game_id = '$game_id'");
$row = mysql_fetch_row($game);
$game_name = $row[1];
$information = $row[2];
$image_url = $row[3];

?>
<!DOCTYPE html>
<html  lang="zh-cn">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">

    <title>电竞·竞猜-管理员服务</title>

    <!-- Bootstrap core CSS -->
    <link href="/jc-admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/jc-admin/css/dashboard.css" rel="stylesheet">
    <link href="/jc-admin/css/icon.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">电竞·竞猜</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/jc-admin/insert/jc_insert.php">添加竞猜</a></li>
            <li><a href="/jc-admin/insert/competition_insert.html">添加赛事</a></li>
            <li><a href="/jc-admin/insert/team_insert.html">添加战队</a></li>
            <li><a href="">添加游戏</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="/jc-admin/index.php">ALL</a></li>
            <li
            <?php
              if ($game_id == 1){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc-admin/game/game.php?game_id=1">英雄联盟</a></li>
            <li
            <?php
              if ($game_id == 2){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc-admin/game/game.php?game_id=2">DOTA2</a></li>
            <li
            <?php
              if ($game_id == 3){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc-admin/game/game.php?game_id=3">炉石传说</a></li>
            <li
            <?php
              if ($game_id == 4){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc-admin/game/game.php?game_id=4">星际争霸2</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="well">
	  <div class="media">
      <a href="" class="pull-left">
        <img src="
        <?php 
          echo $image_url;
        ?>" class="img-rounded icon-150">
      </a>
      <div class="media-body">
        <h4>
          <?php
            echo $game_name;
          ?>
        </h4>
        <p>
          <?php
            echo $information;
          ?>
        </p>
    <button type="button" class="btn btn-primary" onclick="window.open('/jc-admin/insert/jc_insert.php?game_id=<?php echo $game_id;?>')">添加竞猜</button>
    <button type="button" class="btn btn-success" onclick="location.href='/jc-admin/game/game.php?game_id=<?php echo $game_id;?>&type=1'">查看竞猜</button>
    <button type="button" class="btn btn-warning" onclick="location.href='/jc-admin/game/game.php?game_id=<?php echo $game_id;?>&type=2'">查看赛事</button>
    <button type="button" class="btn btn-info" onclick="location.href='/jc-admin/game/game.php?game_id=<?php echo $game_id;?>&type=3'">查看队伍</button>
      </div>
    </div>
	</div>
<?php
  $type = $_GET['type'];
  switch ($type) {
    case '1':
      echo "
        <div class='table-responsive'>
          <div class='panel panel-default'>
            <div class='panel-heading'>" . $game_name . "竞猜信息</div>
              <table class='table table-hover table-bordered'>
                    <thead>
                      <tr>
                          <th>赛事名称</th>
                          <th>开始下注时间</th>
                          <th>截止下注时间</th>
                          <th>主队</th>
                          <th>客队</th>
                          <th>胜赔率</th>
                          <th>负赔率</th>
                          <th>平赔率</th>
                          <th>主队下注人数</th>
                          <th>客队下注人数</th>                        
                          <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>";
              $sql="select * from guess"; 
              $pagesize=8;  
              $result=mysql_query($sql); 
              $row=mysql_fetch_row($result); 
              $rows=mysql_num_rows($result); 
              
              if($rows%$pagesize==0)  
                $total=(int)($rows/$pagesize); 
              else   
                $total=(int)($rows/$pagesize)+1; 
              
              if(isset($_GET['page'])) 
                $page=(int)($_GET['page']); 
              else  
                $page=1;
              
              $start=($page-1)*$pagesize;  
              $sql="SELECT guess.game_id,competition.competition_name,guess.start_time,guess.end_time,team.team_name,guess.guest_team_id,guess.win_odds,guess.lose_odds,guess.draw_odds,guess.home_number,guess.guest_number FROM guess,competition,team WHERE guess.game_id = '$game_id' and competition.competition_id = guess.competition_id and team.team_id = guess.home_team_id limit $start,$pagesize "; 
              $result=mysql_query($sql);  
              $row=mysql_fetch_row($result); 
              
              while($row){ 
                  $guest_team_name = mysql_query("select team_name from team where team_id = '$row[5]' and game_id = '$row[0]'") ;
                  $row_2 = mysql_fetch_row($guest_team_name);
                  $guest_team_name = $row_2[0];
                  echo 
                      "
                      <tr>
                      <td>$row[1]</td>
                      <td>$row[2]</td>  
                      <td>$row[3]</td>  
                      <td>$row[4]</td>  
                      <td>$guest_team_name</td>  
                      <td>$row[6]</td>  
                      <td>$row[7]</td>  
                      <td>$row[8]</td>  
                      <td>$row[9]</td>  
                      <td>$row[10]</td>  
                      <td><a href='' class='btn btn-danger' role='button'>删除</a></td>
                      </tr>
                      "; 
                  $row=mysql_fetch_row($result); 
                    }  
              echo "
              </tbody>
              </table>
              </div>
              </div>

              <div style='text-align:center'>
              <ul class='pagination'>
              <li><a href=game.php?game_id=$game_id&type=1&page=1>&laquo;</a></li>

              ";
              if($page==1){
                echo "<li><a href='#'>$page</a></li>";
                }
              if($page>1){  
                $prev=$page-1;
                echo "<li><a href=game.php?game_id=$game_id&type=1&page=$prev>前一页</a></li>
                      <li><a href='#'>$page</a></li>";
                      } 
              if($page<$total){ 
                $next=$page+1; 
                echo "<li><a href=game.php?game_id=$game_id&type=1&page=$next>下一页</a></li>
                      <li><a href=game.php?game_id=$game_id&type=1&page=$total>&raquo;</a></li>
                      </ul>
                      </div>";
                    }
      break;
    case '2':
      echo "
        <div class='table-responsive'>
          <div class='panel panel-default'>
            <div class='panel-heading'>" . $game_name . "赛事信息</div>
              <table class='table table-hover table-bordered'>
                    <thead>
                      <tr>
                          <th>赛事名称</th>
                          <th>比赛时间</th>
                          <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>";
              $sql="select * from competition"; 
              $pagesize=8;  
              $result=mysql_query($sql); 
              $row=mysql_fetch_row($result); 
              $rows=mysql_num_rows($result); 
              
              if($rows%$pagesize==0)  
                $total=(int)($rows/$pagesize); 
              else   
                $total=(int)($rows/$pagesize)+1; 
              
              if(isset($_GET['page'])) 
                $page=(int)($_GET['page']); 
              else  
                $page=1;
              
              $start=($page-1)*$pagesize;  
              $sql="SELECT * FROM competition WHERE game_id = '$game_id' limit $start,$pagesize "; 
              $result=mysql_query($sql);  
              $row=mysql_fetch_row($result); 
              
              while($row){ 
                  echo 
                      "
                      <tr>
                      <td>$row[2]</td>  
                      <td>$row[3]</td>  
                      <td><a href='' class='btn btn-danger' role='button'>删除</a></td>
                      </tr>
                      "; 
                  $row=mysql_fetch_row($result); 
                    }  
              echo "
              </tbody>
              </table>
              </div>
              </div>

              <div style='text-align:center'>
              <ul class='pagination'>
              <li><a href=game.php?game_id=$game_id&type=2&page=1>&laquo;</a></li>

              ";
              if($page==1){
                echo "<li><a href='#'>$page</a></li>";
                }
              if($page>1){  
                $prev=$page-1;
                echo "<li><a href=game.php?game_id=$game_id&type=2&page=$prev>前一页</a></li>
                      <li><a href='#'>$page</a></li>";
                      } 
              if($page<$total){ 
                $next=$page+1; 
                echo "<li><a href=game.php?game_id=$game_id&type=2&page=$next>下一页</a></li>
                      <li><a href=game.php?game_id=$game_id&type=2&page=$total>&raquo;</a></li>
                      </ul>
                      </div>";
                    }      
      break;
    case '3':
      echo "
        <div class='table-responsive'>
          <div class='panel panel-default'>
            <div class='panel-heading'>" . $game_name . "队伍信息</div>
              <table class='table table-hover table-bordered'>
                    <thead>
                      <tr>
                          <th>队伍名称</th>
                          <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>";
              $sql="select * from team"; 
              $pagesize=8;  
              $result=mysql_query($sql); 
              $row=mysql_fetch_row($result); 
              $rows=mysql_num_rows($result); 
              
              if($rows%$pagesize==0)  
                $total=(int)($rows/$pagesize); 
              else   
                $total=(int)($rows/$pagesize)+1; 
              
              if(isset($_GET['page'])) 
                $page=(int)($_GET['page']); 
              else  
                $page=1;
              
              $start=($page-1)*$pagesize;  
              $sql="SELECT * FROM team WHERE game_id = '$game_id' limit $start,$pagesize "; 
              $result=mysql_query($sql);  
              $row=mysql_fetch_row($result); 
              
              while($row){ 
                  echo 
                      "
                      <tr>
                      <td>$row[2]</td>  
                      <td><a href='' class='btn btn-danger' role='button'>删除</a></td>
                      </tr>
                      "; 
                  $row=mysql_fetch_row($result); 
                    }  
              echo "
              </tbody>
              </table>
              </div>
              </div>

              <div style='text-align:center'>
              <ul class='pagination'>
              <li><a href=game.php?game_id=$game_id&type=3&page=1>&laquo;</a></li>

              ";
              if($page==1){
                echo "<li><a href='#'>$page</a></li>";
                }
              if($page>1){  
                $prev=$page-1;
                echo "<li><a href=game.php?game_id=$game_id&type=3&page=$prev>前一页</a></li>
                      <li><a href='#'>$page</a></li>";
                      } 
              if($page<$total){ 
                $next=$page+1; 
                echo "<li><a href=game.php?game_id=$game_id&type=3&page=$next>下一页</a></li>
                      <li><a href=game.php?game_id=$game_id&type=3&page=$total>&raquo;</a></li>
                      </ul>
                      </div>";
                    }      break;
    default:
      # code...
      break;
  }

?>
      </div>
    </div> 
</body>
</html>
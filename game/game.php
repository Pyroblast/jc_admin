<?php
include("../inc/dbc.php");
$page=$_GET['page'];  

$game_id = $_GET['game_id'];
$sql = "select * from game where game_id = '$game_id'";
$rs = $db->query($sql);
$row = $rs->fetch();
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
    <link href="/jc_admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/jc_admin/css/dashboard.css" rel="stylesheet">
    <link href="/jc_admin/css/icon.css" rel="stylesheet">

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
            <li><a href="/jc_admin/insert/jc_insert.php">添加竞猜</a></li>
            <li><a href="/jc_admin/insert/competition_insert.html">添加赛事</a></li>
            <li><a href="/jc_admin/insert/team_insert.html">添加战队</a></li>
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
            <li><a href="/jc_admin/index.php">ALL</a></li>
            <li
            <?php
              if ($game_id == 1){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc_admin/game/game.php?game_id=1">英雄联盟</a></li>
            <li
            <?php
              if ($game_id == 2){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc_admin/game/game.php?game_id=2">DOTA2</a></li>
            <li
            <?php
              if ($game_id == 3){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc_admin/game/game.php?game_id=3">炉石传说</a></li>
            <li
            <?php
              if ($game_id == 4){
                echo "class='active'";
              }   
            ?>
            ><a href="/jc_admin/game/game.php?game_id=4">星际争霸2</a></li>
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
    <button type="button" class="btn btn-primary" onclick="window.open('/jc_admin/insert/jc_insert.php?game_id=<?php echo $game_id;?>')">添加竞猜</button>
    <button type="button" class="btn btn-success" onclick="location.href='/jc_admin/game/game.php?game_id=<?php echo $game_id;?>&type=1'">查看竞猜</button>
    <button type="button" class="btn btn-warning" onclick="location.href='/jc_admin/game/game.php?game_id=<?php echo $game_id;?>&type=2'">查看赛事</button>
    <button type="button" class="btn btn-info" onclick="location.href='/jc_admin/game/game.php?game_id=<?php echo $game_id;?>&type=3'">查看队伍</button>
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
                          <th>结果</th>                        
                          <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>";
              $rs=$db->query("select * from guess where game_id = '$game_id'")->fetchAll();
              $rows = count($rs);
              $pagesize=8;  
              
              if($rows%$pagesize==0)  
                $total=(int)($rows/$pagesize); 
              else   
                $total=(int)($rows/$pagesize)+1; 
              
              if(isset($_GET['page'])) 
                $page=(int)($_GET['page']); 
              else  
                $page=1;
              
              $start=($page-1)*$pagesize;  
              $sql="SELECT guess.guess_id,guess.game_id,competition.competition_name,guess.start_time,guess.end_time,team.team_name,guess.guest_team_id,guess.win_odds,guess.lose_odds,guess.draw_odds,guess.home_number,guess.guest_number,guess.result FROM guess,competition,team WHERE guess.game_id = '$game_id' and competition.competition_id = guess.competition_id and team.team_id = guess.home_team_id limit $start,$pagesize "; 
              $rs = $db->query($sql);
              
              while($row = $rs->fetch()){ 
                  $rs1 = $db->query("select team_name from team where team_id = '$row[6]' and game_id = '$row[1]'") ;
                  $row_2 = $rs1->fetch();
                  $guest_team_name = $row_2[0];
                  echo 
                      "
                      <tr>
                      <td>$row[2]</td>
                      <td>$row[3]</td>  
                      <td>$row[4]</td>  
                      <td>$row[5]</td>  
                      <td>$guest_team_name</td>  
                      <td>$row[7]</td>  
                      <td>$row[8]</td>  
                      <td>$row[9]</td>  
                      <td>$row[10]</td>  
                      <td>$row[11]</td>
                      <td>$row[12]</td>  
                      <td><a href=/jc_admin/inc/delete.php?table=guess&id=$row[0] target='_black' class='btn btn-danger' role='button'>删</a>
                          <a href=/jc_admin/change/guess_change.php?table=guess&id=$row[0] target='_black' class='btn btn-primary' role='button'>改</a></td>
                      </tr>
                      "; 
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
              $rs=$db->query("select * from competition where game_id = '$game_id'")->fetchAll();
              $rows = count($rs);
              $pagesize=8;  
              
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
              $rs = $db->query($sql);
              
              while($row = $rs->fetch()){ 
                  echo 
                      "
                      <tr>
                      <td>$row[2]</td>  
                      <td>$row[3]</td>  
                      <td><a href=/jc_admin/inc/delete.php?table=competition&id=$row[0] class='btn btn-danger' role='button'>删除</a></td>
                      </tr>
                      "; 
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
              $rs=$db->query("select * from team where game_id = '$game_id'")->fetchAll();
              $rows = count($rs);
              $pagesize=8;  
              
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
              $rs = $db->query($sql); 
              
              while($row = $rs->fetch()){ 
                  echo 
                      "
                      <tr>
                      <td>$row[2]</td>  
                      <td><a href=/jc_admin/inc/delete.php?table=team&id=$row[0] class='btn btn-danger' role='button'>删除</a></td>
                      </tr>
                      "; 
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
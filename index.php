<?php
$page=$_GET['page'];  
include("/inc/dbc.php");
?>
<!DOCTYPE html>
<html  lang="zh-cn">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">

    <title>电竞·竞猜-管理员服务</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/icon.css" rel="stylesheet">

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
            <li><a href="insert/jc_insert.php">添加竞猜</a></li>
            <li><a href="insert/competition_insert.html">添加赛事</a></li>
            <li><a href="insert/team_insert.html">添加战队</a></li>
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
            <li class="active"><a href="index.php">ALL</a></li>
            <li><a href="game/game.php?game_id=1">英雄联盟</a></li>
            <li><a href="game/game.php?game_id=2">DOTA2</a></li>
            <li><a href="game/game.php?game_id=3">炉石传说</a></li>
            <li><a href="game/game.php?game_id=4">星际争霸2</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="well">
            <div class="btn-group btn-group-justified">
              <a href="index.php?type=1" class="btn btn-primary" role="button">查看所有竞猜</a>
              <a href="index.php?type=2" class="btn btn-success" role="button">查看所有赛事</a>
              <a href="index.php?type=3" class="btn btn-warning" role="button">查看所有队伍</a>
              <a href="index.php" class="btn btn-info" role="button">查看所有游戏</a>
            </div>
          </div>

          <?php
          $type = $_GET['type'];

          switch ($type) {
            case '1':
              echo "
                <div class='panel panel-default'>
                  <div class='panel-heading'>所有竞猜信息</div>
                    <table class='table table-hover table-bordered'>
                      <thead>
                        <tr>
                        <th>游戏名称</th>
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
                      <tbody>
                      ";
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
              $sql="SELECT guess.guess_id,game.game_name,competition.competition_name,guess.start_time,guess.end_time,team.team_name,guess.guest_team_id,guess.win_odds,guess.lose_odds,guess.draw_odds,guess.home_number,guess.guest_number,guess.result FROM guess,game,competition,team WHERE game.game_id = guess.game_id and competition.competition_id = guess.competition_id and team.team_id = guess.home_team_id limit $start,$pagesize "; 
              $result=mysql_query($sql);  
              $row=mysql_fetch_row($result); 
              
              while($row){ 
                  $game_id = mysql_query("select game_id from game where game_name = '$row[1]'");
                  $row_2 = mysql_fetch_row($game_id);
                  $game_id = $row_2[0];
                  $guest_team_name = mysql_query("select team_name from team where team_id = '$row[6]' and game_id = '$row_2[0]'") ;
                  $row_3 = mysql_fetch_row($guest_team_name);
                  $guest_team_name = $row_3[0];
                  echo 
                      "
                      <tr>
                      <td>$row[1]</td>
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
                      <td><a href=/jc-admin/inc/delete.php?table=guess&id=$row[0] target='_black' class='btn btn-danger' role='button'>删</a>
                          <a href=/jc-admin/change/guess_change.php?table=guess&id=$row[0] target='_black' class='btn btn-primary' role='button'>改</a></td>
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
              <li><a href=index.php?type=1&page=1>&laquo;</a></li>

              ";
              if($page==1){
                echo "<li><a href='#'>$page</a></li>";
                }
              if($page>1){  
                $prev=$page-1;
                echo "<li><a href=index.php?type=1&page=$prev>前一页</a></li>
                      <li><a href='#'>$page</a></li>";
                      } 
              if($page<$total){ 
                $next=$page+1; 
                echo "<li><a href=index.php?type=1&page=$next>下一页</a></li>
                      <li><a href=index.php?type=1&page=$total>&raquo;</a></li>
                      </ul>
                      </div>";
                    }


              break;
            
            case '2':
              echo "
                <div class='panel panel-default'>
                  <div class='panel-heading'>所有赛事信息</div>
                    <table class='table table-hover table-bordered'>
                      <thead>
                        <tr>
                        <th>游戏名称</th>
                        <th>赛事名称</th>
                        <th>比赛时间</th>
                        <th>操作</th>
                        </tr>
                      </thead>
                      <tbody>
                      ";
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
              $sql="SELECT competition.competition_id,game.game_name,competition.competition_name,competition.competition_time FROM game,competition WHERE game.game_id = competition.game_id limit $start,$pagesize "; 
              $result=mysql_query($sql);  
              $row=mysql_fetch_row($result); 
              
              while($row){  
                  echo 
                      "
                      <tr>
                      <td>$row[1]</a></td>
                      <td>$row[2]</td>
                      <td>$row[3]</td>  
                      <td><a href=/jc-admin/inc/delete.php?table=competition&id=$row[0] class='btn btn-danger' role='button'>删除</a></td>
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
              <li><a href=index.php?type=2&page=1>&laquo;</a></li>

              ";
              if($page==1){
                echo "<li><a href='#'>$page</a></li>";
                }
              if($page>1){  
                $prev=$page-1;
                echo "<li><a href=index.php?type=2&page=$prev>前一页</a></li>
                      <li><a href='#'>$page</a></li>";
                      } 
              if($page<$total){ 
                $next=$page+1; 
                echo "<li><a href=index.php?type=2&page=$next>下一页</a></li>
                      <li><a href=index.php?type=2&page=$total>&raquo;</a></li>
                      </ul>
                      </div>";
                    }
              break;

            case '3':
              echo "
                <div class='panel panel-default'>
                  <div class='panel-heading'>所有队伍信息</div>
                    <table class='table table-hover table-bordered'>
                      <thead>
                        <tr>
                        <th>游戏名称</th>
                        <th>队伍名称</th>
                        <th>操作</th>
                        </tr>
                      </thead>
                      <tbody>
                      ";
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
              $sql="SELECT team.team_id,game.game_name,team.team_name FROM game,team WHERE game.game_id = team.game_id limit $start,$pagesize "; 
              $result=mysql_query($sql);  
              $row=mysql_fetch_row($result); 
              
              while($row){  
                  echo 
                      "
                      <tr>
                      <td>$row[1]</a></td>
                      <td>$row[2]</td>
                      <td><a href=/jc-admin/inc/delete.php?table=team&id=$row[0] class='btn btn-danger' role='button'>删除</a></td>
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
              <li><a href=index.php?type=3&page=1>&laquo;</a></li>

              ";
              if($page==1){
                echo "<li><a href='#'>$page</a></li>";
                }
              if($page>1){  
                $prev=$page-1;
                echo "<li><a href=index.php?type=3&page=$prev>前一页</a></li>
                      <li><a href='#'>$page</a></li>";
                      } 
              if($page<$total){ 
                $next=$page+1; 
                echo "<li><a href=index.php?type=3&page=$next>下一页</a></li>
                      <li><a href=index.php?type=3&page=$total>&raquo;</a></li>
                      </ul>
                      </div>";
                    }
              break;

            default:
              echo "
            <div class='well'>
              <div class='row placeholders'>
                <div class='col-xs-6 col-sm-3 placeholder'>
                  <a href='game/game.php?game_id=1.php'>
                    <img src='image/lol.jpg' class='img-responsive icon-150 img-rounded' >
                    <h4>英雄联盟</h4>
                  </a>
                  <span class='text-muted'>Something else</span>
                </div>
                <div class='col-xs-6 col-sm-3 placeholder'>
                  <a href='game/game.php?game_id=2.php'>
                    <img src='image/dota2.png' class='img-responsive icon-150 img-rounded'>
                    <h4>DOTA2</h4>
                  </a>
                  <span class='text-muted'>Something else</span>
                </div>
                <div class='col-xs-6 col-sm-3 placeholder'>
                  <a href='game/game.php?game_id=3.php'>
                    <img src='image/hs.jpg' class='img-responsive icon-150 img-rounded'>
                    <h4>炉石传说</h4>
                  </a>
                  <span class='text-muted'>Something else</span>
                </div>
                <div class='col-xs-6 col-sm-3 placeholder'>
                  <a href='game/game.php?game_id=4.php'>
                    <img src='image/sc2.jpg' class='img-responsive icon-150 img-rounded'>
                    <h4>星际争霸2</h4>
                  </a>
                  <span class='text-muted'>Something else</span>
                </div>
              </div>
            </div>";
              break;
          }

          ?>
        </div>
        </div>
      </div>
</body>
</html>
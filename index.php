<?php
$page=$_GET['page'];  
include("inc/dbc.php");
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
              $rs=$db->query("select * from guess")->fetchAll();
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
              $sql="SELECT * FROM guess limit $start,$pagesize "; 
              $rs = $db->query($sql);

              while($row = $rs->fetch()){ 
                  $rs1 = $db->query("select * from game where game_id = '$row[1]'");
                  $result_arr1 = $rs1->fetch();
                  $game_name = $result_arr1[1];

                  $rs2 = $db->query("select * from competition where competition_id = '$row[2]'");
                  $result_arr2 = $rs2->fetch();
                  $competition_name = $result_arr2[2];

                  $rs3 = $db->query("select * from team where team_id = '$row[8]'") ;
                  $result_arr3 = $rs3->fetch();
                  $home_team_name = $result_arr3[2];

                  $rs4 = $db->query("select * from team where team_id = '$row[9]'") ;
                  $result_arr4 = $rs4->fetch();
                  $guest_team_name = $result_arr4[2];
                  echo 
                      "
                      <tr>
                      <td>$game_name</td>
                      <td>$competition_name</td>
                      <td>$row[start_time]</td>  
                      <td>$row[end_time]</td>  
                      <td>$home_team_name</td>  
                      <td>$guest_team_name</td>  
                      <td>$row[win_odds]</td>  
                      <td>$row[lose_odds]</td>  
                      <td>$row[draw_odds]</td>  
                      <td>$row[home_number]</td>  
                      <td>$row[guest_number]</td>
                      <td>$row[result]</td>  
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
              $rs=$db->query("select * from competition")->fetchAll();
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
              $sql="SELECT * FROM competition limit $start,$pagesize "; 
              $rs = $db->query($sql); 
              
              while($row = $rs->fetch()){  
                  $rs1 = $db->query("select * from game where game_id = '$row[1]'");
                  $result_arr1 = $rs1->fetch();
                  $game_name = $result_arr1[1];

                  echo 
                      "
                      <tr>
                      <td>$game_name</td>
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
              $rs=$db->query("select * from team")->fetchAll();
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
              $sql="SELECT * FROM team limit $start,$pagesize "; 
              $rs = $db->query($sql); 
              
              while($row = $rs->fetch()){  
                  $rs1 = $db->query("select * from game where game_id = '$row[1]'");
                  $result_arr1 = $rs1->fetch();
                  $game_name = $result_arr1[1];

                  echo 
                      "
                      <tr>
                      <td>$game_name</td>
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
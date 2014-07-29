<!DOCTYPE html>
<html  lang="zh-cn">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">

    <title>竞猜-管理员服务</title>

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
          <a class="navbar-brand" href="">竞猜</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="competition_insert.html">添加赛事</a></li>
            <li><a href="team_insert.html">添加战队</a></li>
            <li><a href="">添加玩法</a></li>
            <li><a href="">Help</a></li>
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
            <li><a href="lol.php">英雄联盟</a></li>
            <li><a href="spread3.html">DOTA2</a></li>
            <li><a href="spread4.html">炉石传说</a></li>
            <li><a href="spread4.html">星际争霸2</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="well">
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <a href="lol.php">
              <img src="image/lol.jpg" class="img-responsive icon-150 img-rounded" >
              <h4>英雄联盟</h4>
              </a>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <a href="dota2.php">
              <img src="image/dota2.png" class="img-responsive icon-150 img-rounded">
              <h4>DOTA2</h4>
              </a>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <a href="hs.php">
              <img src="image/hs.jpg" class="img-responsive icon-150 img-rounded">
              <h4>炉石传说</h4>
              </a>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <a href="sc2.php">
              <img src="image/sc2.jpg" class="img-responsive icon-150 img-rounded">
              <h4>星际争霸2</h4>
              </a>
              <span class="text-muted">Something else</span>
            </div>
          </div>
          </div>

        </div>
        </div>
      </div>
</body>
</html>
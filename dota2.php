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
            <li><a href="jc_insert.php">添加竞猜</a></li>
            <li><a href="game_insert.html">添加游戏</a></li>
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
            <li><a href="index.php">ALL</a></li>
            <li><a href="lol.php">英雄联盟</a></li>
            <li class="active"><a href="dota2.php">DOTA2</a></li>
            <li><a href="hs.php">炉石传说</a></li>
            <li><a href="sc2.php">星际争霸2</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="well">
	  <div class="media">
      <a href="" class="pull-left">
        <img src="image/dota2.png" class="img-rounded icon-150">
      </a>
      <div class="media-body">
        <h4>DOTA2</h4>
        <p>DOTA2脱离了War3的引擎，由美国Valve公司研发运营，完美世界代理（国服），韩国NEXON代理（韩服），并由DotA的地图核心制作者IceFrog（冰蛙）联手Valve开发的多人联机即时战略游戏。DOTA2整个游戏将会保持原有风格不变，DotA中的100多位英雄正在逐步的移植到DOTA2中。从某种程度上来说，DOTA2是现有DOTA的新引擎版。完美正式宣布DOTA2于2013年4月28日开始测试， 已发布中文名“刀塔”。</p>
		<button type="button" class="btn btn-primary" onclick="">添加竞猜</button>
      </div>
    </div>
	</div>

  <div class="table-responsive">
		<div class="panel panel-default">
			<div class="panel-heading">竞猜信息</div>
				<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>赛事名称</th>
                  <th>时间</th>
                  <th>状态</th>
                  <th>主队</th>
                  <th>客队</th>
                  <th>胜赔率</th>
                  <th>负赔率</th>
                  <th>平赔率</th>
                  <th>主队下注数</th>
                  <th>客队下注数</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>/</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
                </tr>
                <tr>
                  <td>/</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
                </tr>
                <tr>
                  <td>/</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
                </tr>
                <tr>
                  <td>/</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div> 
</body>
</html>
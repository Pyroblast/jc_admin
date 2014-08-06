<?php
include("dbc.php");
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
  <link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">


    <title>删除信息</title>

    <link href="/jc_admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="/jc_admin/css/alert.css" rel="stylesheet">

  </head>


  <body>
	<div class="container" style="width:600px">

		<?php
    $table = $_GET['table'];
    $id = $_GET['id'];

		  switch ($table) {
        case 'competition':
        $sql = "delete from competition where competition_id = '$id'";
        $res = $db->exec($sql);
        if ($res == 1){
        header("refresh:2;url=/jc_admin/index.php");
        echo "<div class='alert alert-success'>删除成功！2秒后返回首页</div>";            
        } else {
        header("refresh:2;url=/jc_admin/index.php");
        echo "<div class='alert alert-danger'>删除失败...2秒后返回首页</div>";          
        }
          break;

        case 'guess':
        $sql = "delete from guess where guess_id = '$id'";
        $res = $db->exec($sql);
        if ($res == 1){
        header("refresh:2;url=/jc_admin/index.php");
        echo "<div class='alert alert-success'>删除成功！2秒后返回首页</div>";            
        } else {
        header("refresh:2;url=/jc_admin/index.php");
        echo "<div class='alert alert-danger'>删除失败...2秒后返回首页</div>";          
        }
          break;

        case 'team':

        $sql = "delete from team where team_id = '$id'";
        $res = $db->exec($sql);
        if ($res == 1){
                        
        header("refresh:2;url=/jc_admin/index.php");
        echo "<div class='alert alert-success'>删除成功！2秒后返回首页</div>";            
        } else {
        header("refresh:2;url=/jc_admin/index.php");
        echo "<div class='alert alert-danger'>删除失败...2秒后返回首页</div>";          
        }
          break;

        default:
        header("refresh:2;url=/jc_admin/index.php");
        echo "无";
          break;
      }

		?>


    </div>
  </body>
</html>

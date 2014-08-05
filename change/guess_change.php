<?php
session_start();
$_SESSION['id'] = $_GET['id'];
?>
<!DOCTYPE html>
<html  lang="zh-cn">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">

    <title>比赛结果更改</title>

    <!-- Bootstrap core CSS -->
    <link href="/jc_admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/jc_admin/css/bootstrap-select.css" rel="stylesheet">
    <link href="/jc_admin/css/insert.css" rel="stylesheet">
    <link href="/jc_admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  </head>

  <body>
<div class="container">

      <form class="form-signin" action="/jc_admin/inc/guess_change_submit.php" method="post" role="form">
        <div class="well" style="text-align:center">
        <h3 class="form-signin-heading">比赛结果更改</h3>
        </div>
            <div style="text-align:center">
              <select class="selectpicker"  data-style="btn-primary"  name='result'>
              <optgroup label="比赛结果">
                <option value='0'>0</option>"; 
                <option value='1'>1</option>"; 
                <option value='2'>2</option>"; 
                <option value='3'>3</option>"; 
              </optgroup>
              </select>
            </div>
        <br />
      <div style="text-align:center">
        <button class="btn btn-primary" type="submit">&nbsp&nbsp提交&nbsp&nbsp</button>
        <button class="btn btn-default" type="reset">&nbsp&nbsp清空&nbsp&nbsp</button>
      </div>
      <br />
      <button type="button" class="btn btn-block btn-primary" onclick="location.href='/jc_admin/index.php'">返回主页</button>
      </form>
        


  </div>
  <script src="/jc_admin/js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="/jc_admin/js/bootstrap.js" type="text/javascript"></script>
  <script src="/jc_admin/js/bootstrap-select.js" type="text/javascript"></script>
  <script src="/jc_admin/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $("#time1").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
    $("#time2").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});

  </script> 

  <script type="text/javascript">  
      window.onload=function(){  
          $('.selectpicker').selectpicker();  
      };  
  </script>
</body>
</html>
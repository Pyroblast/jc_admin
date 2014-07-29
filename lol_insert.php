<!DOCTYPE html>
<html  lang="zh-cn">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">

    <title>英雄联盟竞猜信息添加</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/insert.css" rel="stylesheet">

  </head>

  <body>
<div class="container">

      <form class="form-signin" action=".php" method="post" role="form">
        <div class="well" style="text-align:center">
        <h3 class="form-signin-heading">英雄联盟竞猜信息添加</h3>
        </div>
            <div style="text-align:center">
              <select class="selectpicker"  data-style="btn-primary"  name=''>
              <optgroup label="赛事名称">
              <option value='WCG'>WCG</option>
              <option value=''></option>
              <option value=''></option>
              <option value=''></option>
              </optgroup>
              </select>
            </div>
            <input type="date" class="form-control" name="time" ><br>
            <div style="text-align:center">
              <select class="selectpicker"  data-style="btn-primary"  name=''>
              <optgroup label="状态">
              <option value='未赛'>未赛</option>
              <option value='已赛'>已赛</option>
              </optgroup>
              </select>
            </div>
            <div style="text-align:center">
              <select class="selectpicker"  data-style="btn-primary"  name=''>
              <optgroup label="主队">
              <option value='WE'>WE</option>
              <option value='IG'>IG</option>
              <option value=''></option>
              <option value=''></option>
              </optgroup>
              </select>
            </div>
            <div style="text-align:center">
              <select class="selectpicker"  data-style="btn-primary"  name=''>
              <optgroup label="客队">
              <option value='WE'>WE</option>
              <option value='IG'>IG</option>
              <option value=''></option>
              <option value=''></option>
              </optgroup>
              </select>
            </div>
        <input type="text" class="form-control" placeholder="胜赔率:" name="" required autofocus>
        <br />
        <input type="text" class="form-control" placeholder="负赔率:" name="" required>
        <br />
        <input type="text" class="form-control" placeholder="平赔率:" name="" required>
        <br />
      <div style="text-align:center">
        <button class="btn btn-primary" type="submit">&nbsp&nbsp提交&nbsp&nbsp</button>
        <button class="btn btn-default" type="reset">&nbsp&nbsp清空&nbsp&nbsp</button>
      </div>
      <br />
      <button type="button" class="btn btn-block btn-primary" onclick="location.href='index.php'">返回主页</button>
      </form>
        


  </div>
  <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script type="text/javascript">  
      window.onload=function(){  
          $('.selectpicker').selectpicker();  
      };  
  </script>
</body>
</html>
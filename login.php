<?php
session_start();
//include '../include/ConnectMySql.php';
include 'inc/func.php';

$action = $_POST['action'];
$admin_name = addslashes($_POST['cai_admin']);
$admin_pw   = addslashes($_POST['cai_adminpw']);

if($_GET["logout"]){
    admin_logout();
    header("Location:login.php");
}

if($action == "login"){
    $msg = admin_login($admin_name,$admin_pw);
}
$login_admin = $_SESSION["cai_admin"];
if(!empty($login_admin)){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html  lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title>电竞·竞猜-管理员服务</title>
    <link rel="shortcut icon" type="image/png" href="http://www.dianjoy.com/wp-content/themes/dian2013/img/logo.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/insert.css" rel="stylesheet">
    <script type="text/javascript" src="http://www.hiwifi.com/wp-content/themes/hi4/js/jquery-1.9.1.min.js"></script>
    <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=322211403" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            if("" != "<?php echo $msg?>"){
                alert("<?php echo $msg?>");
                window.location='login.php';
            }
            var sloginstatus = WB2.checkLogin();
            if (sloginstatus){
                WB2.logout(function() {
                });
            }
        })
    </script>
</head>
<body>
<div class="container">
    <form class="form-signin" id='admin_login' action="" method="post" role="form">
        <h2 class="form-signin-heading">管理员登录</h2><br />
        <input type="text" class="form-control" placeholder="账号：" name="cai_admin" required autofocus>
        <input type="password" class="form-control" placeholder="密码：" name="cai_adminpw" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
        <input type="hidden" name="action" value="login" />
    </form>
</div>
</body>
</html>


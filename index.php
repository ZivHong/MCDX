<?php
/**
 * 用戶登錄
 */
//开启session
session_start();
//引入數據库链接配置文件
include 'config/config.inc.php';

//登錄逻辑
if (isset($_POST['username'])) {
    //查詢 输入的帳號密碼
    $stmt = $pdo->prepare('select * from u_users where username=? AND password=? ');
    $stmt->execute(array($_POST['username'], $_POST['password']));

    //如果记录数大于0
    if ($stmt->rowCount() > 0) {

        //将用戶信息存到session
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
        //记录登錄状态
        $_SESSION['user']['isUserLogin'] = 1;
        //获取用戶ip
        $ip = $_SERVER["REMOTE_ADDR"];
        //修改用戶登錄ip
        $stmt2 = $pdo->prepare('UPDATE  u_users SET ip = ? WHERE  id =? ');
        $stmt2->execute(array($ip, $_SESSION['user']['id']));

        //var_dump($_SESSION);
        //跳转到管理員管理界面
        header("Location:user/index.php");
    } else {
        echo "<script>alert('请检查帳號或者密碼')</script>";
    }

}
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>會員管理系統----用戶入口</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>


<div>
    <div class="container">
        <h1 class="text-center">使用者登錄</h1>
        <hr/>
        <form method="post" action="index.php" style="width: 30%;margin-left: 35%;">
            <div class="form-group">
                <label>使用者名稱</label>
                <input type="text" class="form-control" name="username" placeholder="名稱">
                <span aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label>密碼</label>
                <input type="password" class="form-control" name="password" placeholder="密碼">
                <span aria-hidden="true"></span>
            </div>
            <button type="submit" id="submit" class="btn btn-success">登錄</button>
            <p>还没有帳號？<a href="zhuce.php">點我註冊</a></p>
        </form>
    </div>
</div>


</body>
</html>



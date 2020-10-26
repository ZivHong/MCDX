<?php
/**
 * 用戶註冊文件
 * 主要就是让用戶输入资料进行註冊
 * 可以增加表单验证 或者修改处理逻辑   比如註冊发送邮件等
 */


//引入數據库链接配置文件
include 'config/config.inc.php';


//註冊逻辑
if (isset($_POST['username'])) {
    //查詢 输入的帳號密碼
    $stmt = $pdo->prepare('select * from u_users where username=?  ');
    $stmt->execute(array($_POST['username']));
    //如果名稱不存在  进行註冊
    if (($stmt->rowCount() == 0)) {
        $time = time();
        $stmt = $pdo->prepare('INSERT INTO u_users (username,password, sex,email,zc_time) VALUES (?,?,?,?,?)');
        $stmt->execute(array($_POST['username'], $_POST['password'], $_POST['sex'], $_POST['email'], $time));
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('註冊成功');window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('註冊失败')</script>";
        }
    } else {
        echo "<script>alert('帳號已经存在')</script>";
    }

}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit"><!--告诉360用极速模式-->
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>會員管理系統----用戶註冊</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div>
    <div class="container">
        <h1 class="text-center">用戶註冊</h1>
        <h3 class="text-center">請填寫完整資料</h3>
        <hr/>
        <form method="post" action="zhuce.php" style="width: 30%;margin-left: 35%;">
            <div class="form-group">
                <label>名稱</label>
                <input type="text" class="form-control" name="username" placeholder="名稱">
                <span aria-hidden="true"></span>
            </div>
            <div class="form-group">
                <label>E-Mail</label>
                <input type="text" class="form-control" name="email" placeholder="E-Mail">
                <span aria-hidden="true"></span>
            </div>
            <div class="form-group">
                <label>密碼</label>
                <input type="password" class="form-control" name="password" placeholder="密碼">
                <span aria-hidden="true"></span>
            </div>
            <div class="form-group">
                <label>性别</label>
                <label><input name="sex" checked="checked" type="radio" value="1"/>男 </label>
                <label><input name="sex" type="radio" value="0"/>女 </label>
            </div>
            <button type="submit" id="submit" class="btn btn-success">註冊</button>
        </form>
    </div>
</div>
</body>
</html>



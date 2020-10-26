<?php
/**
 * 用戶簽到記錄功能实现
 */

/**
 * 开启session
 */
session_start();

/**
 * 开启检查用戶是否登錄
 */
if (empty($_SESSION['user']['isUserLogin'])) {
    header("Location:../index.php");
}

/**
 * 引入數據库配置文件
 */
include '../config/config.inc.php';

/**
 * 查詢簽到記錄
 */
$sql = "SELECT u_crows.id,u_crows.ymd,u_crows.jf,u_users.username FROM u_crows  join u_users where u_crows.uid= u_users.id and u_users.id={$_SESSION['user']['id']} order by u_crows.id DESC ";
$res = $pdo->query($sql);


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
    <title>會員管理系統</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


<div class="container">
    <?php include 'header.php'; ?>
    <div class="row">
        <div class="col-sm-9" align="center">
            <div class="panel" style="border-radius: 0;min-height:450px;">
                <div class="panel-heading" style="background-color:#1abc9c;color:white;border-radius:0;">簽到記錄</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th style="text-align: center;">名稱</th>
                            <th style="text-align: center;">签到時間</th>
                            <th style="text-align: center;">剩餘點數</th>
                            <th style="text-align: center;">增加點數</th>
                        </tr>

                        <?php
                        while (list($id, $ymd, $jf, $username) = $res->fetch(PDO::FETCH_NUM)) {
                            echo "<tr>";
                            echo "<td style=\"text-align: center;\">$username</td>";
                            echo "<td style=\"text-align: center;\"> $ymd</td>";
                            echo "<td style=\"text-align: center;\">$jf</td>";
                            echo "<td style=\"text-align: center;\">+1 </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>


        <?php include 'right.php'; ?>

    </div>
</div>


</body>
</html>
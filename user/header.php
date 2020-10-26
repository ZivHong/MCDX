<?php
/**
 * 头部公用文件
 */

/**
 * 數據库配置文件
 */
include '../config/config.inc.php';

/**
 * 查詢用戶信息
 */
$stmt = $pdo->prepare('SELECT	id,username,integral,zc_time,sex,email FROM u_users where id= ?');
$stmt->execute(array($_SESSION['user']['id']));
if ($stmt->rowCount() > 0) {
    list($id, $username, $integral, $zc_time, $sex, $email) = $stmt->fetch(PDO::FETCH_NUM);
    $zc_time = date('Y-m-d', $zc_time);
}

?>

<ol class="breadcrumb" align="center">
    <li><a href="index.php">首頁</a></li>
    <li><a href="#">擁有（<?php echo $integral; ?>）點數</a></li>
    <li><a href="xiao_user.php?id=<?php echo $id; ?>">消費1點數</a></li>
    <li><a href="qian_user.php?id=<?php echo $id; ?>">點數签到</a></li>
    <li><a href="xiu_user.php?id=<?php echo $id; ?>">修改資料</a></li>
    <li><a href="loginout.php">登出</a></li>
</ol>


<style>
    ol, ul {
        list-style: none;
        padding: 0;
        margin: 0
    }

    #filter-comp, .vnav-wrapper {
        border: 1px solid #e8e8e8;
        background-color: #fff;
        padding: 0
    }

    #filter-comp a, .vnav-wrapper a {
        padding: 10px;
        display: block;
        color: #777;
        text-decoration: none;
        border-bottom: 1px solid #e8e8e8
    }

    #filter-comp a.active, #filter-comp a:hover, .vnav-wrapper a:hover, .vnav-wrapper li.active a {
        color: #1abc9c;
        border-left: 3px solid #1abc9c;
        padding: 10px 10px 10px 7px
    }

</style>
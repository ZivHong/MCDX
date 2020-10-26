<?php
/**
 * 用戶签到功能实现
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
 * 签到逻辑
 */
if (isset($_GET['id'])) {
    $sql = "select id,integral from u_users WHERE 1=1 and id={$_GET['id']} ";
    $res = $pdo->query($sql);
    list($id, $integral) = $res->fetch(PDO::FETCH_NUM);

    //获取今天日期 20180123
    $ymd = date('Ymd', time());
    //判断今天是否已经签到
    $sql = "select * from u_crows WHERE ymd={$ymd} and uid={$_GET['id']} ";
    $res = $pdo->query($sql);
    //没有签到 执行签到
    if ($res->rowCount() == 0) {
        //點數增加
        $integral += 1;
        //写入簽到記錄
        $stmt = $pdo->prepare('INSERT INTO u_crows ( uid,jf,ymd) VALUES (?,?,?)');
        $stmt->execute(array($_GET['id'], $integral, $ymd));
        //修改用戶點數
        $stmt = $pdo->prepare('UPDATE u_users SET integral=? WHERE id=?');
        $stmt->execute(array($integral, $id));

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('签到成功！點數+1');window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('签到失败，请稍后重试');window.location.href = 'index.php';</script>";
        }

    } else {
        echo "<script>alert('不能重复签到');window.location.href = 'index.php';</script>";

    }
    die();


}




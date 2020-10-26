<?php
/**
 * 用戶消費1點數功能实现
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
 * 引入數據库文件
 */
include '../config/config.inc.php';

/**
 * 定义時間
 */
$ymd = time();

/**
 * 消費逻辑
 */
if (isset($_GET['id'])) {
    $sql = "select id,integral from u_users WHERE 1=1 and id={$_GET['id']} ";
    $res = $pdo->query($sql);
    list($id, $integral) = $res->fetch(PDO::FETCH_NUM);
    if ($integral >= 1) {
        //點數减少
        $integral -= 1;
        $stmt = $pdo->prepare('UPDATE u_users SET integral=? WHERE id=?');
        $stmt->execute(array($integral, $id));
        if ($stmt->rowCount() > 0) {
            //写入消費紀錄
            $stmt = $pdo->prepare('INSERT INTO u_xiaos ( uid,jf,ymd) VALUES (?,?,?)');
            $stmt->execute(array($_GET['id'], $integral, $ymd));
            echo "<script>alert('消费成功！點數-1');window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('消费失败，请稍后重试');window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('點數不足，请赚取點數');window.location.href = 'index.php';</script>";
    }
}




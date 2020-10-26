<?php
/**
 * 登出
 */


/**
 * 开启session
 */
session_start();

/**
 * 开启取出名稱
 */
$username = $_SESSION['admin']['username'];

/**
 * 清空session
 */
$_SESSION['admin'] = array();


//if (isset($_COOKIE[session_name()])) {
//    setcookie(session_name(), '', time() - 42000, '/');
//}
//
//session_destroy();

/**
 * 判断是否登錄 无session 跳转到登錄 并做退出标记
 */
if (empty($_SESSION['user']['isUserLogin'])) {
    header("Location:../admin.php?action=out");
}


<?php
/**
 * 连接數據库配置文件
 */
try {
    //构建pdo对象
    $pdo = new PDO("mysql:host=localhost;dbname=user", 'root', '12345678');
    //设置异常处理模式
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "數據库链接失败" . $e->getMessage();//显示错误信息
    exit();
}
//设置编碼
$pdo->query("SET NAMES utf8");

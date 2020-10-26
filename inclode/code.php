<?php
//开启会话
session_start();
//引入验证碼类
include "vcode.class.php";

//构造方法
$vcode = new Vcode(80, 30, 4);
//将验证碼放到sessco
$_SESSION['code'] = $vcode->getcode();
//将验证碼图片输出
$vcode->outimg();
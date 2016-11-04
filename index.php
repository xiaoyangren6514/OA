<?php
//确定应该名称
define('APP_NAME','Home');
//确定应用路径
define('APP_PATH','./Home/');
//开启调试模式
define('APP_DEBUG',TRUE);
header('content-type:text/html;charset=utf-8');
//引入核心文件
require './ThinkPHP/ThinkPHP.php';
?>
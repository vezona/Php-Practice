<?php

// WEB_ROOT 指的是網站的路徑
define('WEB_ROOT', '/php-test/');


//<?= WEB_ROOT

if (!isset($_SESSION)) {
    session_start();
}



// 真正實際連資料庫
$db_host = 'localhost';
$db_name = 'project59';
$db_user = 'jin';
$db_pass = '123123';


// 這一行不可以有任何空格
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

$pdo_options = [
    // PDO::
    // POD自己定義好的，發生錯誤時會出現？
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // // 這邊是指fetch時，要用關聯式陣列ASSOC的方式取得
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // 一連線時我要執行甚麼=>意思是我要設定連線資料的進出都用utf8
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];

// 有可能會出錯時才放到try
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $ex) {
    echo 'Connection failed:' . $ex->getMessage();
}

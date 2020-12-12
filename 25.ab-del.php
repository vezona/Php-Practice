<?php

require __DIR__ . '/php_parts/config.php';
// 設定登入時才能動作
require __DIR__ . '/php_parts/admin-required.php';

// 刪除要指定哪一筆，沒指定就不動作
// 可寫成三元運算式
// $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (isset($_GET['sid'])) {
    // 這邊把取得的sid變成整數
    $sid = intval($_GET['sid']);
} else {
    // 如果沒有要刪，就回到原本畫面
    header('Location:22.ab-list.php');
    // 一定要exit，不然會繼續執行php
    exit;
}

// 這邊可以直接執行sid=$sid，因為上面已經換成整數了
//否則一定要prepare (這邊不確定，回去複習！！)
// SQL injection 
// 這隻沒有畫面，所以就不會呈現，但如果要跳出確認，就要另開畫面
$sql = "DELETE FROM `address_book`WHERE sid=$sid";
$pdo->query($sql);


// 完成後就讓它直接轉向，回到原來的位置
// header('Location:22.ab-list.php');
// exit;

// 但上面那個轉向會回到第一頁，所以要用referer這個方法去判斷是第幾頁刪除，然後讓它轉向回那一頁，而不是一直回到第一頁
// 判斷是否有referer這個值
// 如果是從別頁跳轉過來，就會有referer這個值
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location:' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location:22.ab-list.php');
};

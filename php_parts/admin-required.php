<?php
// 如果沒有啟動session
if (!isset($_SESSION)) {
    // 救啟動session
    session_start();
}

// 如果沒有登入，就轉向列表頁
if (!isset($_SESSION['admin'])) {
    header('Location:22.ab-list.php');
    exit;
}

<?php
session_start();

// session_destroy(); 把session所有資料都清掉 

//只清除user資料，session其實是一個陣列
unset($_SESSION['user']);

// 轉向，後端告訴頁面跳轉，server端設定檔頭給用戶端，告訴系統清除user資料後，要轉到哪個頁面
header('Location: 37.product-list.php');

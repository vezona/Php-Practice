<?php
include __DIR__ . '/php_parts/config.php';


if (!isset($_GET['sid'])) {
    header('Location:37.product-list.php');
    exit;
}

$sid = intval($_GET['sid']);
$sql = "SELECT * FROM products WHERE sid=$sid";
// 只有一筆就不要fetchAll，改用fetch
$row = $pdo->query($sql)->fetch();

if (empty($row)) {
    header('Location:37.product-list.php');
    exit;
}
?>
<h2><?= $row['bookname'] ?></h2>


<!-- 接著要在產品列表中，用a連結包起要點的圖片等等 -->
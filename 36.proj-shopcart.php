<!-- 在這邊設定$title，就可以出現想要的變數 -->
<?php $title = '商品列表＋購物車' ?>

<!-- 如果有不同層的資料，把css/JS的位置變成絕對路徑 -->
<?php include __DIR__ . '/php_parts/config.php' ?>


<!-- 這裡要引入放在另一個php中的head的資料 -->
<?php
include __DIR__ . '/php_parts/html.head.php';
// require __DIR__ . '/php_parts/html.head.php';
?>

<?php include __DIR__ . '/php_parts/html.nav-proj.php'; ?>


<div class="container">
    <h2>Hi</h2>
</div>

<?php include __DIR__ . '/php_parts/html.script.php'; ?>
<?php include __DIR__ . '/php_parts/html.footer.php'; ?>
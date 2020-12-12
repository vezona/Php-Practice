<!-- 在這邊設定$title，就可以出現想要的變數 -->
<?php $title = '來！' ?>

<!-- 如果有不同層的資料，把css/JS的位置變成絕對路徑 -->
<?php include __DIR__ . '/../php_parts/config.php' ?>


<!-- 這裡要引入放在另一個php中的head的資料 -->
<?php
// 兩種用法，可以用require或是include
// 兩者錯誤等級不同，include如果找不到資料會出現warning, 但requrire就會直接出現錯誤，接下來東西都不會執行
// 必要的東西用require，次要的就用include
include __DIR__ . '/../php_parts/html.head.php';
// require __DIR__ . '/php_parts/html.head.php';
?>

<?php include __DIR__ . '/../php_parts/html.nav.php'; ?>



<div class="container">
    <h2>Hi</h2>
</div>

<?php include __DIR__ . '/../php_parts/html.script.php'; ?>
<?php include __DIR__ . '/../php_parts/html.footer.php'; ?>
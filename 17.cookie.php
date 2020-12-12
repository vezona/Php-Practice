<!-- 設定cookie -->
<?php
$c = isset($_COOKIE['my_cookie']) ? intval($_COOKIE['my_cookie']) : 0;
$c++;

setcookie('my_cookie', $c);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cookies</title>
</head>

<body>


    <!-- 讀取cookie -->
    <?php
    echo $c;
    ?>

</body>

</html>
<!-- 設定session，放在html設定之前 -->
<!-- 如果要用session的話，一定要用規定的session_start()開始 -->
<?php
session_start();

if (isset($_SESSION['my'])) {
    $_SESSION['my']++;
} else {
    $_SESSION['my'] = 1;
}

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
    echo  $_SESSION['my'];
    ?>

</body>

</html>
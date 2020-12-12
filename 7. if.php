<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>if</title>
</head>

<body>
    <!-- ============用多個php分開包，直接把HTML當成Echo================= -->
    <?php $age = $_GET['age'] ?? 0; ?>

    <!-- 大括號可以用:代替 -->
    <?php if ($age >= 18) : ?>
        <img src="" alt="">
        <p>kitten</p>


    <?php else : ?>
        <img src="" alt="">
        <p>old cat</p>
    <?php endif; ?>


    <!-- ============整個php包住，用Echo呼叫================= -->
    <?php
    $age = $_GET['age'] ?? 0;
    if ($age >= 18) {
        echo '<img src="" alt="">
        <p>kitten</p>';
    } else {
        echo  '<img src="" alt="">
        <p>old cat</p>';
    } ?>

</body>

</html>
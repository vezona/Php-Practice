<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    $a = 123;

    $b = "23";

    $c = "Mary";

    // echo $a + $b;

    echo "hello $b ~~<br>";
    echo 'hello $b ~~<br>';

    // 用雙引號的話，就會出現警告，因為這個變數沒有被命名
    echo "hello $b122 ~~<br>";


    echo "hello {$c}122 ~~<br>";

    ?>



</body>

</html>
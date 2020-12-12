<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>array</title>


</head>

<body>

    <!-- </pre>是來完全呈現空白或斷行，你程式碼怎麼排，他就怎麼呈現 -->
    <pre>
    <?php
    $ar = array(
        'name' => 'jin',
        'age' => 25,
        'gender' => 'female',
    );


    $ar2 = [3, 5, 7, 9, 0];


    //foreach的看法是 （放想要看的值  as  想要看的東西）
    //$k=key ; $v = value 
    foreach ($ar as $k => $v) {
        echo "$k:$v <br>";
    }

    foreach ($ar2 as $k => $v) {
        echo "$k:$v <br>";
    }

    ?>
</pre>
</body>

</html>
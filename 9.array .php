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
    $ar = array(4, 5, 6);
    $ar2 = [7, 8, 9];


    $ar[2];

    $ar[] = 12; //array push;

    // 有兩種方法可以查看陣列 
    // print_r專門用來查看陣列
    print_r($ar);


    // var_dump會給更多值，告訴你string等等
    var_dump($ar2);

    ?>
</pre>
</body>

</html>
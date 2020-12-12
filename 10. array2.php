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
        'character' => 'cute',

    );
    $ar2 = [
        'name' => 'fang',
        'age' => 26,
        'character' => 'hey'

    ];

    //在ＪＳ中，$ar3 = $ar2是等於參照位置，所以改了$ar2的名字，$ar3也會跟著改
    // 但在php中，$ar3 = $ar2是複製的意思，所以複製過去後，就算改了$ar2的名字，$ar3也不會跟著改
    //但如果將  $ar2['name'] = 'john';改放到複製之前，就會跟著改變

    $ar3 = $ar2;  //複製$ar2

    $ar2['name'] = 'john';


    print_r($ar);
    print_r($ar2);
    print_r($ar3);



    ?>
</pre>
</body>

</html>
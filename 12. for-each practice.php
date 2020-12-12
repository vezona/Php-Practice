<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>array</title>


</head>

<body>

    <!-- </pre>是來完全呈現空白或斷行，你程式碼怎麼排，他就怎麼呈現 -->
    <?php

    $list = [
        [
            'name' => 'jin',
            'age' => 25,
            'gender' => 'female',
        ],
        [
            'name' => 'Bill',
            'age' => 28,
            'gender' => 'man',
        ],
        [
            'name' => 'Kay',
            'age' => 30,
            'gender' => 'male',
        ]
    ];

    ?>


    <table border=1>

        <!-- as 的意思是，要把list中的東西拿出來，並當作什麼去運用，所以as 後面的什麼可以自己命名 -->
        <?php foreach ($list as $item) { ?>
            <tr>

                <!-- 這邊的 < ? = 是指echo的意思，就是要呼叫出什麼東西  -->
                <td><?= $item['name'] ?></td>
                <td><?= $item['age'] ?></td>
                <td><?= $item['gender'] ?></td>
            </tr>


        <?php } ?>

    </table>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>for</title>
    <style>
        td {
            width: 40px;
            height: 40px;
            color: white;
        }
    </style>


</head>

<body>
    <table border="1">
        <tr>

            <?php for ($i = 0; $i < 10; $i++) { ?>

                <!-- = $ 是php echo的縮寫-->

                <td style="background-color:#0<?= $i; ?>"><?= $i ?></td>

            <?php  } ?>


        </tr>
    </table>



</body>

</html>
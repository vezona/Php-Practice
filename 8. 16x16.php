<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>for</title>

    <style>
        td {
            color: white;
            width: 40px;
            height: 40px;
            text-align: center;
        }
    </style>
</head>

<body>

    <table border="1">
        <?php for ($k = 0; $k < 16; $k++) : ?>

            <tr>

                <!-- 內層的for回圈 -->
                <?php for ($i = 0; $i < 16; $i++) :
                    $c = sprintf('#0%x%x', $k, $i);
                ?>
                    <td style="background-color:<?= $c ?>">
                        <?= $i . 'x' . $k ?>
                    </td>

                <?php endfor ?>


            </tr>

        <?php endfor ?>
    </table>


</body>

</html>
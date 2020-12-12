<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>for</title>
</head>

<body>

    <table border="1">
        <tr>

            <!-- printf
            sprintf -->

            <?php for ($i = 0; $i < 16; $i++) :
                printf('<td style="background-color:#00%x">', $i);
                echo $i;
                echo '</td>';

            endfor ?>


        </tr>
    </table>


</body>

</html>
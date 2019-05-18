<?php

    require_once("pkg_music_model.php");

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Update pkg music</title>

</head>

<body>

    <a href="?sdm=pkg_musician" class="btn-back">Back</a>

    <form action="" method="post" class="default_form">

        <table>

            <tr>

                <td>Package Name</td>

                <td><input type="text" name="package_name"  value="<?php echo $data['package_name']?>" required></td>

            </tr>

            <tr>

                <td>qty vocal</td>

                <td><input type="number" name="qty_vocal" value="<?php echo $data['qty_vocal']?>" required></td>

            </tr>

            <tr>

                <td>qty piano</td>

                <td><input type="number" name="qty_piano" value="<?php echo $data['qty_piano']?>" required></td>

            </tr>

            <tr>

                <td>qty_saxophone</td>

                <td><input type="number" name="qty_saxophone" value="<?php echo $data['qty_saxophone']?>" required></td>

            </tr>

            <tr>

                <td>qty_biola</td>

                <td><input type="number" name="qty_biola" value="<?php echo $data['qty_biola']?>" required></td>

            </tr>

            <tr>

                <td>qty_bass</td>

                <td><input type="number" name="qty_bass" value="<?php echo $data['qty_bass']?>" required></td>

            </tr>

            <tr>

                <td>sound_system</td>

                <td><input type="text" name="sound_system" value="<?php echo $data['sound_system']?>" required></td>

            </tr>

        </table>

    <input type="submit" name="updateDataSubmit" value="Save">

    </form>

</body>

</html>
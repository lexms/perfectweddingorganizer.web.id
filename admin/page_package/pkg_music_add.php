<?php

    require_once("page_package/pkg_music_model.php");

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Add pkg photo video</title>

</head>

<body>

    <a href="?sdm=pkg_musician" class="btn-back">Back</a>

    <form action="page_package/pkg_music_model.php" class="default_form" method="post">

        <table>

            <tr>

                <td>Package Name</td>

                <td><input type="text" name="package_name" required></td>

            </tr>

            <tr>

                <td>qty vocal</td>

                <td><input type="number" name="qty_vocal" required></td>

            </tr>

            <tr>

                <td>qty piano</td>

                <td><input type="number" name="qty_piano" required></td>

            </tr>

            <tr>

                <td>qty_saxophone</td>

                <td><input type="number" name="qty_saxophone" required></td>

            </tr>

            <tr>

                <td>qty_biola</td>

                <td><input type="number" name="qty_biola" required></td>

            </tr>

            <tr>

                <td>qty_bass</td>

                <td><input type="number" name="qty_bass" required></td>

            </tr>

            <tr>

                <td>sound_system</td>

                <td><input type="text" name="sound_system" required></td>

            </tr>

        </table>

    <input type="submit" name="addDataSubmit" value="Save">

    </form>

</body>

</html>
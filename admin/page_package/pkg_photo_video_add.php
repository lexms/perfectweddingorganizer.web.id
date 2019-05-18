<?php

    require_once("page_package/pkg_photo_video_model.php");

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

    <a href="?sdm=pkg_photo_video" class="btn-back">Back</a>

    <form action="page_package/pkg_photo_video_model.php" class="default_form" method="post">

        <table>

            <tr>

                <td>Package Name</td>

                <td><input type="text" name="package_name" required></td>

            </tr>

            <tr>

                <td>Duration prewedding</td>

                <td><input type="text" name="duration_prewedding" required></td>

            </tr>

            <tr>

                <td>Qty Album</td>

                <td><input type="number" name="qty_album" required></td>

            </tr>

            <tr>

                <td>Photo album size</td>

                <td><input type="text" name="photo_album_size" required></td>

            </tr>

            <tr>

                <td>Qty gallery</td>

                <td><input type="number" name="qty_gallery" required></td>

            </tr>

            <tr>

                <td>Photo gallery size</td>

                <td><input type="text" name="photo_gallery_size" required></td>

            </tr>

        </table>

    <input type="submit" name="addDataSubmit" value="Save">

    </form>

</body>

</html>
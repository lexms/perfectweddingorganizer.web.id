<?php

    require_once("pkg_catering_model.php");

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Update pkg catering</title>

</head>

<body>

    <a href="?sdm=pkg_catering" class="btn-back">Back</a>

    <form action="" method="post" class="default_form">

        <table>

            <tr>

                <td>Package Name</td>

                <td><input type="text" name="package_name"  value="<?php echo $data['package_name']?>" required></td>

            </tr>

            <tr>

                <td>qty_type_main_course</td>

                <td><input type="number" name="qty_type_main_course" value="<?php echo $data['qty_type_main_course']?>" required></td>

            </tr>

            <tr>

                <td>qty_type_dessert</td>

                <td><input type="number" name="qty_type_dessert" value="<?php echo $data['qty_type_dessert']?>" required></td>

            </tr>

        </table>

    <input type="submit" name="updateDataSubmit" value="Save">

    </form>

</body>

</html>
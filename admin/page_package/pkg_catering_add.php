<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Add pkg photo video</title>

</head>

<body>

    <a href="?sdm=pkg_catering" class="btn-back">Back</a>

    <form action="page_package/pkg_catering_model.php"  class="default_form" method="post">

        <table>

            <tr>

                <td>Package Name</td>

                <td><input type="text" name="package_name" required></td>

            </tr>

            <tr>

                <td>qty_type_main_course</td>

                <td><input type="number" name="qty_type_main_course" required></td>

            </tr>

            <tr>

                <td>qty_type_dessert</td>

                <td><input type="number" name="qty_type_dessert" required></td>

            </tr>

        </table>

    <input type="submit" name="addDataSubmit" value="Save">

    </form>

</body>

</html>
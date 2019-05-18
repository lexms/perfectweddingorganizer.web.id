<?php

    require_once("package_model.php")

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

</head>

<body>

    <a href="?sdm=main_package" class="btn-back">Back</a>

    <form action="page_package/package_model.php" class="default_form" method="post">

        <table>

            <tr>

                <td>Package name</td>

                <td><input type="text" name="package_name" required></td>

            </tr>

            <tr>

                <td>Package price</td>

                <td><input type="number" name="package_price" required></td>

            </tr>

            <tr>

                <td>Qty WO Personil</td>

                <td><input type="number" name="qty_WO_personil" required></td>

            </tr>

            <tr>

                <td>Id pkg PV</td>

                <td>

                    <select name="id_pkg_photo_video" id="">

                    <?php

                        $resPPV = selectPPV(0);

                        while ($data=mysqli_fetch_array($resPPV)) {

                            $id_PVV = $data['id_pkg_photo_video'];

                            $name_package = $data['package_name'];

                            echo "<option value = $id_PVV> $name_package </option>";

                        }

                    ?>

                    </select>

                </td>

            </tr>

            <tr>

                <td>Id pkg music</td>

                <td><select name="id_pkg_music" id="">

                    <?php

                        $resMusic = selectMusic(0);

                        while ($data=mysqli_fetch_array($resMusic)) {

                            $id_Music= $data['id_pkg_music'];

                            $name_package = $data['package_name'];

                            echo "<option value = $id_Music> $name_package </option>";

                        }

                    ?>

                    </select>

                </td>

            </tr>

            <tr>

                <td>Id pkg catering</td>

                <td><select name="id_pkg_catering" id="">

                    <?php

                        $resCatering = selectCatering(0);

                        while ($data=mysqli_fetch_array($resCatering)) {

                            $id_Catering= $data['id_pkg_catering'];

                            $name_package = $data['package_name'];

                            echo "<option value = $id_Catering> $name_package </option>";

                        }

                    ?>

                    </select>

                </td>

                <tr>

                <td>Package Description</td>

                <td><pre><textarea name="package_desc" id="package_desc" cols="30" rows="10" required></textarea></pre></td>

                </tr>

            </tr>

        </table>

    <input type="submit" name="addDataSubmit" value="Save">

    </form>

</body>

</html>   
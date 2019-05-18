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

    <br>

    <form action="" method="POST">

    <table  class="default_form">

        <tr>

            <td>package name</td>

            <td><input type="text" name="package_name" value="<?php echo $data['package_name']?>" required></td>

        </tr>

        <tr>

            <td>package price</td>

            <td><input type="number" name="package_price" value="<?php echo $data['package_price']?>" required></td>

        </tr>

        <tr>

            <td>qty WO Personil</td>

            <td><input type="number" name="qty_WO_personil" value="<?php echo $data['qty_WO_personil']?>" required></td>

        </tr>

        <tr>

            <td>Package Description</td>

            <td><textarea name="package_desc" id="package_desc" cols="30" rows="10" required><?php  echo $data['package_desc']; ?></textarea></td>

            </tr>

        </tr>

        <tr>

            <td>id pkg PV</td>

            <td>

                <select name="id_pkg_photo_video" id="">

                <?php

                    $resPPV = selectPPV(0);

                    while ($cari=mysqli_fetch_array($resPPV)) {

                        $id_PVV = $cari['id_pkg_photo_video'];

                        $name_package = $cari['package_name'];

                        if ($id_PVV == $selected) {

                            echo "<option selected value = $id_PVV> $name_package </option>";

                        } else {

                            echo "<option value = $id_PVV> $name_package </option>";

                        }

                    }

                ?>

                </select>

            </td>

        </tr>

        <tr>

            <td>id pkg music</td>

            <td><select name="id_pkg_music" id="">

                <?php

                    $resMusic = selectMusic(0);

                    while ($cari=mysqli_fetch_array($resMusic)) {

                        $id_Music= $cari['id_pkg_music'];

                        $name_package = $cari['package_name'];

                        if ($id_PVV == $selected) {

                            echo "<option selected value = $id_Music> $name_package </option>";

                        } else {

                            echo "<option value = $id_Music> $name_package </option>";

                        }

                    }

                ?>

                </select>

            </td>

        </tr>

        <tr>

            <td>id pkg catering</td>

            <td><select name="id_pkg_catering" id="">

                <?php

                    $resCatering = selectCatering(0);

                    while ($cari=mysqli_fetch_array($resCatering)) {

                        $id_Catering= $cari['id_pkg_catering'];

                        $name_package = $cari['package_name'];

                        if ($id_PVV == $selected) {

                            echo "<option selected value = $id_Catering> $name_package </option>";

                        } else {

                            echo "<option value = $id_Catering> $name_package </option>";

                        }

                    }

                ?>

                </select>

            </td>

        </tr>

    </table>

    <input type="submit" name="updateDataSubmit" value="Save">

    </form>

</body>

</html>   
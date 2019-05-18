<?php

    require_once("page_package/package_model.php");

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Package Overview</title>

</head>

<body>



        <div class="table-toolbar">

            <div>

                <a href="?pkg=add">

                    <button class="btn-add">

                        <i class="content-add"></i> ADD

                    </button>

                </a> 

            </div>



            <div>

                <form action="" method='post'>

                <select name="category" id="">

                    <option value="package_name">Package Name</option>

                    <option value="package_price">Price</option>

                    <option value="qty_WO_personil">WO Personil</option>

                    <option value="package_name">Pkg Photo &  Video</option>

                    <option value="package_name">Pkg Music</option>

                    <option value="package_name">Pkg Catering</option>

                </select>

                    <input type="text" name="input_search" placeholder="Search">

                    <!-- <input type="submit" name="search"> -->

                    <button type="submit" class="btn-search" name="search"><i class="magnify-glass"></i></button>

                </form>

            </div>

        </div>

        <div>

            <table class="default_table" border=1>

                <tr>

                    <th>No</th>

                    <th>Package Name</th>

                    <th>Price</th>

                    <th>WO Personil</th>

                    <th>Pkg Photo & Video</th>

                    <th>Pkg Music</th>

                    <th>Pkg Catering</th>

                    <th>Action</th>

                </tr>

    

                <?php

                   $no=0;

                   if (isset($hasil_search)) {

                    $res = $hasil_search;

                } else {

                    $res = selectAllPackage();               

                }              

                   $ketemu = mysqli_num_rows($res);

           

                   if ($ketemu > 0) {

                       while ($data=mysqli_fetch_array($res)) {

           

                           $id_PV = $data['id_pkg_photo_video'];

                           $id_music = $data['id_pkg_music'];

                           $id_catering = $data['id_pkg_catering'];

           

                           $resPPV = selectPPV($id_PV);

                           $resMusic = selectMusic($id_music);

                           $resCatering = selectCatering($id_catering);

            

                           $dataPPV = mysqli_fetch_array($resPPV);

                           $dataMusic = mysqli_fetch_array($resMusic);

                           $dataCatering = mysqli_fetch_array($resCatering);

           

                           $no++;

               ?>

                           <tr>

                               <td> <a href="?id_package=<?php echo $data['id_package'] ?>&method=edit&pkg=update"> <?php echo $no ?> </td>

                               <td> <?php echo $data['package_name'] ?> </td>

                               <td> <?php echo $data['package_price'] ?> </td>

                               <td> <?php echo $data['qty_WO_personil'] ?> </td>

                               <td> <?php echo $dataPPV['package_name'] ?> </td>

                               <td> <?php echo $dataMusic['package_name'] ?> </td>

                               <td> <?php echo $dataCatering['package_name'] ?> </td>

                               <td><a href="?id_package=<?php echo $data['id_package'] ?>&method=delete&pkg=delete"><b>Delete</b></a></td>

                           </tr>

                <?php 

                    }

                } else {

                    echo "0 results";

                }

                ?>

            </table>

        </div>



</body>

</html>
<?php

    require 'vendor_photovideo_model.php';

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

    <div class="table-toolbar">

        <div>

            <a href="?sdm=photovideo_add">

                <button class="btn-add">

                    <i class="content-add"></i> ADD

                </button>

            </a> 

        </div>

        

        <div>

            <form action="" method='post'>

                <select name="category" id="">

                    <option value="name">Vendor Name</option>

                    <option value="phone_number">Phone Number</option>

                    <option value="address">Address</option>

                </select>

                <input type="text" name="input_search" placeholder="Search">

                <!-- <input type="submit" name="search"> -->

                <button type="submit" class="btn-search" name="search"><i class="magnify-glass"></i></button>

            </form>

        </div>

    </div>



    <div>

        <table class="default_table">

            <tr>

                <th>No</td>

                <th>Vendor Name</th>

                <th>Phone Number</th>

                <th>Address</th>

                <th>Action</th>

            </tr>

            <?php

                $no=1; 

               

                if (isset($hasil_search)) {

                    $res = $hasil_search;

                } else {

                    $res =  selectAllPV();

                }

    

               if (mysqli_num_rows($res) > 0) {

                // output data of each row

                while($row = mysqli_fetch_assoc($res)) {

                     ?>     

                <tr>

                    <td><a href="?sdm=photovideo_model&id_vendor_photo_video=<?php echo $row['id_vendor_photo_video'] ?>&method=edit"><?php echo $no ?></a></td>

                    <td><?php echo $row["name"] ?></td>

                    <td><?php echo $row["phone_number"] ?></td>

                    <td><?php echo $row["address"] ?></td>

                    <td><a href="?sdm=photovideo_model&id_vendor_photo_video=<?php echo $row['id_vendor_photo_video'] ?>&method=delete"><b>Delete</b></a></td>

                </tr>

    

                <?php    

                $no++;

                }

            } else {

                echo "0 results";

            }

       ?>

        </table>

    </div>

</body>

</html>
<?php

    require 'venue_model.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <style>

        td {

            max-width: 200px;

        }



        img {

            width:100px;

            height:auto;

        }

    </style>

</head>

<body>

    <!-- <a href="page_venue_mc_vendors/venue/venue_add.php">ADD</a> <a href="venue_delete"></a> -->

    <div class="table-toolbar">

            <div>

            <a href="?sdm=venue_add">

                    <button class="btn-add">

                        <i class="content-add"></i> ADD

                    </button>

                </a> 

            </div>

        <div>

        <form action="" method='post'>

            <select name="category" id="">

                <option value="venue_name">Venue Name</option>

                <option value="max_capacity">Max Capacity</option>

                <option value="location">Location</option>

                <option value="venue_price">Venue Price</option>


            </select>
            
            <input type="text" name="input_search" placeholder="Search">

            <!-- <input type="submit" name="search"> -->

            <button type="submit" class="btn-search" name="search" ><i class="magnify-glass"></i></button>

        </form>

        </div>

    </div> 



    <div>

        <table class="default_table" border=1>

            <tr>

                <th>No</th>

                <th>Venue Name</th>

                <th>Max Capacity</th>

                <th>Location</th>

                <th>Price</th>

                <!-- <td>Description</td> -->

                <th>Image</th>

                <!-- <td>Status</td> -->

                <th>Action</th>

            </tr>

            <?php

                $no=1; 

               if (isset($hasil_search)) {

                    $res = $hasil_search;

                } else {

                    $res =  selectAllVenue();                

                }

    

                

               if (mysqli_num_rows($res) > 0) {

                // output data of each row

                while($row = mysqli_fetch_assoc($res)) {

                    ?>     

    

                <tr>

                  <td><a href="?sdm=venue_model&id_venue=<?php echo $row['id_venue'] ?>&method=edit"><?php echo $no ?></a></td>

                    <td><?php echo $row["venue_name"] ?></td>

                    <td><?php echo $row["max_capacity"] ?></td>

                    <td><?php echo $row["location"] ?></td>

                    <td><?php echo $row["venue_price"] ?></td>

                    <!-- <td><?php echo $row['venue_desc']; ?></td> -->

                    <td><a href="page_venue_mc_vendors/venue/venue_images/<?php echo $row['img_url']; ?>"><img src="page_venue_mc_vendors/venue/venue_images/<?php echo $row['img_url'] ?>" alt=""></a></td>

                    <td><a href="?sdm=venue_model&id_venue=<?php echo $row['id_venue'] ?>&method=delete"><b>Delete</b></a></td>

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
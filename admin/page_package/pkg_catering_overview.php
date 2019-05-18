<?php

    include_once ('pkg_catering_model.php')



?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Package photo video Overview</title>

</head>

<body>
    <div class="table-toolbar">

            <div>

                <a href="?pkgCatering=add">

                    <button class="btn-add">

                        <i class="content-add"></i> ADD

                    </button>

                </a> 

            </div>

        

            <div>
                <form action="" method='post'>
        
                <select name="category" id="">
        
                    <option value="package_name">Package Name</option>
        
                    <option value="qty_type_main_course">Qty Type Main Course</option>
        
                    <option value="qty_type_dessert">Qty Type Dessert</option>           
        
                    </select>
        
                <input type="text" name="input_search" placeholder="Search">

                <!-- <input type="submit" name="search"> -->

                <button type="submit" class="btn-search" name="search" ><i class="magnify-glass"></i></button>
        
                </form>
            </div>

        </div>

        <table class="default_table" border=1>

            <tr>

                <th>No</th>

                <th>Package name</th>

                <th>Qty Type Main Course</th>

                <th>Qty Type Dessert</th>

                <th>Action</th>

            </tr>



            <?php

                $no=0;

                if (isset($hasil_search)) {

                    $res = $hasil_search;

                } else {

                    $res = selectAllpkgCatering();                                  

                }     

                $ketemu = mysqli_num_rows($res);



                if ($ketemu > 0) {

                    while ($data=mysqli_fetch_array($res)) {

                        $no++;

            ?>

                        <tr>

                            <td> <a href="?id_pkg_catering=<?php echo $data['id_pkg_catering'] ?>&method=edit&pkgCatering=update"> <?php echo $no ?> </td>

                            <td> <?php echo $data['package_name'] ?></td>

                            <td> <?php echo $data['qty_type_main_course'] ?></td>

                            <td> <?php echo $data['qty_type_dessert'] ?></td>

                            <td> <a href="page_package/pkg_catering_model.php?id_pkg_catering=<?php echo $data['id_pkg_catering'] ?>&method=delete&pkgCatering=delete"><b>Delete</b></a></td>

                        </tr>

            <?php

                    }

                } else {

                    echo "0 results";

                }



            ?>

        </table>

</body>

</html>
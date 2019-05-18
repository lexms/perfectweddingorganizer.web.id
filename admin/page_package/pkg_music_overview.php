<?php

    require_once('page_package/pkg_music_model.php')



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

            <a href="?pkgMusic=add">

                <button class="btn-add">

                    <i class="content-add"></i> ADD

                </button>

            </a> 

        </div>

        <div>
            <form action="" method='post'>
    
                <select name="category" id="">
        
                    <option value="package_name">Package Name</option>
        
                    <option value="qty_vocal">Qty Vocal</option>
        
                    <option value="qty_piano">Qty Piano</option>
        
                    <option value="qty_saxophone">Qty Sexophone</option>
        
                    <option value="qty_biola">Qty Biola</option>
        
                    <option value="qty_bass">Qty Bass</option>
        
                    <option value="sound_system">Sound System</option>
        
                </select>
        
                <input type="text" name="input_search" placeholder="Search">

                <!-- <input type="submit" name="search"> -->

                <button type="submit" class="btn-search" name="search"><i class="magnify-glass"></i></button>
        
            </form>
        </div>
    </div>

        <table class="default_table" border=1>

            <tr>

                <th>No</th>

                <th>Pacakge name</th>

                <th>Qty Vocal</th>

                <th>Qty Piano</th>

                <th>Qty Saxophone</th>

                <th>Qty Biola</th>

                <th>Qty bass</th>

                <th>Sound System</th>

                <th>Action</th>

            </tr>



            <?php

                $no=0;

                if (isset($hasil_search)) {

                    $res = $hasil_search;

                } else {

                    $res = selectAllpkgMusic();                                  

                }

                $ketemu = mysqli_num_rows($res);



                if ($ketemu > 0) {

                    while ($data=mysqli_fetch_array($res)) {

                        $no++;

            ?>

                        <tr>

                            <td> <a href="?id_pkg_music=<?php echo $data['id_pkg_music'] ?>&method=edit&pkgMusic=update"> <?php echo $no ?> </td>

                            <td> <?php echo $data['package_name'] ?></td>

                            <td> <?php echo $data['qty_vocal'] ?></td>

                            <td> <?php echo $data['qty_piano'] ?></td>

                            <td> <?php echo $data['qty_saxophone'] ?></td>

                            <td> <?php echo $data['qty_biola'] ?></td>

                            <td> <?php echo $data['qty_bass'] ?></td>

                            <td> <?php echo $data['sound_system'] ?></td>

                            <td> <a href="page_package/pkg_music_model.php?id_pkg_music=<?php echo $data['id_pkg_music'] ?>&method=delete"><b>Delete</b></a></td>

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
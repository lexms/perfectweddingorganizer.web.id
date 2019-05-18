<?php
    require_once("page_package/pkg_photo_video_model.php");
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

                <a href="?pkgPV=add">

                    <button class="btn-add">

                        <i class="content-add"></i> ADD

                    </button>

                </a> 

            </div>
        <form action="" method='post'>
        <select name="category" id="">
            <option value="package_name">Pacakge Name</option>
            <option value="duration_prewedding">Duration prewedding</option>
            <option value="qty_album">Qty Album</option>
            <option value="photo_album_size">Photo album size</option>
            <option value="qty_gallery">Qty gallery</option>
            <option value="photo_gallery_size">Photo gallery size</option>
        </select>
        
        <input type="text" name="input_search" placeholder="Search">

        <!-- <input type="submit" name="search"> -->

        <button type="submit" class="btn-search" name="search"><i class="magnify-glass"></i></button>
    </div>
    </form>
        <table class="default_table" border=1>
            <tr>
                <th>No</th>
                <th>Pacakge name</th>
                <th>Duration prewedding</th>
                <th>Qty Album</th>
                <th>Photo album size</th>
                <th>Qty gallery</th>
                <th>Photo gallery size</th>
                <th>Action</th>
            </tr>

            <?php
                $no=0;
                if (isset($hasil_search)) {
                    $res = $hasil_search;
                } else {
                $res = selectAllPPV();                                    
                }
                    $ketemu = mysqli_num_rows($res);

                if ($ketemu > 0) {
                    while ($data=mysqli_fetch_array($res)) {
                        $no++;
            ?>
                        <tr>
                            <td> <a href="?id_pkg_photo_video=<?php echo $data['id_pkg_photo_video'] ?>&method=edit&pkgPV=update"> <?php echo $no ?> </a> </td>
                            <td> <?php echo $data['package_name'] ?></td>
                            <td> <?php echo $data['duration_prewedding'] ?></td>
                            <td> <?php echo $data['qty_album'] ?></td>
                            <td> <?php echo $data['photo_album_size'] ?></td>
                            <td> <?php echo $data['qty_gallery'] ?></td>
                            <td> <?php echo $data['photo_gallery_size'] ?></td>
                            <td> <a href="page_package/pkg_photo_video_model.php?id_pkg_photo_video=<?php echo $data['id_pkg_photo_video'] ?>&method=delete"><b>Delete</b></a></td>
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
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
    <center>
        <a href="?pkg=add">ADD</a> <a href="package_delete"></a>
        <form action="" method='post'>
        <select name="category" id="">
            <option value="package_name">Package Name</option>
            <option value="package_price">Price</option>
            <option value="qty_WO_personil">WO Personil</option>
            <option value="package_name">Pkg Photo &  Video</option>
            <option value="package_name">Pkg Music</option>
            <option value="package_name">Pkg Catering</option>
        </select>
        Search<input type="text" name="input_search">
        <input type="submit" value="Search" name="search">
    </form>
        <table border=1>
            <tr>
                <td>No</td>
                <td>Package Name</td>
                <td>Price</td>
                <td>WO Personil</td>
                <td>Pkg Photo & Video</td>
                <td>Pkg Music</td>
                <td>Pkg Catering</td>
                <td>Package Description</td>
                <td>Actions</td>
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
                           <td> <pre> <?php  echo $data['package_desc'] ?> </pre> </td>
                           <td><a href="?id_package=<?php echo $data['id_package'] ?>&method=delete&pkg=delete">Delete</a></td>
                       </tr>
            <?php 
                }
            } else {
                echo "0 results";
            }
            ?>
        </table>
    </center>
</body>
</html>
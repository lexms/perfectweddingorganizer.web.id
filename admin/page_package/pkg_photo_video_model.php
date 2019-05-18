<?php
    ob_start();
    require_once("../database.php");
    require_once("inputValidation.php");

    function getLinkDatabase() {
        return koneksi_db();  
    }

    
    if (isset($_POST['addDataSubmit'])) {
        addPPV();
    }

    if (isset($_POST['search'])) {
        if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
            $category = $_POST['category'];
            $input_search = $_POST['input_search'];   
            $hasil_search = search($category,$input_search);       
            return $hasil_search;
        }
    }

    if (isset($_GET['id_pkg_photo_video'])) {
        $id_pkg_photo_video = $_GET['id_pkg_photo_video'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePPV($id_pkg_photo_video);
            } elseif (($_GET['method']) == "delete") {
                deletePPV($id_pkg_photo_video);
            }
        }
    }

    function selectAllPPV() {
        $link = koneksi_db();
        $sql = "SELECT * FROM pkg_photo_video";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    

    function addPPV() {
        $link = koneksi_db();

        $package_name           = secure_input($_POST['package_name']);
        $duration_prewedding    = secure_input($_POST['duration_prewedding']);
        $qty_album              = secure_input($_POST['qty_album']);
        $photo_album_size       = secure_input($_POST['photo_album_size']);
        $qty_gallery            = secure_input($_POST['qty_gallery']);
        $photo_gallery_size     = secure_input($_POST['photo_gallery_size']);

        $package_nameErr        = package_nameValidation($package_name);
        $duration_preweddingErr = duration_preweddingValidation($duration_prewedding);
        $qty_albumErr           = qty_albumValidation($qty_album);
        $photo_album_sizeErr    = photo_album_sizeValidation($photo_album_size);
        $qty_galleryErr         = qty_galleryValidation($qty_gallery);
        $photo_gallery_sizeErr  = photo_gallery_sizeValidation($photo_gallery_size);

        if ($package_nameErr=="" && $duration_preweddingErr=="" && $qty_albumErr=="" && $photo_album_sizeErr=="" && $qty_galleryErr=="" && $photo_gallery_sizeErr=="" ) {

            $sql = "INSERT INTO pkg_photo_video values (null, '$package_name','$duration_prewedding','$qty_album ','$photo_album_size','$qty_gallery','$photo_gallery_size')";
            $res = mysqli_query($link,$sql);

            if($res){
                header('location: ../package.php?sdm=pkg_photo_video');
            }else{
                echo "Tambah data gagal";
            }
        } else {
            echo $package_nameErr.'<br>'; 
            echo $duration_preweddingErr.'<br>'; 
            echo $qty_albumErr.'<br>'; 
            echo $photo_album_sizeErr.'<br>'; 
            echo $qty_galleryErr.'<br>'; 
            echo $photo_gallery_sizeErr.'<br>'; 
            echo "<a href='../package.php?pkgPV=add'>Masukan Data Lagi</a>";
        }
    }

    function updatePPV($id_package) {
        $data = array();
        $data_update = array();
        $link = koneksi_db();

        $sql = "SELECT * FROM pkg_photo_video WHERE id_pkg_photo_video='$id_package'";
        $res = mysqli_query($link,$sql);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "id_pkg_photo_video"    => $row['id_pkg_photo_video'],
                    "package_name"          => $row['package_name'],
                    "duration_prewedding"   => $row['duration_prewedding'],
                    "qty_album"             => $row['qty_album'],
                    "photo_album_size"      => $row['photo_album_size'],
                    "qty_gallery"           => $row['qty_gallery'],
                    "photo_gallery_size"    => $row['photo_gallery_size']
                );
            }
        }

        include("pkg_photo_video_update.php");
        
        if (isset($_POST['updateDataSubmit'])) {

            $id_pkg_photo_video     = secure_input($data['id_pkg_photo_video']);
            $package_name           = secure_input($_POST['package_name']);
            $duration_prewedding    = secure_input($_POST['duration_prewedding']);
            $qty_album              = secure_input($_POST['qty_album']);
            $photo_album_size       = secure_input($_POST['photo_album_size']);
            $qty_gallery            = secure_input($_POST['qty_gallery']);
            $photo_gallery_size     = secure_input($_POST['photo_gallery_size']);

            $package_nameErr        = package_nameValidation($package_name);
            $duration_preweddingErr = duration_preweddingValidation($duration_prewedding);
            $qty_albumErr           = qty_albumValidation($qty_album);
            $photo_album_sizeErr    = photo_album_sizeValidation($photo_album_size);
            $qty_galleryErr         = qty_galleryValidation($qty_gallery);
            $photo_gallery_sizeErr  = photo_gallery_sizeValidation($photo_gallery_size);

            if ($package_nameErr=="" && $duration_preweddingErr=="" && $qty_albumErr=="" && $photo_album_sizeErr=="" && $qty_galleryErr=="" && $photo_gallery_sizeErr=="" ) {
            
                $sql = "UPDATE pkg_photo_video
                        SET
                        package_name          = '$package_name',
                        duration_prewedding   = '$duration_prewedding',
                        qty_album             = '$qty_album',
                        photo_album_size      = '$photo_album_size',
                        qty_gallery           = '$qty_gallery',
                        photo_gallery_size    = '$photo_gallery_size'
                        WHERE pkg_photo_video.id_pkg_photo_video = $id_package";

                $res = mysqli_query($link,$sql);

                if($res){
                    header('location: package.php?sdm=pkg_photo_video');
                }else{
                    echo "Tambah data gagal";
                }
            } else {
                echo $package_nameErr.'<br>'; 
                echo $duration_preweddingErr.'<br>'; 
                echo $qty_albumErr.'<br>'; 
                echo $photo_album_sizeErr.'<br>'; 
                echo $qty_galleryErr.'<br>'; 
                echo $photo_gallery_sizeErr.'<br>'; 
            }
        }
    }

    function deletePPV($id) {
        $sql = "DELETE FROM pkg_photo_video where id_pkg_photo_video = '$id'";
        $link = koneksi_db();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location: ../package.php?sdm=pkg_photo_video');
         }else{
             echo "Tambah data gagal";
         }
    }

    function search($category,$search){
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_photo_video WHERE $category LIKE '%$search%'";
        $res = mysqli_query($link,$sql);
        
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return $res;
        }
    }
    function package_nameValidation($package_name) {
        if (empty($package_name)) {
            $packageErr = "Package Name is required";
        } else {
            $packageErr = "";
        }
        return $packageErr;
    }

    function duration_preweddingValidation($duration_prewedding) {
        if (empty($duration_prewedding)) {
            $duration_preweddingErr = "Duration prewedding Name is required";
        } else {
            $duration_preweddingErr = "";
        }
        return $duration_preweddingErr;
    }

    function qty_albumValidation($qty_album) {
        if (empty($qty_album)){
            $qty_albumErr = "Qty album is required";
        } elseif(!is_numeric($qty_album)) {
            $qty_albumErr = "Qty album accepts only number";
        } else {
            $qty_albumErr = "";
        }
        return $qty_albumErr;
    }

    function photo_album_sizeValidation($photo_album_size) {
        if (empty($photo_album_size)) {
            $photo_album_sizeErr = "Photo album size is required";
        } else {
            $photo_album_sizeErr = "";
        }
        return $photo_album_sizeErr;
    }

    function qty_galleryValidation($qty_gallery) {
        if (empty($qty_gallery)){
            $qty_galleryErr = "Qty gallery is required";
        } elseif(!is_numeric($qty_gallery)) {
            $qty_galleryErr = "Qty gallery accepts only number";
        } else {
            $qty_galleryErr = "";
        }
        return $qty_galleryErr;
    }

    function photo_gallery_sizeValidation($photo_gallery_size) {
        if (empty($photo_gallery_size)) {
            $photo_gallery_sizeErr = "Photo gallery size is required";
        } else {
            $photo_gallery_sizeErr = "";
        }
        return $photo_gallery_sizeErr;
    }
?>
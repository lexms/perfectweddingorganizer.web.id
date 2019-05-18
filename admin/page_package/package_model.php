<?php 

    ob_start();

    require_once("../database.php");

    require_once("inputValidation.php");

    //get Link

    

    function getLinkDatabase() {

        return koneksi_db();  

    }



    if (isset($_GET['id_package'])) {

        $id_package = $_GET['id_package'];

        if (isset($_GET['method'])) {

            if (($_GET['method']) == "edit") {

                updatePackage($id_package);

            } elseif (($_GET['method']) == "delete") {

                deletePackage($id_package);

            }

        }

    }



    if (isset($_POST['addDataSubmit'])) {

        addDataPackage();

    }



    function selectPPV($id) {

        $link = koneksi_db();

        if ($id == 0) {

            $sqlPPV = "SELECT * FROM pkg_photo_video";

        } else {

            $sqlPPV = "SELECT * FROM pkg_photo_video WHERE id_pkg_photo_video = '$id'";

        } 

        $resPPV = mysqli_query($link,$sqlPPV);

        return $resPPV;

    }



    function selectMusic($id) {

        $link = koneksi_db();

        if ($id == 0) {

            $sqlMusic = "SELECT * FROM pkg_music";

        } else {

            $sqlMusic = "SELECT * FROM pkg_music WHERE id_pkg_music = '$id'";

        }

        $resMusic = mysqli_query($link,$sqlMusic);

        return $resMusic;

    }



    function selectCatering($id) {

        $link = koneksi_db();

        if ($id == 0) {

            $sqlCatering = "SELECT * FROM pkg_catering";

        } else {

            $sqlCatering = "SELECT * FROM pkg_catering WHERE id_pkg_catering = '$id'"; 

        } 

        $resCatering = mysqli_query($link,$sqlCatering);

        return $resCatering;

    }



    function selectAllPackage() {

        $link = koneksi_db();

        $sql = "SELECT * FROM package";

        $res = mysqli_query($link,$sql);

        return $res;

    }

 

    if (isset($_POST['search'])) {

        if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {

            $category = $_POST['category'];

            $input_search = $_POST['input_search'];   

            $hasil_search = search($category,$input_search);       

            return $hasil_search;

        }

    }

    

    function addDataPackage() {



        $package_name       = secure_input($_POST['package_name']);

        $package_price      = secure_input($_POST['package_price']);

        $qty_WO_personil    = secure_input($_POST['qty_WO_personil']);

        $id_pkg_photo_video = secure_input($_POST['id_pkg_photo_video']);

        $id_pkg_music       = secure_input($_POST['id_pkg_music']);

        $id_pkg_catering    = secure_input($_POST['id_pkg_catering']);

        $package_desc       = secure_input($_POST['package_desc']);



        $packageErr             = packageValidation($package_name);

        $package_priceErr       = package_priceValidation($package_price);

        $qty_WO_personilErr     = qty_WO_personilValidation($qty_WO_personil);

        $id_pkg_photo_videoErr  = id_pkg_photo_videoValidation($id_pkg_photo_video);

        $id_pkg_musicErr        = id_pkg_musicValidation($id_pkg_music);

        $id_pkg_cateringErr     = id_pkg_cateringValidation($id_pkg_catering);

        $package_descErr        = packageDescValidation($package_desc);



        $link = koneksi_db();



        if (($packageErr=="") && ($package_priceErr=="") && ($qty_WO_personilErr=="") && ($id_pkg_photo_videoErr=="") && ($id_pkg_musicErr=="") && ($id_pkg_cateringErr=="") && ($package_descErr=="")) {



            $sql = "insert into package values (null ,'$package_name',$package_price,'$qty_WO_personil',$id_pkg_photo_video,$id_pkg_music,$id_pkg_catering,'$package_desc')";

            $res = mysqli_query($link,$sql);



            if($res){

                header('location: ../package.php?sdm=main_package');

            }else{

                echo "Tambah data gagal";

            }

            

        } else {

            echo $packageErr.'<br>';

            echo $package_priceErr.'<br>';

            echo $qty_WO_personilErr.'<br>';

            echo $id_pkg_photo_videoErr.'<br>';

            echo $id_pkg_musicErr.'<br>';

            echo $id_pkg_cateringErr.'<br>';

            echo $package_descErr.'<br>';

            echo "<a href='../package.php?pkg=add'>Masukan Data Lagi</a>";

        }

}



    function updatePackage($id_package) {

        $data = array();

        $data_update = array();

        $link = koneksi_db();

        $sql = "SELECT * FROM package WHERE id_package='$id_package'";

        $res = mysqli_query($link,$sql);

        $data=mysqli_fetch_array($res);

        

        $id_PV = $data['id_pkg_photo_video'];

        $id_music = $data['id_pkg_music'];

        $id_catering = $data['id_pkg_catering'];



        $resPPV = selectPPV($id_PV);

        $resMusic = selectMusic($id_music);

        $resCatering = selectCatering($id_catering);



        $dataPPV = mysqli_fetch_array($resPPV);

        $dataMusic = mysqli_fetch_array($resMusic);

        $dataCatering = mysqli_fetch_array($resCatering);



        if (mysqli_num_rows($res) > 0) {

            // output data of each row  

            while($row = mysqli_fetch_assoc($res)) {

                $data = array (

                    "id_package"         => $row['id_package'],

                    "package_name"       => $row['package_name'],

                    "package_price"      => $row['package_price'],

                    "qty_WO_personil"    => $row['qty_WO_personil'],

                    "name_pkg_photo_video" => $dataPPV['package_name'],

                    "name_pkg_music"       => $dataMusic['package_name'],

                    "name_pkg_catering"    => $dataCatering['package_name'],

                    "package_desc"         => $row['id_package']

                );

            }

        }



        $selected = $dataPPV['id_pkg_photo_video'];

        $res = false;

   

        include("package_update.php");

        if (isset($_POST['updateDataSubmit'])) {

            

            $package_name       = secure_input($_POST['package_name']);

            $package_price      = secure_input($_POST['package_price']);

            $qty_WO_personil    = secure_input($_POST['qty_WO_personil']);

            $id_pkg_photo_video = secure_input($_POST['id_pkg_photo_video']);

            $id_pkg_music       = secure_input($_POST['id_pkg_music']);

            $id_pkg_catering    = secure_input($_POST['id_pkg_catering']);

            $package_desc       = secure_input($_POST['package_desc']);



            $packageErr             = packageValidation($package_name);

            $package_priceErr       = package_priceValidation($package_price);

            $qty_WO_personilErr     = qty_WO_personilValidation($qty_WO_personil);

            $id_pkg_photo_videoErr  = id_pkg_photo_videoValidation($id_pkg_photo_video);

            $id_pkg_musicErr        = id_pkg_musicValidation($id_pkg_music);

            $id_pkg_cateringErr     = id_pkg_cateringValidation($id_pkg_catering);

            $package_descErr        = packageDescValidation($package_desc);

            

            if (($packageErr=="") && ($package_priceErr=="") && ($qty_WO_personilErr=="") && ($id_pkg_photo_videoErr=="") && ($id_pkg_musicErr=="") && ($id_pkg_cateringErr=="") && ($package_descErr=="")) { 

                $sql = "UPDATE `package` 

                        SET 

                        package_name        = '$package_name',

                        package_price       = '$package_price',

                        qty_WO_personil     = '$qty_WO_personil',

                        id_pkg_photo_video  = '$id_pkg_photo_video',

                        id_pkg_music        = '$id_pkg_music',

                        id_pkg_catering     = '$id_pkg_catering',

                        package_desc        = '$package_desc'

                        WHERE package.id_package = $id_package";

                

                $res = mysqli_query($link,$sql);



                if($res){

                header('location: package.php?sdm=main_package');

                }else{

                    echo "Tambah data gagal";

                }

            } else {

                echo $packageErr.'<br>';

                echo $package_priceErr.'<br>';

                echo $qty_WO_personilErr.'<br>';

                echo $id_pkg_photo_videoErr.'<br>';

                echo $id_pkg_musicErr.'<br>';

                echo $package_descErr.'<br>';

            }



        }

    }



    function deletePackage($id) {

        $sql = "DELETE FROM package where id_package = '$id'";

        $link = koneksi_db();

        $res = mysqli_query($link,$sql);

        if($res){

            header('location: package.php?sdm=main_package');

         }else{

             echo "Tambah data gagal";

         }

    }



    function search($category,$search){

        $link = getLinkDatabase();

        $sql = "SELECT * FROM package WHERE $category Like '%$search%'";

        $res = mysqli_query($link,$sql);

        

        if ($res->num_rows > 0) {

            return $res;

        } else {

            return $res;

        }

    }



    //Validasi Input Data

    function packageValidation($package_name) {

        if (empty($package_name)) {

            $packageErr = "Package Name is required";

        } else {

            $packageErr = "";

        }

        return $packageErr;

    }



    function package_priceValidation($package_price) {

        if (empty($package_price)){

            $package_priceErr = "Package price is required";

        } elseif(!is_numeric($package_price)) {

            $package_priceErr = "Package price accepts only number";

        } else {

            $package_priceErr = "";

        }

        return $package_priceErr;

    }



    function qty_WO_personilValidation($qty_WO_personil) {

        if (empty($qty_WO_personil)){

            $qty_WO_personilErr = "qty WO personil is required";

        } elseif(!is_numeric($qty_WO_personil)) {

            $qty_WO_personilErr = "qty WO personil accepts only number";

        } else {

            $qty_WO_personilErr = "";

        }

        return $qty_WO_personilErr;

    }



    function id_pkg_photo_videoValidation($id_pkg_photo_video) {

        if (empty($id_pkg_photo_video)){

            $id_pkg_photo_videoErr = "Package photo video is required";

        } elseif(!is_numeric($id_pkg_photo_video)) {

            $id_pkg_photo_videoErr = "ID package photo video only number";

        } else {

            $id_pkg_photo_videoErr = "";

        }

        return $id_pkg_photo_videoErr;

    }



    function id_pkg_musicValidation($id_pkg_music) {

        if (empty($id_pkg_music)){

            $id_pkg_musicErr = "Package music is required";

        } elseif(!is_numeric($id_pkg_music)) {

            $id_pkg_musicErr = "ID package accepts only number";

        } else {

            $id_pkg_musicErr = "";

        }

        return $id_pkg_musicErr;

    }



    function id_pkg_cateringValidation($id_pkg_catering) {

        if (empty($id_pkg_catering)){

            $id_pkg_cateringErr = "Package catering is required";

        } elseif(!is_numeric($id_pkg_catering)) {

            $id_pkg_cateringErr = "ID package Max capacity accepts only number";

        } else {

            $id_pkg_cateringErr = "";

        }

        return $id_pkg_cateringErr;

    }



    function packageDescValidation($package_desc) {

        if (empty($package_desc)) {

            $package_descErr = "Package Description is required";

        } else {

            $package_descErr = "";

        }

        return $package_descErr;

    }





?>
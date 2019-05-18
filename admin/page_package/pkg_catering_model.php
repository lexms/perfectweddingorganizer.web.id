<?php
ob_start();
require_once('inputValidation.php');
    require_once("../database.php");

    function getLinkDatabase() {
        return koneksi_db();  
    }

    if (isset($_POST['addDataSubmit'])) {
        addPkgcatering();
    }

    if (isset($_POST['search'])) {
        if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
            $category = $_POST['category'];
            $input_search = $_POST['input_search'];   
            $hasil_search = search($category,$input_search);       
            return $hasil_search;
        }
    }

    if (isset($_GET['id_pkg_catering'])) {
        $id_pkg_catering = $_GET['id_pkg_catering'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePkgCatering($id_pkg_catering);
            } elseif (($_GET['method']) == "delete") {
                deletePkgCatering($id_pkg_catering);
            }
        }
    }

    function selectAllpkgCatering() {
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_catering";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    function addPkgCatering() {
        $link = getLinkDatabase();

        $package_name           = secure_input($_POST['package_name']);
        $qty_type_main_course   = secure_input($_POST['qty_type_main_course']);
        $qty_type_dessert       = secure_input($_POST['qty_type_dessert']);

        $package_nameErr           = package_nameValidation($package_name);
        $qty_type_main_courseErr   = qty_type_main_courseValidation($qty_type_main_course);
        $qty_type_dessertErr       = qty_type_dessertValidation($qty_type_dessert);

        if ($package_nameErr==""  && $qty_type_main_courseErr=="" && $qty_type_dessertErr=="") {
            
            $sql = "INSERT INTO pkg_catering values (null, '$package_name','$qty_type_main_course','$qty_type_dessert')";
            $res = mysqli_query($link,$sql);

            if($res){
                header('location: ../package.php?sdm=pkg_catering');
            }else{
                echo "Tambah data gagal";
            }
        } else {
            echo $package_nameErr.'<br>'; 
            echo $qty_type_main_courseErr.'<br>';
            echo $qty_type_dessertErr.'<br>';
            echo "<a href='../package.php?pkgCatering=add'>Masukan Data Lagi</a>";
        }
        
    }

    function updatePkgCatering($id_package) {
        $data = array();
        $data_update = array();
        $link = getLinkDatabase();

        $sql = "SELECT * FROM pkg_catering WHERE id_pkg_catering='$id_package'";
        $res = mysqli_query($link,$sql);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "package_name"           => $row['package_name'],
                    "qty_type_main_course"   => $row['qty_type_main_course'],
                    "qty_type_dessert"       => $row['qty_type_dessert']
                );
            }
        }

        include("pkg_catering_update.php");
        if (isset($_POST['updateDataSubmit'])) {

            $package_name           = secure_input($_POST['package_name']);
            $qty_type_main_course   = secure_input($_POST['qty_type_main_course']);
            $qty_type_dessert       = secure_input($_POST['qty_type_dessert']);

            $package_nameErr           = package_nameValidation($package_name);
            $qty_type_main_courseErr   = qty_type_main_courseValidation($qty_type_main_course);
            $qty_type_dessertErr       = qty_type_dessertValidation($qty_type_dessert);

            if ($package_nameErr=="" &&  $qty_type_main_courseErr=="" && $qty_type_dessertErr=="") {
            
            
                $sql = "UPDATE pkg_catering
                    SET
                    package_name            = '$package_name',
                    qty_type_main_course    = '$qty_type_main_course',
                    qty_type_dessert        = '$qty_type_dessert'
                    WHERE pkg_catering.id_pkg_catering = $id_package";

                $res = mysqli_query($link,$sql);

                if($res){
                    header('location: package.php?sdm=pkg_catering');
                }else{
                    echo "Tambah data gagal";
                }
            } else {
                echo $package_nameErr.'<br>'; 
                echo $qty_type_main_courseErr.'<br>';
                echo $qty_type_dessertErr.'<br>';
            }
        }
    }

    function deletePkgCatering($id) {
        $sql = "DELETE FROM pkg_catering where id_pkg_catering = '$id'";
        $link = getLinkDatabase();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location: ../package.php?sdm=pkg_catering');
        }else{
            echo "Tambah data gagal";
        }
    }

    function search($category,$search){
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_catering WHERE $category LIKE '%$search%'";
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

    function qty_type_main_courseValidation($qty_type_main_course) {
        if (empty($qty_type_main_course)){
            $qty_type_main_courseErr = "Qty type main course is required";
        } elseif(!is_numeric($qty_type_main_course)) {
            $qty_type_main_courseErr = "qty type main course accepts only number";
        } else {
            $qty_type_main_courseErr = "";
        }
        return $qty_type_main_courseErr;
    }

    function qty_type_dessertValidation($qty_type_dessert) {
        if (empty($qty_type_dessert)){
            $qty_type_dessertErr = "Qty type dessert is required";
        } elseif(!is_numeric($qty_type_dessert)) {
            $qty_type_dessertErr = "qty type dessert accepts only number";
        } else {
            $qty_type_dessertErr = "";
        }
        return $qty_type_dessertErr;
    }
?>
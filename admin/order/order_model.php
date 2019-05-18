<?php 
    ob_start();
    require_once("../database.php");
    require_once("inputValidation.php");
    //get Link
    
    function getLinkDatabase() {
        return koneksi_db();  
    }

    if (isset($_GET['id_order'])) {
        $id_order = $_GET['id_order'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updateorders($id_order);
            } elseif (($_GET['method']) == "delete") {
                deleteorders($id_order);
            }
        }
    }

    if (isset($_POST['addDataSubmit'])) {
        addDataorders();
    }

    function selectPackage($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM package";
        } else {
            $sqlPPV = "SELECT * FROM package WHERE id_package = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectVenue($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM venue";
        } else {
            $sqlPPV = "SELECT * FROM venue WHERE id_venue = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectMC($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM mc";
        } else {
            $sqlPPV = "SELECT * FROM mc WHERE id_mc = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectVMakeup($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM vendor_makeup";
        } else {
            $sqlPPV = "SELECT * FROM vendor_makeup WHERE id_vendor_makeup = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectVPVV($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM vendor_photo_video";
        } else {
            $sqlPPV = "SELECT * FROM vendor_photo_video WHERE id_vendor_photo_video = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectVCatering($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM vendor_catering";
        } else {
            $sqlPPV = "SELECT * FROM vendor_catering WHERE id_vendor_catering = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectVMusic($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM vendor_music";
        } else {
            $sqlPPV = "SELECT * FROM vendor_music WHERE id_vendor_music = '$id'";
        } 
        $res = mysqli_query($link,$sqlPPV);
        return $res;
    }

    function selectPayments($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlPayments = "SELECT * FROM payments";
        } else {
            $sqlPayments = "SELECT * FROM payments   WHERE id_payment = '$id'"; 
        } 
        $resPayments = mysqli_query($link,$sqlPayments);
        return $resPayments;
    }

    function selectCustomer($id) {
        $link = koneksi_db();
        if ($id == 0) {
            $sqlCustomer = "SELECT * FROM customers";
        } else {
            $sqlCustomer = "SELECT * FROM customers   WHERE id_customer = '$id'"; 
        } 
        $resCustomer = mysqli_query($link,$sqlCustomer);
        return $resCustomer;
    }

    function selectAllorders() {
        $link = koneksi_db();
        $sql = "SELECT * FROM orders";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    function selectAllordersDesc() {
        $link = koneksi_db();
        $sql = "SELECT * FROM `orders` ORDER BY `id_order` DESC LIMIT 5 ";
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

    function updateorders($id_order) {
        $data = array();
        $data_update = array();
        $link = koneksi_db();

        $sql = "SELECT * FROM orders WHERE id_order =  '$id_order'";
        $res = mysqli_query($link,$sql);
        $data=mysqli_fetch_array($res);
        
        $id_package     = $data['id_package'];
        $id_venue       = $data['id_venue'];
        $id_mc          = $data['id_mc'];
        $id_VMakeup     = $data['id_vendor_makeup'];
        $id_VPVV        = $data['id_vendor_photo_video'];
        $id_VCatering   = $data['id_vendor_catering'];
        $id_VMusic      = $data['id_vendor_music'];
        $id_payment     = $data['id_payment'];
        $id_customer    = $data['id_customer'];

        $resPackage     = selectPackage($id_package);
        $resVenue       = selectVenue($id_venue);
        $resMC          = selectMC($id_mc);
        $resVMakeup     = selectVMakeup($id_VMakeup);
        $resVPVV        = selectVPVV($id_VPVV);
        $resVCatering   = selectVCatering($id_VCatering);
        $resVMusic      = selectVMusic($id_VMusic);
        $resPayment     = selectPayments($id_payment);
        $resCustomer    = selectCustomer($id_customer);

        $dataPackage    = mysqli_fetch_array($resPackage);
        $dataVenue      = mysqli_fetch_array($resVenue);
        $dataMC         = mysqli_fetch_array($resMC);
        $dataVMakeup    = mysqli_fetch_array($resVMakeup);
        $dataVPVV       = mysqli_fetch_array($resVPVV);
        $dataVCatering  = mysqli_fetch_array($resVCatering);
        $dataVMusic     = mysqli_fetch_array($resVMusic);
        $dataPayment    = mysqli_fetch_array($resPayment);
        $dataCustomer   = mysqli_fetch_array($resCustomer);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "id_order"          => $row['id_order'],
                    "order_date"        => $row['order_date'],
                    "name_package"      => $dataPackage['package_name'],
                    "wedding_date"      => $row['wedding_date'],
                    
                    "wedding_name"      => $row['wedding_name'],
                    "name_bridegroom"   => $row['name_bridegroom'],
                    "name_bride"        => $row['name_bride'],

                    "name_venue"        => $dataVenue['venue_name'],
                    "name_MC"           => $dataMC['name'],
                    "name_VMakeup"      => $dataVMakeup['name'],
                    "name_VPVV"         => $dataVPVV['name'],
                    "name_VCatering"    => $dataVCatering['name'],
                    "name_VMusic"       => $dataVMusic['name']
                    
                );
            }
        }

        $selected = array(
            "id_package"    => $data['id_package'], 
            "id_venue"      => $data['id_venue'],
            "id_mc"         => $data['id_mc'],
            "id_VMakeup"    => $data['id_vendor_makeup'],
            "id_VPVV"       => $data['id_vendor_photo_video'],
            "id_VCatering"  => $data['id_vendor_catering'],
            "id_VMusic"     => $data['id_vendor_music']
        );
        $res = false;
        $checked1="";
        $checked2="";
        if ($dataPayment['status']=='1') {
            $checked1 = "checked";
        } else {
            $checked2 = "checked";
        }

        include("order_update.php");
        if (isset($_POST['updateDataSubmit'])) {
            
            $id_package        = secure_input($_POST['id_package']);
            $wedding_date      = secure_input($_POST['wedding_date']);
                    
            $wedding_name      = secure_input($_POST['wedding_name']);
            $name_bridegroom   = secure_input($_POST['name_bridegroom']);
            $name_bride        = secure_input($_POST['name_bride']);

            $id_venue        = secure_input($_POST['id_venue']);
            $id_mc           = secure_input($_POST['id_mc']);
            $id_VMakeup      = secure_input($_POST['id_VMakeup']);
            $id_VPVV         = secure_input($_POST['id_VPVV']);
            $id_VCatering    = secure_input($_POST['id_VCatering']);
            $id_VMusic       = secure_input($_POST['id_VMusic']);

            $bank_name          = secure_input($_POST['bank_name']);
            $status             = secure_input($_POST['status']);
            $DP                 = secure_input($_POST['DP']);

            $bank_nameErr         = bank_nameValidation($bank_name);
            $DPErr                = DPValidation($DP);
            $wedding_dateErr      = wedding_dateValidation($wedding_date);
            $wedding_nameErr      = wedding_nameValidation($wedding_name);
            $name_bridegroomErr   = name_bridegroomValidation($name_bridegroom);
            $name_brideErr        = name_brideValidation($name_bride);
            
            if (($wedding_dateErr=="") && ($wedding_nameErr=="") && ($name_bridegroomErr=="") && ($name_brideErr=="") && ($bank_nameErr=="") && ($DPErr=="")) { 
                $sqlorders = "UPDATE `orders` 
                        SET 
                        id_package          = $id_package,
                        wedding_date        = '$wedding_date',
                        wedding_name        = '$wedding_name',
                        name_bridegroom     = '$name_bridegroom',
                        name_bride          = '$name_bride',
                        id_venue            = $id_venue,
                        id_mc               = $id_mc,
                        id_vendor_makeup        = $id_VMakeup,
                        id_vendor_photo_video   = $id_VPVV,
                        id_vendor_catering      = $id_VCatering,
                        id_vendor_music         = $id_VMusic
                        WHERE orders.id_order = $id_order";
                
                $resorders = mysqli_query($link,$sqlorders);

                $sqlpayments = "UPDATE `payments` 
                        SET 
                        `bank_name` = '$bank_name', 
                        `status` = '$status',
                        `DP` = '$DP' 
                        WHERE `payments`.`id_payment` = $id_payment";

                $respayments = mysqli_query($link,$sqlpayments);

                if($resorders){
                    if($respayments) {
                        header('location: order.php');
                    }
                }else{
                    echo "Tambah data gagal";
                }
            } else {
                echo "$wedding_dateErr.<br>";
                echo "$wedding_nameErr.<br>";
                echo "$name_bridegroomErr.<br>";
                echo "$name_brideErr.<br>";
                echo "$bank_nameErr.<br>";
                echo "$DPErr.<br>";
            }

        }
    }

    function deleteorders($id) {
        $sql = "DELETE FROM orders where id_order = '$id'";
        $link = koneksi_db();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location: order.php');
         }else{
             echo "Tambah data gagal";
         }
    }

    function search($category,$search){
        $link = getLinkDatabase();
        $sql = "SELECT * FROM orders WHERE $category Like '%$search%'";
        $res = mysqli_query($link,$sql);
        
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return $res;
        }
    }

    //Validasi Input Data
    function wedding_dateValidation($orders_name) {
        if (empty($orders_name)) {
            $wedding_dateErr = "orders Date is required";
        } else {
            $wedding_dateErr = "";
        }
        return $wedding_dateErr;
    }

    function wedding_nameValidation($orders_name) {
        if (empty($orders_name)) {
            $wedding_nameErr = "orders Name is required";
        } else {
            $wedding_nameErr = "";
        }
        return $wedding_nameErr;
    }

    function name_bridegroomValidation($orders_name) {
        if (empty($orders_name)) {
            $name_bridegroomErr = "orders Name is required";
        } else {
            $name_bridegroomErr = "";
        }
        return $name_bridegroomErr;
    }

    function name_brideValidation($orders_name) {
        if (empty($orders_name)) {
            $name_bridesErr = "orders Name is required";
        } else {
            $name_brideErr = "";
        }
        return $name_brideErr;
    }

    function bank_nameValidation($bank_name) {
        if (empty($bank_name)) {
            $bank_nameErr = "Bank Name is required";
        } else {
            $bank_nameErr = "";
        }
        return $bank_nameErr;
    }

    function DPValidation($DP) {
        if ($DP < 1000000){
            $DPValidationErr = "DP minimal 1000000";
        } elseif(!is_numeric($DP)) {
            $DPValidationErr = "qty type dessert accepts only number";
        } else {
            $DPValidationErr = "";
        }
        return $DPValidationErr;
    }
?>
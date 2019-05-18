    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_vendor_photo_video'])) {
            $id_vendor_photo_video = $_GET['id_vendor_photo_video'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editPM($id_vendor_photo_video);
                } elseif (($_GET['method']) == "delete") {
                    deletePM($id_vendor_photo_video);
                }
            } else {
                echo 'ID Tidak ditemukan';
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDataid_vendor_photo_video();
        }

        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }
        
            
        function addDataid_vendor_photo_video(){
        $link = getLinkDatabase();
            
                $pm_name = secure_input($_POST['pm_name']);
                $phone_number = secure_input($_POST['phone_number']);
                $address = secure_input($_POST['address']);    

                $PVNameErr =  vendor_photo_videoValidation($pm_name);
                $PVPhoneNumberErr =  vendor_photo_videoPhoneNumberValidation($phone_number);
                $PVAddressErr  =   vendor_photo_videoAddressValidation($address);

                if ( ($PVNameErr=="") && ($PVPhoneNumberErr=="") && ($PVAddressErr=="")) {
                    $data = array(
                            'name' => $pm_name,
                            'phone_number' => $phone_number,
                            'address' => $address
                        );
                    saveDataVenue($link,$data);
                } else {
                    include 'id_vendor_photo_video_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllPV(){
            $sql = 'SELECT * FROM `vendor_photo_video`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editPM($id_vendor_photo_video){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_photo_video WHERE id_vendor_photo_video='$id_vendor_photo_video'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_vendor_photo_video" => $row['id_vendor_photo_video'],
                        "name" => $row['name'],
                        "phone_number" => $row['phone_number'],
                        "address" => $row['address'],
                    );
                }       
            }    
            
            include("vendor_photovideo_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_vendor_photo_video" => $data['id_vendor_photo_video'],
                    "name" => secure_input($_POST['pm_name']),
                    "phone_number" => secure_input($_POST['phone_number']),
                    "address" => secure_input($_POST['address']),
                );

                $PVNameErr =  vendor_photo_videoValidation($_POST['pm_name']);
                $PVPhoneNumberErr =  vendor_photo_videoPhoneNumberValidation($_POST['phone_number']);
                $PVAddressErr  =   vendor_photo_videoAddressValidation($_POST['address']);
                
                if ( ($PVNameErr=="") && ($PVPhoneNumberErr=="") && ($PVAddressErr=="")) {
                    $sql = "UPDATE `vendor_photo_video` 
                    SET 
                    `name` = '$data_update[name]', 
                    `phone_number` = '$data_update[phone_number]', 
                    `address` = '$data_update[address]'
                    WHERE `vendor_photo_video`.`id_vendor_photo_video` = $id_vendor_photo_video";
                
                $res = mysqli_query($link,$sql);
                
                
                if ($res) {
                        header('Location: ?sdm=photovideo');
                    } else {
                        "<h1> Failed to update data </h1>";
                    }
                } else {
                       echo $PVNameErr.'<br>';
                        echo $PVPhoneNumberErr.'<br>';
                        echo $PVAddressErr.'<br>';
                }   
            }
                
            
        }

        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_photo_video WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }
        // function saveData

        function saveDataVenue($link,$data){
            $sql = "INSERT INTO `vendor_photo_video` 
            (`id_vendor_photo_video`, `name`, `phone_number`, `address`) 
            VALUES (NULL, '$data[name]', '$data[phone_number]', '$data[address]')";
            $res = mysqli_query($link,$sql);
            var_dump($res);
            if ($res) {
                header('Location: ?sdm=photovideo');
            } else {
                header('Location: ?sdm=photovideo_add');
            }
        }

        function deletePM($id){
            $sql = "DELETE FROM `vendor_photo_video` WHERE `vendor_photo_video`.`id_vendor_photo_video` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: ?sdm=photovideo');
            
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function vendor_photo_videoValidation($id_vendor_photo_videoNameData){
            if (empty($id_vendor_photo_videoNameData)) {
                $PVNameErr = "id_vendor_photo_video Name is required";
            } else {
                $PVNameErr = "";
            }
            return $PVNameErr;
        }

        function vendor_photo_videoPhoneNumberValidation($phoneNumberData){
            if (empty($phoneNumberData)) {
                $phoneNumberErr = "Phone Number is required";
            } else {
                $phoneNumberErr = "";
            }
            return $phoneNumberErr;
        }

        function vendor_photo_videoAddressValidation($addressData){
            if (empty($addressData)) {
                $addressErr = "Address is required";
            } else {
                $addressErr = "";
            }
            return $addressErr;
        }


        
    ?>         
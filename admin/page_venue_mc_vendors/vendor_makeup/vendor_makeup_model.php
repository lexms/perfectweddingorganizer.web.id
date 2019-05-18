    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_vendor_makeup'])) {
            $id_vendor_makeup = $_GET['id_vendor_makeup'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editVM($id_vendor_makeup);
                } elseif (($_GET['method']) == "delete") {
                    deleteVM($id_vendor_makeup);
                }
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDatavendor_makeup();
        }

        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }
        
            
        function addDatavendor_makeup(){
        $link = getLinkDatabase();
            
                $vm_name = secure_input($_POST['vm_name']);
                $phone_number = secure_input($_POST['phone_number']);
                $address = secure_input($_POST['address']);    

                $vMNameErr =  vendor_makeupNameValidation($vm_name);
                $vMPhoneNumberErr =  vendor_makeupPhoneNumberValidation($phone_number);
                $VMAddressErr  =   vendor_makeupAddressValidation($address);

                if ( ($vMNameErr=="") && ($vMPhoneNumberErr=="") && ($VMAddressErr=="")) {
                    $data = array(
                            'name' => $vm_name,
                            'phone_number' => $phone_number,
                            'address' => $address
                        );
                    saveDataVenue($link,$data);
                } else {
                    include 'vendor_makeup_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllVM(){
            $sql = 'SELECT * FROM `vendor_makeup`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editVM($id_vendor_makeup){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_makeup WHERE id_vendor_makeup='$id_vendor_makeup'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_vendor_makeup" => $row['id_vendor_makeup'],
                        "name" => $row['name'],
                        "phone_number" => $row['phone_number'],
                        "address" => $row['address'],
                    );
                }       
            }    

            
            include("vendor_makeup_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_vendor_makeup" => $data['id_vendor_makeup'],
                    "name" => secure_input($_POST['vm_name']),
                    "phone_number" => secure_input($_POST['phone_number']),
                    "address" => secure_input($_POST['address']),
                );
                
                $vMNameErr =  vendor_makeupNameValidation($_POST['vm_name']);
                $vMPhoneNumberErr =  vendor_makeupPhoneNumberValidation($_POST['phone_number']);
                $VMAddressErr  =   vendor_makeupAddressValidation($_POST['address']);

                if ( ($vMNameErr=="") && ($vMPhoneNumberErr=="") && ($VMAddressErr=="")) {
                    $sql = "UPDATE `vendor_makeup` 
                    SET 
                    `name` = '$data_update[name]', 
                    `phone_number` = '$data_update[phone_number]', 
                    `address` = '$data_update[address]'
                    WHERE `vendor_makeup`.`id_vendor_makeup` = $id_vendor_makeup";
                
                    $res = mysqli_query($link,$sql);
                    if ($res) {
                            header('Location: ?sdm=makeup');
                    } else {
                            "<h1> Failed to update data </h1>";
                    }
                } else {
                    echo $vMNameErr.'<br>';
                    echo $vMPhoneNumberErr.'<br>';
                    echo $VMAddressErr.'<br>';
                }
            }          
        }

        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_makeup WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }

        // function saveData

        function saveDataVenue($link,$data){
            $sql = "INSERT INTO `vendor_makeup` 
            (`id_vendor_makeup`, `name`, `phone_number`, `address`) 
            VALUES (NULL, '$data[name]', '$data[phone_number]', '$data[address]')";
            $res = mysqli_query($link,$sql);
            if ($res) {
                header('Location: ?sdm=makeup');
            } else {
                header('Location: ?sdm=makeup_add');
            }
        }

        function deleteVM($id){
            $sql = "DELETE FROM `vendor_makeup` WHERE `vendor_makeup`.`id_vendor_makeup` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: ?sdm=makeup');
            
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function vendor_makeupNameValidation($vendor_makeupNameData){
            if (empty($vendor_makeupNameData)) {
                $vMNameErr = "vendor_makeup Name is required";
            } else {
                $vMNameErr = "";
            }
            return $vMNameErr;
        }

        function vendor_makeupPhoneNumberValidation($phoneNumberData){
            if (empty($phoneNumberData)) {
                $phoneNumberErr = "Phone Number is required";
            } else {
                $phoneNumberErr = "";
            }
            return $phoneNumberErr;
        }

        function vendor_makeupAddressValidation($addressData){
            if (empty($addressData)) {
                $addressErr = "Address is required";
            } else {
                $addressErr = "";
            }
            return $addressErr;
        }


        
    ?>         
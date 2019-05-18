    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_vendor_catering'])) {
            $id_vendor_catering = $_GET['id_vendor_catering'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editVendorCatering($id_vendor_catering);
                } elseif (($_GET['method']) == "delete") {
                    deleteVendorCatering($id_vendor_catering);
                }
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDataVendorCatering();
        }
        
        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }

        function addDataVendorCatering(){
        $link = getLinkDatabase();
            
            $name = secure_input($_POST['name']);
                $phone_number = secure_input($_POST['phone_number']);
                $address = secure_input($_POST['address']);
                $availability = $_POST['availability'];  

                $nameErr = nameValidation($name);
                $phoneNumberErr = phoneNumberValidation($phone_number);
                $addressErr = addressValidation($address);
               

                
                if ( ($nameErr=="") && ($phoneNumberErr=="") && ($addressErr=="") ) {
                    $data = array(
                            'name' => $name,
                            'phone_number' => $phone_number,
                            'address' => $address,
                            'availability' => $availability                        
                        );
                    saveDataVendorCatering($link,$data);
                } else {
                    include 'vendor_catering_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllVendorCatering(){
            $sql = 'SELECT * FROM `vendor_catering`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editVendorCatering($id_vendor_catering){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_catering WHERE id_vendor_catering='$id_vendor_catering'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_vendor_catering" => $row['id_vendor_catering'],
                        "name" => $row['name'],
                        "phone_number" => $row['phone_number'],
                        "address" => $row['address'],
                        "availability" => $row['availability']                        
                    );
                }       
            }    

            
            
            include("vendor_catering_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_vendor_catering" => $data['id_vendor_catering'],
                    "name" => secure_input($_POST['name']),
                    "phone_number" => secure_input($_POST['phone_number']),
                    "address" => secure_input($_POST['address']),
                    "availability" => secure_input($_POST['availability'])                   
                );

                $nameErr = nameValidation($_POST['name']);
                $phoneNumberErr = phoneNumberValidation($_POST['phone_number']);
                $addressErr = addressValidation($_POST['address']);
                
                if ( ($nameErr=="") && ($phoneNumberErr=="") && ($addressErr=="") && ($availabilityErr=="") ) {
                    
                    $sql = "UPDATE `vendor_catering` 
                        SET 
                        `name` = '$data_update[name]', 
                        `phone_number` = '$data_update[phone_number]', 
                        `address` = '$data_update[address]',
                        `availability` = '$data_update[availability]' 
                        WHERE `vendor_catering`.`id_vendor_catering` = $id_vendor_catering";
                    
                    $res = mysqli_query($link,$sql);
                        if ($res) {
                        echo '<script>window.location="?sdm=catering"</script>';  
                        } else {
                            "<h1> Failed to update data </h1>";
                    }
                } else {
                    echo $nameErr.'<br>';
                    echo $phoneNumberErr.'<br>';
                    echo $addressErr.'<br>';
                 }
            } 
                
            
        }

        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_catering WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }


        // function saveData

        function saveDataVendorCatering($link,$data){
            $sql = "INSERT INTO `vendor_catering` 
            (`id_vendor_catering`, `phone_number`, `name`, `address`,`availability`) 
            VALUES (NULL, '$data[phone_number]', '$data[name]', '$data[address]', '$data[availability]')";
            $res = mysqli_query($link,$sql);
            if ($res) {
                header('Location: ?sdm=catering');
            } else {
                header('Location: ?sdm=catering_add');
            }
        }

        function deleteVendorCatering($id){
            $sql = "DELETE FROM `vendor_catering` WHERE `vendor_catering`.`id_vendor_catering` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: ?sdm=catering');
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function nameValidation($venueData){
            if (empty($venueData)) {
                $nameErr = "Name is required";
            } else {
                $nameErr = "";
            }
            return $nameErr;
        }

        function phoneNumberValidation($phone_number){
            if (empty($phone_number)){
                $phoneNumberErr = "Phone Number is required";
            } elseif(!is_numeric($phone_number)) {
                $phoneNumberErr = "Phone Number accepts only number";
            } else {
                $phoneNumberErr = "";
            }
            return $phoneNumberErr;
        }

        function addressValidation($address){
            if(empty($address)){
                $addressErr = "address is required";
            } else {
                $addressErr = "";
            }
            return $addressErr;
        }

            
               
    ?>         
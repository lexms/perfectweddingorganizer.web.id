    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_mc'])) {
            $id_mc = $_GET['id_mc'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editMc($id_mc);
                } elseif (($_GET['method']) == "delete") {
                    deleteMc($id_mc);
                }
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDataMc();
        }

        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }
        
            
        function addDataMc(){
        $link = getLinkDatabase();
            
                $mc_name = secure_input($_POST['mc_name']);
                $phone_number = secure_input($_POST['phone_number']);
                $address = secure_input($_POST['address']);    

                $mcNameErr =  mcNameValidation($mc_name);
                $mcPhoneNumberErr =  mcPhoneNumberValidation($phone_number);
                $mcAddressErr  =   mcAddressValidation($address);

                if ( ($mcNameErr=="") && ($mcPhoneNumberErr=="") && ($mcAddressErr=="")) {
                    $data = array(
                            'name' => $mc_name,
                            'phone_number' => $phone_number,
                            'address' => $address
                        );
                    saveDataVenue($link,$data);
                } else {
                    include 'mc_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllMC(){
            $sql = 'SELECT * FROM `mc`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editMc($id_mc){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM mc WHERE id_mc='$id_mc'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_mc" => $row['id_mc'],
                        "name" => $row['name'],
                        "phone_number" => $row['phone_number'],
                        "address" => $row['address'],
                    );
                }       
            }    

            
            include("mc_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_mc" => $data['id_mc'],
                    "name" => secure_input($_POST['mc_name']),
                    "phone_number" => secure_input($_POST['phone_number']),
                    "address" => secure_input($_POST['address']),
                );

                $mcNameErr =  mcNameValidation($_POST['mc_name']);
                $mcPhoneNumberErr =  mcPhoneNumberValidation($_POST['phone_number']);
                $mcAddressErr  =   mcAddressValidation($_POST['address']);

                if ( ($mcNameErr=="") && ($mcPhoneNumberErr=="") && ($mcAddressErr=="")) {
                    $sql = "UPDATE `mc` 
                    SET 
                    `name` = '$data_update[name]', 
                    `phone_number` = '$data_update[phone_number]', 
                    `address` = '$data_update[address]'
                    WHERE `mc`.`id_mc` = $id_mc";
                
                $res = mysqli_query($link,$sql);
                if ($res) {
                        header('Location: ?sdm=mc');
                    } else {
                        "<h1> Failed to update data </h1>";
                    }
                } else {
                    echo $mcNameErr.'<br>';
                    echo $mcPhoneNumberErr.'<br>';
                    echo $mcAddressErr  .'<br>';
                    
                }
            } 
                
            
        }

        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM mc WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }

        // function saveData

        function saveDataVenue($link,$data){
            $sql = "INSERT INTO `mc` 
            (`id_mc`, `name`, `phone_number`, `address`) 
            VALUES (NULL, '$data[name]', '$data[phone_number]', '$data[phone_number]')";
            $res = mysqli_query($link,$sql);
            if ($res) {
                header('Location: ?sdm=mc');
            } else {
                header('Location: ?sdm=mc_add');
            }
        }

        function deleteMc($id){
            $sql = "DELETE FROM `mc` WHERE `mc`.`id_mc` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: ?sdm=mc');
            
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function mcNameValidation($mcNameData){
            if (empty($mcNameData)) {
                $mcNameErr = "MC Name is required";
            } else {
                $mcNameErr = "";
            }
            return $mcNameErr;
        }

        function mcPhoneNumberValidation($phoneNumberData){
            if (empty($phoneNumberData)) {
                $phoneNumberErr = "Phone Number is required";
            } else {
                $phoneNumberErr = "";
            }
            return $phoneNumberErr;
        }

        function mcAddressValidation($addressData){
            if (empty($addressData)) {
                $addressErr = "Address is required";
            } else {
                $addressErr = "";
            }
            return $addressErr;
        }


        
    ?>         
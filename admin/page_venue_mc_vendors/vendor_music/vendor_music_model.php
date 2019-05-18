    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_vendor_music'])) {
            $id_vendor_music = $_GET['id_vendor_music'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editVM($id_vendor_music);
                } elseif (($_GET['method']) == "delete") {
                    deleteVM($id_vendor_music);
                }
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDataVM();
        }

        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }

        function addDataVM(){
        $link = getLinkDatabase();
            
            $name = secure_input($_POST['name']);
                $phone_number = secure_input($_POST['phone_number']);
                $address = secure_input($_POST['address']);
                  

                $nameErr = nameValidation($name);
                $phoneNumberErr = phoneNumberValidation($phone_number);
                $addressErr = addressValidation($address);
               

                
                if ( ($nameErr=="") && ($phoneNumberErr=="") && ($addressErr=="") && ($priceErr=="") && ($status_nameErr=="") ) {
                    $data = array(
                            'name' => $name,
                            'phone_number' => $phone_number,
                            'address' => $address                            
                        );
                    saveDataVenue($link,$data);
                } else {
                    include 'vendor_music_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllVM(){
            $sql = 'SELECT * FROM `vendor_music`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editVM($id_vendor_music){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_music WHERE id_vendor_music='$id_vendor_music'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_vendor_music" => $row['id_vendor_music'],
                        "name" => $row['name'],
                        "phone_number" => $row['phone_number'],
                        "address" => $row['address']                        
                    );
                }       
            }    

            include("vendor_music_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_vendor_music" => $data['id_vendor_music'],
                    "name" => secure_input($_POST['name']),
                    "phone_number" => secure_input($_POST['phone_number']),
                    "address" => secure_input($_POST['address'])                    
                );
                
                $nameErr = nameValidation($_POST['name']);
                $phoneNumberErr = phoneNumberValidation($_POST['phone_number']);
                $addressErr = addressValidation($_POST['address']);

                if ( ($nameErr=="") && ($phoneNumberErr=="") && ($addressErr=="")  ) {
                    $sql = "UPDATE `vendor_music` 
                        SET 
                        `name` = '$data_update[name]', 
                        `phone_number` = '$data_update[phone_number]', 
                        `address` = '$data_update[address]' 
                        WHERE `vendor_music`.`id_vendor_music` = $id_vendor_music";
                    
                    $res = mysqli_query($link,$sql);
                        if ($res) {
                            header('Location: ?sdm=musician');
                        } else {
                            "<h1> Failed to update data </h1>";
                    }
                }  else {
                    echo $nameErr.'<br>';
                    echo $phoneNumberErr.'<br>';
                    echo $addressErr.'<br>';
                }
            }
                
            
        }

        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM vendor_music WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }

        // function saveData

        function saveDataVenue($link,$data){
            $sql = "INSERT INTO `vendor_music` 
            (`id_vendor_music`, `phone_number`, `name`, `address`) 
            VALUES (NULL, '$data[phone_number]', '$data[name]', '$data[address]')";
            $res = mysqli_query($link,$sql);
            if ($res) {
                header('Location: ?sdm=musician');
            } else {
                header('Location: ?sdm=musician_add');
            }
        }

        function deleteVM($id){
            $sql = "DELETE FROM `vendor_music` WHERE `vendor_music`.`id_vendor_music` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: ?sdm=musician');
            
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
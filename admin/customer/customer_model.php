    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_customer'])) {
            $id_customer = $_GET['id_customer'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editVenue($id_customer);
                } elseif (($_GET['method']) == "delete") {
                    deleteVenue($id_customer);
                }
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDataVenue();
        }

        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }

        function addDataVenue(){
        $link = getLinkDatabase();
            
            $email = secure_input($_POST['email']);
            $name = secure_input($_POST['name']);
            $phonenumber = secure_input($_POST['phonenumber']);
            $address = secure_input($_POST['address']);    

            $emailErr = emailValidation($email);
            $nameErr = nameValidation($name);
            $phonenumberErr = phonenumberValidation($phonenumber);
            $addressErr = addressValidation($address);
                
                if ( ($emailErr=="") && ($nameErr=="") && ($phonenumberErr=="") && ($addressErr=="")) {
                    $data = array(
                            'email' => $email,
                            'name' => $name,
                            'phone_number' => $phonenumber,
                            'address' => $address,
                        );
                    saveDataVenue($link,$data);
                } else {
                    include 'customer_add.php';
                }          
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllCustomer(){
            $sql = 'SELECT * FROM `customers`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editVenue($id_customer){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM customers WHERE id_customer='$id_customer'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_customer" => $row['id_customer'],
                        "email" => $row['email'],
                        "name" => $row['name'],
                        "phone_number" => $row['phone_number'],
                        "address" => $row['address']
                    );
                }       
            }    
            
            include("customer_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_customer" => $data['id_customer'],
                    "email" => secure_input($_POST['email']),
                    "name" => secure_input($_POST['name']),
                    "phone_number" => secure_input($_POST['phone_number']),
                    "address" => secure_input($_POST['address']),          
                );


                $sql = "UPDATE `customers` 
                    SET 
                    `email` = '$data_update[email]', 
                    `name` = '$data_update[name]', 
                    `phone_number` = $data_update[phone_number],
                    `address` = '$data_update[address]' 
                    WHERE `customers`.`id_customer` = $id_customer";
                
                $res = mysqli_query($link,$sql);
                    if ($res) {
                        header('Location: customer.php');
                    } else {
                        "<h1> Failed to update data </h1>";
                }
            } else {

            }
                
            
        }


        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM customers WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }




        // function saveData

        function saveDataVenue($link,$data){
            $sql = "INSERT INTO `customers` 
            (`id_customer`, `email`, `phone_number`, `name`, `address`) 
            VALUES (NULL, '$data[email]', '$data[phone_number]', '$data[name]', '$data[address]')";
            $res = mysqli_query($link,$sql);
            
            if ($res) {
                header('Location: customer.php');
            } else {
                header('Location: customer_add.php');
            }
        }

        function deleteVenue($id){
            $sql = "DELETE FROM `customers` WHERE `customers`.`id_customer` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: customer.php');
            
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function emailValidation($email){
            if (empty($email)) {
                $emailErr = "Email Name is required";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email is a valid email address";
            } else {
                $emailErr = "";
            }
            return $emailErr;
        }

        function nameValidation($name){
            if (empty($name)) {
                $nameErr = "Name is required";
            } else {
                $nameErr = "";
            }
            return $nameErr;
        }

        function phonenumberValidation($phonenumber){
            if (empty($phonenumber)){
                $phonenumberErr = "Phone Number is required";
            } elseif(!is_numeric($phonenumber)) {
                $phonenumberErr = "Phone Number accepts only number";
            } else {
                $phonenumberErr = "";
            }
            return $phonenumberErr;
        }

        function addressValidation($address){
            if (empty($address)) {
                $addressErr = "Name is required";
            } else {
                $addressErr = "";
            }
            return $addressErr;
        }

    

        
    ?>         
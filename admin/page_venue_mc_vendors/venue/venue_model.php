    <?php 
        require("../database.php");
        
        if (isset($_GET['id_venue'])) {
            $id_venue = $_GET['id_venue'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editVenue($id_venue);
                } elseif (($_GET['method']) == "delete") {
                    deleteVenue($id_venue);
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
            
                $venue_name = secure_input($_POST['venue_name']);
                $max_capacity = secure_input($_POST['max_capacity']);
                $location = secure_input($_POST['location']);
                $price = secure_input($_POST['price']);
                $status_venue = secure_input($_POST['status_venue']);
                $venue_desc = $_POST['venue_desc'];

                $venueErr = venueValidation($venue_name);
                $maxCapacityErr = maxCapacityValidation($max_capacity);
                $locationErr = locationValidation($location);
                $priceErr = priceValidation($price);
                $status_venueErr = status_venueValidation($status_venue);
                $imageD = uploadImages();
                if ( ($venueErr=="") && ($maxCapacityErr=="") && ($locationErr=="") && ($priceErr=="") && ($status_venueErr=="") && ($imageD['error']=="")) {
                    $data = array(
                            'venue_name' => $venue_name,
                            'max_capacity' => $max_capacity,
                            'location' => $location,
                            'price' => $price,
                            'venue_desc' => $venue_desc,
                            'image_url' => $imageD['name'],
                        );
                    saveDataVenue($link,$data);
                } else {
                    include 'venue_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllVenue(){
            $sql = 'SELECT * FROM `venue`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editVenue($id_venue){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM venue WHERE id_venue='$id_venue'";
        
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_venue" => $row['id_venue'],
                        "max_capacity" => $row['max_capacity'],
                        "venue_name" => $row['venue_name'],
                        "location" => $row['location'],
                        "venue_price" => $row['venue_price'],
                        "venue_desc" => $row['venue_desc']
                    );
                }       
            }    

           
            
            include("venue_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_venue" => $data['id_venue'],
                    "max_capacity" => secure_input($_POST['max_capacity']),
                    "venue_name" => secure_input($_POST['venue_name']),
                    "location" => secure_input($_POST['location']),
                    "venue_price" => secure_input($_POST['price']),
                    "venue_desc" => secure_input($_POST['venue_desc']),
                    "status_venue" => secure_input($_POST['status_venue'])
                );

                
                $venueErr = venueValidation($data_update['venue_name']);
                $maxCapacityErr = maxCapacityValidation($data_update['max_capacity']);
                $locationErr = locationValidation($data_update['location']);
                $priceErr = priceValidation($data_update['venue_price']);
                $status_venueErr = status_venueValidation($data_update['status_venue']);
                                   

                if ( ($venueErr=="") && ($maxCapacityErr=="") && ($locationErr=="") && ($priceErr=="") && ($status_venueErr=="") ) {
                    $sql = "UPDATE `venue` 
                        SET 
                        `max_capacity` = '$data_update[max_capacity]', 
                        `venue_name` = '$data_update[venue_name]', 
                        `venue_price` = '$data_update[venue_price]',
                        `venue_desc` = '$data_update[venue_desc]', 
                        `status_venue` = '$data_update[status_venue]' 
                        WHERE `venue`.`id_venue` = $id_venue";
                 
                    $res = mysqli_query($link,$sql);
                    // var_dump($res);
                    // // var_dump($sql);    
                    if ($res) {
                        echo '<script>window.location="?sdm=venue"</script>';    
                    
                        } else {
                            echo "<h1> Failed to update data </h1>";
                        }
                } else {
                   echo $venueErr.'<br>';
                   echo $maxCapacityErr.'<br>';
                   echo $locationErr.'<br>';
                   echo $priceErr.'<br>';
                   echo $status_venueErr.'<br>';
                }    

            }
                            //  header('Location: ?sdm=venue');
                
            
        }

        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM venue WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }

        // function saveData

        function saveDataVenue($link,$data){
            $sql = "INSERT INTO `venue` 
            (`id_venue`, `max_capacity`, `venue_name`, `location`, `venue_price`,`img_url`,`venue_desc`) 
            VALUES (NULL, '$data[max_capacity]', '$data[venue_name]', '$data[location]', '$data[price]','$data[image_url]','$data[venue_desc]')";
            
            $res = mysqli_query($link,$sql);
            if ($res) {
                header('Location: ?sdm=venue');
            } else {
                header('Location: ?sdm=venue_add');
            }
        }

        function deleteVenue($id){
            $sql = "SELECT * FROM `venue` WHERE `venue`.`id_venue` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $image = $row['image_url'];
                }
                $targetFile = 'page_venue_mc_vendors/venue/venue_images/'.$image;
                
            }    
            $sql = "DELETE FROM `venue` WHERE `venue`.`id_venue` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            if ($res) {
                unlink($targetFile);
                header('Location: ?sdm=venue');
            }
            
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function venueValidation($venueData){
            if (empty($venueData)) {
                $venueErr = "Venue Name is required";
            } else {
                $venueErr = "";
            }
            return $venueErr;
        }

        function maxCapacityValidation($max_capacity){
            if (empty($max_capacity)){
                $maxCapacityErr = "Max capacity is required";
            } elseif(!is_numeric($max_capacity)) {
                $maxCapacityErr = "Max capacity accepts only number";
            } else {
                $maxCapacityErr = "";
            }
            return $maxCapacityErr;
        }

        function locationValidation($location){
            if(empty($location)){
                $locationErr = "Location is required";
            } else {
                $locationErr = "";
            }
            return $locationErr;
        }

        function priceValidation($price){
            if(empty($price)){
                $priceErr = "Venue price is required";
            } elseif(!is_numeric($price)){
                $priceErr = "Price accepts only number";
            } else {
                $priceErr=""; 
            }
            return $priceErr;
        }

        function status_venueValidation($status_venue){
            $status_venueErr="";
            if (empty($status_venue)) {
                $status_venueErr = "Status venue is required";
            } elseif (!is_numeric($status_venue)) {
                $status_venueErr = "Status venue invalid input format";
            } elseif (($status_venue == 0) and ($status_venue==1)) {
                $status_venueErr = "Status venue not must be on or off";
            } else {
                $status_venueErr = "";
            }


            return $status_venueErr;
        }

        function uploadImages(){
            
            $target_dir = "page_venue_mc_vendors/venue/venue_images/";
            
            $filename = str_replace('.',date("_Y_m_d_H_i_s").'.',basename($_FILES["fileToUpload"]["name"]));
            $filename = str_replace(' ', '_', $filename);
            
            $hasil = array(
                "error" => '',
                "name" => $filename
            );

            $target_file = $target_dir . $filename;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $hasil['error'] = "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $hasil['error'] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 1000000) {
                $hasil['error'] =  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $hasil['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". $filename. " has been uploaded.";
                } else {
                    $hasil['error'] =  "Sorry, there was an error uploading your file.";
                }
            }

            return $hasil;
        }
    ?>         
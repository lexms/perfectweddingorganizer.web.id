<?php
    ob_start();
    require_once('inputValidation.php');
    require_once("../database.php");

    function getLinkDatabase() {
        return koneksi_db();  
    }

    if (isset($_POST['addDataSubmit'])) {
        addPkgMusic();
    }

    if (isset($_POST['search'])) {
        if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
            $category = $_POST['category'];
            $input_search = $_POST['input_search'];   
            $hasil_search = search($category,$input_search);       
            return $hasil_search;
        }
    }

    if (isset($_GET['id_pkg_music'])) {
        $id_pkg_music = $_GET['id_pkg_music'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePkgMusic($id_pkg_music);
            } elseif (($_GET['method']) == "delete") {
                deletePkgMusic($id_pkg_music);
            }
        }
    }

    function selectAllpkgMusic() {
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_music";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    function addPkgMusic() {
        $link = getLinkDatabase();

        $package_name   = secure_input($_POST['package_name']);
        $qty_vocal      = secure_input($_POST['qty_vocal']);
        $qty_piano      = secure_input($_POST['qty_piano']);
        $qty_saxophone  = secure_input($_POST['qty_saxophone']);
        $qty_biola      = secure_input($_POST['qty_biola']);
        $qty_bass       = secure_input($_POST['qty_bass']);
        $sound_system   = secure_input($_POST['sound_system']);

        $package_nameErr   = package_nameValidation($package_name);
        $qty_vocalErr      = qty_vocalValidation($qty_vocal);
        $qty_pianoErr      = qty_pianoValidation($qty_piano);
        $qty_saxophoneErr  = qty_saxophoneValidation($qty_saxophone);
        $qty_biolaErr      = qty_biolaValidation($qty_biola);
        $qty_bassErr       = qty_bassValidation($qty_bass);
        $sound_systemErr   = sound_systemValidation($sound_system);

        if ($package_nameErr=="" && $qty_vocalErr=="" && $qty_pianoErr=="" && $qty_saxophoneErr=="" && $qty_biolaErr=="" && $qty_bassErr=="" && $sound_systemErr=="") {
            if (!is_numeric($sound_system) || $sound_system == NULL) {
                $sound_system = "Tidak Ada";
            }
            $sql = "INSERT INTO pkg_music values (null, '$package_name','$qty_vocal','$qty_piano','$qty_saxophone','$qty_biola','$qty_bass','$sound_system')";
            $res = mysqli_query($link,$sql);

            if($res){
                header('location: ../package.php?sdm=pkg_musician');
            }else{
                echo "Tambah data gagal";
            }
        } else {
            echo $package_nameErr.'<br>'; 
            echo $qty_vocalErr.'<br>';
            echo $qty_pianoErr.'<br>';
            echo $qty_saxophoneErr.'<br>';
            echo $qty_biolaErr.'<br>';
            echo $qty_bassErr.'<br>';
            echo $sound_systemErr.'<br>';
            echo "<a href='../package.php?pkgPV=add'>Masukan Data Lagi</a>";
        }
    }

    function updatePkgMusic($id_package) {
        $data = array();
        $data_update = array();
        $link = getLinkDatabase();

        $sql = "SELECT * FROM pkg_music WHERE id_pkg_music='$id_package'";
        $res = mysqli_query($link,$sql);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "id_pkg_music"  => $row['id_pkg_music'],
                    "package_name"  => $row['package_name'],
                    "qty_vocal"     => $row['qty_vocal'],
                    "qty_piano"     => $row['qty_piano'],
                    "qty_saxophone" => $row['qty_saxophone'],
                    "qty_biola"     => $row['qty_biola'],
                    "qty_bass"      => $row['qty_bass'],
                    "sound_system"  => $row['sound_system']
                );
            }
        }

        include("pkg_music_update.php");
        if (isset($_POST['updateDataSubmit'])) {
        
            $package_name   = secure_input($_POST['package_name']);
            $qty_vocal      = secure_input($_POST['qty_vocal']);
            $qty_piano      = secure_input($_POST['qty_piano']);
            $qty_saxophone  = secure_input($_POST['qty_saxophone']);
            $qty_biola      = secure_input($_POST['qty_biola']);
            $qty_bass       = secure_input($_POST['qty_bass']);
            $sound_system   = secure_input($_POST['sound_system']);
    
            $package_nameErr   = package_nameValidation($package_name);
            $qty_vocalErr      = qty_vocalValidation($qty_vocal);
            $qty_pianoErr      = qty_pianoValidation($qty_piano);
            $qty_saxophoneErr  = qty_saxophoneValidation($qty_saxophone);
            $qty_biolaErr      = qty_biolaValidation($qty_biola);
            $qty_bassErr       = qty_bassValidation($qty_bass);
            $sound_systemErr   = sound_systemValidation($sound_system);
            
            if ($package_nameErr=="" && $qty_vocalErr=="" && $qty_pianoErr=="" && $qty_saxophoneErr=="" && $qty_biolaErr=="" && $qty_bassErr=="" && $sound_systemErr=="") {
                if (!is_numeric($sound_system) || $sound_system == NULL) {
                    $sound_system = "Tidak Ada";
                }
                $sql = "UPDATE pkg_music
                        SET
                        package_name  = '$package_name',
                        qty_vocal     = '$qty_vocal',
                        qty_piano     = '$qty_piano',
                        qty_saxophone = '$qty_saxophone',
                        qty_biola     = '$qty_biola',
                        qty_bass      = '$qty_bass',
                        sound_system  = '$sound_system'
                        WHERE pkg_music.id_pkg_music = $id_package";

                $res = mysqli_query($link,$sql);

                if($res){
                    header('location: package.php?sdm=pkg_musician');
                }else{
                    echo "Tambah data gagal";
                }
            } else {
                echo $package_nameErr.'<br>'; 
                echo $qty_vocalErr.'<br>';
                echo $qty_pianoErr.'<br>';
                echo $qty_saxophoneErr.'<br>';
                echo $qty_biolaErr.'<br>';
                echo $qty_bassErr.'<br>';
                echo $sound_systemErr.'<br>';
            }
        }
    }

    function deletePkgMusic($id) {
        $sql = "DELETE FROM pkg_music where id_pkg_music = '$id'";
        $link = getLinkDatabase();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location: ../package.php?sdm=pkg_musician');
        }else{
            echo "Tambah data gagal";
        }
    }

    function search($category,$search){
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_music WHERE $category LIKE '%$search%'";
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

    function qty_vocalValidation($qty_vocal) {
        if (empty($qty_vocal)){
            $qty_vocalErr = "Qty vocal is required";
        } elseif(!is_numeric($qty_vocal)) {
            $qty_vocalErr = "Qty vocal accepts only number";
        } else {
            $qty_vocalErr = "";
        }
        return $qty_vocalErr;
    }

    function qty_pianoValidation($qty_piano) {
        if (empty($qty_piano)){
            $qty_pianoErr = "Qty piano is required";
        } elseif(!is_numeric($qty_piano)) {
            $qty_pianoErr = "Qty piano accepts only number";
        } else {
            $qty_pianoErr = "";
        }
        return $qty_pianoErr;
    }

    function qty_saxophoneValidation($qty_saxophone) {
        if (empty($qty_saxophone)){
            $qty_saxophoneErr = "Qty saxophone is required";
        } elseif(!is_numeric($qty_saxophone)) {
            $qty_saxophoneErr = "Qty saxophone accepts only number";
        } else {
            $qty_saxophoneErr = "";
        }
        return $qty_saxophoneErr;
    }

    function qty_biolaValidation($qty_biola) {
        if (empty($qty_biola)){
            $qty_biolaErr = "Qty biola is required";
        } elseif(!is_numeric($qty_biola)) {
            $qty_biolaErr = "Qty biola accepts only number";
        } else {
            $qty_biolaErr = "";
        }
        return $qty_biolaErr;
    }

    function qty_bassValidation($qty_bass) {
        if (empty($qty_bass)){
            $qty_bassErr = "Qty bass is required";
        } elseif(!is_numeric($qty_bass)) {
            $qty_bassErr = "Qty bass accepts only number";
        } else {
            $qty_bassErr = "";
        }
        return $qty_bassErr;
    }

    function sound_systemValidation($sound_system) {
        if (empty($sound_system)){
            $sound_systemErr = "Sound system is required";  
        } else {
            $sound_systemErr = "";
        }
        return $sound_systemErr;
    }
?>
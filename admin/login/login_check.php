<?php 

    $userLogin = 'admin';

    $userPassword = md5('admin');



    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = secure_input($_POST['username']);

        $password = md5(secure_input($_POST['password']));

        if (($username == $userLogin)&& ($password == $userPassword) ) {

            session_start();

            $_SESSION['login'] = TRUE;

            /* echo '<script>window.location="abc.com"</script>'; */
            header('Location: /');

        } else {

            echo '<script>window.location="/login"</script>'; 

        }

    } else {

        echo '<script>window.location="/login"</script>'; 

    }



     function secure_input($data){

        $data = trim($data);

        $data = stripcslashes($data);

        $data = htmlspecialchars($data);

        $data = strip_tags($data);

        return $data;

    }

?>
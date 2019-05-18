<?php
session_start(); 
    if (isset($_SESSION['login'])) {
        if ($_SESSION['login']) {
            // echo '<script>window.location=""</script>';   
        } else {
            echo '<script>window.location="/login"</script>';    
        }
    } else {
        echo '<script>window.location="/login"</script>';            
    }

    if (isset($_GET['login'])){
        logout();
    }

    function logout(){
        
          if ($_GET['login']=='logout') {
               session_unset(); 
                 session_destroy();
              header('Location: /login');
                // '<script>window.location="../login/login.php"</script>'; 
                
                //  echo 'inilah lol dia';
                // var_dump($_GET['login']);
            }
    }

?>
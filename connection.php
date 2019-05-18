<?php

    function db_connection() {

        $host = "localhost";

        /* $username = "perfectw_root";

        $password = "%&OIE)F}u5G%";

        $db = "perfectw_10116331_aplikasiweddingorganizer"; */
        
	
	    $username ="root";
        $password ="";
        $db = "10116331_aplikasiweddingorganizer";



        $link = mysqli_connect($host, $username, $password, $db);



        if (!$link) {

            die ("Connection Failed".mysqli_error);

        }



        return $link;

    }

?>
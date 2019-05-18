<?php require_once('session_check.php'); ?>

<!DOCTYPE html>

<html>

<head>

    <?php require "head.php";?>

</head>

<body>

    <?php require "navbar.php";?>

    <?php require_once("../database.php");?>



    <div class="side_menu_parent">

        <nav id="sidemenu" class="side_menu">

            <li class='side_menu_subtitle'><a href="?sdm=main_package">Main Package</a></li>

            <?php

                $link = koneksi_db();

                $sql = "SELECT * FROM package";

                $res = mysqli_query($link,$sql);

                $ketemu = mysqli_num_rows($res);

                if ($ketemu > 0) {

                    while ($data=mysqli_fetch_array($res)) {

                        echo "<li class=''><a href='?id_package=$data[id_package]&method=edit&pkg=update'>$data[package_name]</a></li>";

                    }

                }

            ?>

            <hr class="style3">

            <li class='side_menu_subtitle avoid_clicks'><a href="?sdm=spkg">Sub Package</a></li>

            <li class=''><a href="?sdm=pkg_photo_video">Photo & Video</a></li>

            <li class=''><a href="?sdm=pkg_musician">Musician</a></li>

            <li class=''><a href="?sdm=pkg_catering">Catering</a></li>

        </nav>

        

        <div class="side_menu_content">

            <?php

                if (isset($_GET['sdm'])) {

                    if ($_GET['sdm'] == 'main_package') {

                        include_once('page_package/package_overview.php');

                    }

                    

                    if ($_GET['sdm'] == 'pkg_photo_video' || $_GET['sdm'] == 'spkg') {

                        include_once('page_package/pkg_photo_video_overview.php');

                    }

                    if ($_GET['sdm'] == 'pkg_musician') {

                        include_once('page_package/pkg_music_overview.php');

                    }

                    if ($_GET['sdm'] == 'pkg_catering') {

                        include_once('page_package/pkg_catering_overview.php');

                    }

                }



                if (isset($_GET['pkg'])) {

                    if ($_GET['pkg'] == 'add') {

                        include_once('page_package/package_add.php');

                    }

                    if ($_GET['pkg'] == 'update') {

                        include_once('page_package/package_model.php');

                    }

                    if ($_GET['pkg'] == 'delete') {
                        include_once('page_package/package_model.php');
                    }

                }



                if (isset($_GET['pkgPV'])) {

                    if ($_GET['pkgPV'] == 'add') {

                        include_once('page_package/pkg_photo_video_add.php');

                    }

                    if ($_GET['pkgPV'] == 'update') {

                        include_once('page_package/pkg_photo_video_model.php');

                    }

                }



                if (isset($_GET['pkgMusic'])) {

                    if ($_GET['pkgMusic'] == 'add') {

                        include_once('page_package/pkg_music_add.php');

                    }

                    if ($_GET['pkgMusic'] == 'update') {

                        include_once('page_package/pkg_music_model.php');

                    }

                }



                if (isset($_GET['pkgCatering'])) {

                    if ($_GET['pkgCatering'] == 'add') {

                        include_once('page_package/pkg_catering_add.php');

                    }

                    if ($_GET['pkgCatering'] == 'update') {

                        include_once('page_package/pkg_catering_model.php');

                    }

                }

            ?>

        </div>

    </div>

</body>

<script src='js/venue_mc_vendors.js'></script>

</html>
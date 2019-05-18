<?php require_once('session_check.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php require "head.php";?>
</head>
<body>
    <?php require "navbar.php";?>
    <div class="side_menu_parent">
        <nav id="sidemenu" class="side_menu">
            <li class=''><a href="?sdm=venue">Venue</a></li>
            <li class=''><a href="?sdm=mc">MC</a></li>
            <li class=''><a href="?sdm=makeup">Vendor Makeup</a></li>
            <li class=''><a href="?sdm=photovideo">Vendor Photo & Video</a></li>
            <li class=''><a href="?sdm=musician">Vendor Musician</a></li>
            <li class=''><a href="?sdm=catering">Vendor Catering</a></li>
        </nav>

        <div class="side_menu_content">
            <?php
                if (isset($_GET['sdm'])) {
                    // BAGIAN VENUE
                    if ($_GET['sdm'] == 'venue') {
                        include_once('page_venue_mc_vendors/venue/venue.php');
                    }

                    if ($_GET['sdm'] == 'venue_add') {
                        include_once('page_venue_mc_vendors/venue/venue_add.php');
                    }

                    if ($_GET['sdm'] == 'venue_model') {
                        include_once('page_venue_mc_vendors/venue/venue_model.php');
                    }
               

                    // END BAGIAN VENUE

                    // BAGIAN MC
                    if ($_GET['sdm'] == 'mc') {
                        include_once('page_venue_mc_vendors/mc/mc.php');
                    }
                    if ($_GET['sdm'] == 'mc_add') {
                        include_once('page_venue_mc_vendors/mc/mc_add.php');
                    }
                    if ($_GET['sdm'] == 'mc_model') {
                        include_once('page_venue_mc_vendors/mc/mc_model.php');
                    }
                    // END BAGIAN MC

                    // BAGIAN MAKEUP
                    if ($_GET['sdm'] == 'makeup') {
                        include_once('page_venue_mc_vendors/vendor_makeup/vendor_makeup.php');
                    }

                    if ($_GET['sdm'] == 'makeup_add') {
                        include_once('page_venue_mc_vendors/vendor_makeup/vendor_makeup_add.php');
                    }

                    if ($_GET['sdm'] == 'makeup_model') {
                        include_once('page_venue_mc_vendors/vendor_makeup/vendor_makeup_model.php');
                    }
                    //END BAGIAN MAKEUP


                    //BAGIAN PHOTO VIDEO
                    if ($_GET['sdm'] == 'photovideo') {
                        include_once('page_venue_mc_vendors/vendor_photo_video/vendor_photovideo.php');
                    }

                    if ($_GET['sdm'] == 'photovideo_add') {
                        include_once('page_venue_mc_vendors/vendor_photo_video/vendor_photovideo_add.php');
                    }

                    if ($_GET['sdm'] == 'photovideo_model') {
                        include_once('page_venue_mc_vendors/vendor_photo_video/vendor_photovideo_model.php');
                    }
                    //END BAGIAN PHOTO VIDEO


                    //BAGIAN MUSICIAN
                    if ($_GET['sdm'] == 'musician') {
                        include_once('page_venue_mc_vendors/vendor_music/vendor_music.php');
                    }
                    if ($_GET['sdm'] == 'musician_add') {
                        include_once('page_venue_mc_vendors/vendor_music/vendor_music_add.php');
                    }
                    if ($_GET['sdm'] == 'musician_model') {
                        include_once('page_venue_mc_vendors/vendor_music/vendor_music_model.php');
                    }
                    //END MUSICIAN
                    
                    //BAGIAN CATERING
                    if ($_GET['sdm'] == 'catering') {
                        include_once('page_venue_mc_vendors/vendor_catering/vendor_catering.php');
                    }

                    if ($_GET['sdm'] == 'catering_add') {
                        include_once('page_venue_mc_vendors/vendor_catering/vendor_catering_add.php');
                    }

                    if ($_GET['sdm'] == 'catering_model') {
                        include_once('page_venue_mc_vendors/vendor_catering/vendor_catering_model.php');
                    }
                    //END BAGIAN CATERING

                    
                }
            ?>
        </div>
    </div>
</body>
<script src='js/venue_mc_vendors.js'></script>
</html>
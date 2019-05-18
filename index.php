<?php require("connection.php");?>

<!DOCTYPE html>

<html lang="en">

<head>

<?php require "head.php";?>  

</head>



<body>

<?php include_once "navbar.php"; ?>



<section id="section_hero" class="hero">

  <div class="background-image" style="background-image: 

    linear-gradient(

      rgba(0,0,0,0.5),

      rgba(0,0,0,0.5)

    ),

    url(img/samantha-gades-711115-unsplash.jpg);"></div>

  <div class="hero-content-area">

    <h1>Perfect Wedding Organizer</h1>

    <h3>So you can have your perfect wedding</h3>

    <a href="book_now_page.php" class="btn">Book Now</a>

  </div>

</section>



<section id="section_gallery" class="gallery">

  <h3 class="title">How is it looks like?</h3>

  <p>View these awesome wedding decorations, we provide flowers, table decorations and all kind of beautiful props that will decorate your wedding</p>

  <hr>



  <ul class="grid">

    <li class="small" style="background-image: url(img/photos-by-lanty-568676-unsplash.jpg);"></li>

    <li class="large" style="background-image: url(img/thomas-ae-602202-unsplash.jpg);"></li>

    <li class="large" style="background-image: url(img/rawpixel-247358-unsplash.jpg);"></li>

    <li class="small" style="background-image: url(img/robert-oh-191991-unsplash.jpg);"></li>

  </ul>

</section>



<section id="section_packages" class="packages">

  <h3 class="title">Wedding Packages</h3>

 <!--  <p>Find your perfect packages here. we offer a lot of varieties  </p> -->

  <hr>



  <ul class="grid">

    <?php

      $sql = "SELECT * FROM package";
      $res = mysqli_query(db_connection(),$sql);
      $ketemu = mysqli_num_rows($res);

      if ($ketemu > 0) {
        while ($data=mysqli_fetch_array($res)) {

          $sqlMusic = "SELECT * FROM pkg_music where id_pkg_music = $data[id_pkg_music]";
          $resMusic = mysqli_query(db_connection(),$sqlMusic);
          $dataMusic=mysqli_fetch_array($resMusic);

          $sqlPVV = "SELECT * FROM pkg_photo_video where id_pkg_photo_video = $data[id_pkg_photo_video]";
          $resPVV = mysqli_query(db_connection(),$sqlPVV);
          $dataPVV=mysqli_fetch_array($resPVV);

          $sqlCatering = "SELECT * FROM pkg_catering where id_pkg_catering = $data[id_pkg_catering]";
          $resCatering = mysqli_query(db_connection(),$sqlCatering);
          $dataCatering= mysqli_fetch_array($resCatering);
    ?>  

        <li>

          <i class="fa fa-compass fa-4x"></i>

          <h4><?php echo $data['package_name']; ?></h4>
          <p class="description"><?php echo $data['package_desc'] ?></p>
          
          <ul class="package_detail">
            <li display:0>1. Professional Make up artist</li>
            <li>2. Upacara adat (optional)</li>
            <li>3. Music Entertainment
              <ul>
                <li>
                  (<?php echo $dataMusic['qty_vocal'] ?>) Vocal, 
                  (<?php echo $dataMusic['qty_piano'] ?>) Piano, 
                  (<?php echo $dataMusic['qty_saxophone'] ?>) Saxophone, 
                  (<?php echo $dataMusic['qty_biola'] ?>) Biola, 
                  (<?php echo $dataMusic['qty_bass'] ?>) Bass 
                </li>
              </ul>
            </li>
            <li>4. MC Akad Resepsi</li>
            <li>5. Dokumentasi Photography dan Video
              <ul>
                <li>
                  (<?php echo $dataPVV['duration_prewedding'] ?>) prewedding, 
                  (1) hari acara pengajian siraman, 
                  (1) hari acara akad resepsi, 
                  (<?php echo $dataPVV['qty_album'] ?>) Album ukuran <?php echo $dataPVV['photo_album_size'] ?>, 
                  (<?php echo $dataPVV['qty_gallery'] ?>) galeri foto ukuran <?php echo $dataPVV['photo_gallery_size'] ?>
                </li>
              </ul>
            </li>
            <li>6. Catering
              <ul>
                <li>
                  (<?php echo $dataCatering['qty_type_main_course'] ?>) menu utama, 
                  (<?php echo $dataCatering['qty_type_dessert'] ?>) menu dessert
                </li>
              </ul>

            </li>
            <li>7. Mobil Pengantin, menginap di hotel berbintang</li>
          </ul>



        </li>

    <?php

        }

      }

    ?>

  </ul>

</section>



<section id="section_venue" class="packages">

  <h3 class="title">Venue</h3>

  <p></p>

  <hr>



  <ul class="grid">



    <?php

      $sql = 'SELECT * FROM `venue`';

      $res = mysqli_query(db_connection(),$sql);

      $ketemu = mysqli_num_rows($res);

      if ($ketemu > 0) {

          while ($data=mysqli_fetch_array($res)) {

    ?>  

        <li>


          <h4><?php echo $data['venue_name']; ?></h4>

          <div class"" 
          style="
            height: 350px;
            padding: 20px;
            background-image: url(admin/page_venue_mc_vendors/venue/venue_images/<?php echo $data['img_url'];  ?>);
            background-clip: content-box;
	          background-size: cover;
	          background-position: center;">
          </div>

            
<!--           <img class="small" src="admin/page_venue_mc_vendors/venue/venue_images/<?php echo $data['img_url']; ?>" alt="venue_img"> -->

          <p class="description"><?php echo $data['venue_desc'] ?></p>

        </li>

    <?php

        }

      }

    ?>

  </ul>



</section>









<div id="map" style="width:100%;height:60vh;"></div>



<footer>

  <div id="footer">

    <div class="footer-title">FOLLOW US <hr></div>

    

    <a href="" class="icon-social">

      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" version="1" viewBox="0 0 455 455">

        <path  fill-rule="evenodd" d="M0 0v455h455V0H0zm301 125h-36c-7 0-14 7-14 13v36h50c-2 28-6 53-6 53h-44v158h-65V227h-32v-53h32v-43c0-8-2-61 67-61h48v55z" clip-rule="evenodd"/>

      </svg>

    </a> 

    <a href="" class="icon-social">

      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" version="1" viewBox="0 0 455 455">

        <path  fill-rule="evenodd" d="M0 0v455h455V0H0zm353 163v9A183 183 0 0 1 70 326a131 131 0 0 0 96-26c-29-1-52-20-61-45a64 64 0 0 0 29-1c-29-6-51-32-51-64 8 4 18 7 29 8a65 65 0 0 1-20-87c32 39 79 65 133 68a65 65 0 0 1 110-59c15-3 29-8 41-16-5 15-15 28-28 36 13-2 25-5 37-10-9 13-20 24-32 33z" clip-rule="evenodd"/>

      </svg>

    </a>

    <a href="" class="icon-social">

      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" version="1" viewBox="0 0 364 364">

        <g  fill-rule="evenodd" clip-rule="evenodd">

          <path d="M244 83H120c-20 0-37 17-37 37v124c0 20 17 37 37 37h124c20 0 37-17 37-37V120c0-20-17-37-37-37zm-62 164a65 65 0 1 1 0-130 65 65 0 0 1 0 130zm67-116a15 15 0 1 1 0-31 15 15 0 0 1 0 31z"/>

          <path d="M182 145a38 38 0 1 0 0 75 38 38 0 0 0 0-75z"/>

          <path d="M0 0v364h364V0H0zm308 244c0 35-29 64-64 64H120c-35 0-64-29-64-64V120c0-35 29-64 64-64h124c35 0 64 29 64 64v124z"/>

        </g>

      </svg>

    </a>

    

  </div>

  <hr>

  <div id="copyright" class="">

    Copyright 2018<br>

    Perfect Wedding Organizer<br>

    Developed by Perfect Developer<br>

    All Rights Reserved<br> 

  </div>  

</footer>





<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAyKbhvKnC5tOB1sefWY0GmumuQQZcGxs&callback=initMap"></script>

<script src="js/home.js"></script>

</body>

</html>
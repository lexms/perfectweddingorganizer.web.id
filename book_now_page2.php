<?php

  require_once "test_input.php";

  require_once "connection.php";

  session_start();

  if (isset($_POST['wedding_date'])) {

    if (empty($_POST['wedding_date'])

      || empty($_POST['wedding_name'])

      || empty($_POST['name_bridegroom'])

      || empty($_POST['name_bride'])

    )

    {

      //Error message if empty

      $_SESSION['error_page2'] = "Mandatory field(s) are missing, Please fill it again";

      header("location: book_now_page1.php");

    }else{

      

      //Fetching all values posted from previous page and storing it in variable.

       foreach ($_POST as $key => $value) {

          $_SESSION['post'][$key] = test_input($value);

        }

    }

  }else{

    if (empty($_SESSION['error_page2'])) {

       header("location: book_now_page.php");

    }

  }

?>





<!DOCTYPE html>

<html lang="en">

<head>

<?php require "head.php";?> 

<link rel="stylesheet" href="css/book_now.css"> 

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

    <h1>Book Your Perfect Wedding</h1>

  </div>

</section>



<section>

    <form action="book_now_page3.php" id="form_order" method="post">

      <div id="form_order_how_where">

        <h4>How Many & Where?</h4>

        <div class="form-group">

          <label>For How Many People</label>

          <input type="number" min="1"class="form-control" name="persons" id="persons" placeholder="How many attendants of your wedding?" required>

        </div>

  

        <div class="form-group">

          <label>Venue</<label>

          <div>

            <select type="text" class="form-control" name="select_venue" id="select_venue">

              <!-- <option value="1">Venue1</option>

              <option value="2">Venue2</option>

              <option value="3">Venue3</option>		 -->

              <?php 

                $sql = "SELECT * FROM venue";

                $res = mysqli_query(db_connection(),$sql);

                $ketemu = mysqli_num_rows($res);

                $no=0;

                if ($ketemu > 0) {

                  while ($data=mysqli_fetch_array($res)) {

                    $no++;

                    echo "<option value=$no>$data[venue_name] ( Rp."; echo number_format("$data[venue_price]",0, ',' , '.'); echo" )</option>";

                  }

                }

              ?>					

    				</select>

          </div>

        </div>

      </div>



      <div id="form_order_what">

        <h4>What?</h4>

        <div class="form-group">

          <label>Package</<label>

          <div>

            <select type="text" class="form-control" name="select_package" id="select_package">

              <!-- <option value="1">Perfect 1</option>

              <option value="2">Perfect 2</option>

              <option value="3">Perfect 3</option>						 -->

              <?php 

                $sql = "SELECT * FROM package";

                $res = mysqli_query(db_connection(),$sql);

                $ketemu = mysqli_num_rows($res);

                $no=0;

                if ($ketemu > 0) {

                  while ($data=mysqli_fetch_array($res)) {

                    $no++;

                    echo "<option value=$no>$data[package_name] ( Rp."; echo number_format("$data[package_price]",0, ',' , '.'); echo" )</option>";

                  }

                }

              ?>

    				</select>

          </div>

        </div>

        <div class="form-group">

          <label>Traditional Ceremony</<label>

          <div>

            <select type="text" class="form-control" name="select_traditional_ceremony" id="select_traditional_ceremony">

              <option selected value="none">I don't want to have Traditional Ceremony</option>

              <option value="jawa">Jawa ( + Rp.5000.000 )</option>

              <option value="sunda">Sunda ( + Rp.5000.000 )</option>

              <option value="betawi">Betawi ( + Rp.5000.000 )</option>						

    				</select>

          </div>

        </div>

      </div>

      

      <button type="submit" class="btn-order"><span>Next</span></button>

    </form>



</section>



</body>

</html>
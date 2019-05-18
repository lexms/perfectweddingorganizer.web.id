<?php

  require_once "connection.php";

  require_once "test_input.php";

  session_start();

  if (isset($_POST['persons'])) {

    if (empty($_POST['persons'])

      || empty($_POST['select_venue'])

      || empty($_POST['select_package'])

      || empty($_POST['select_traditional_ceremony'])

    )

    {

      //Error message if empty

      $_SESSION['error_page3'] = "Mandatory field(s) are missing, Please fill it again";

      header("location: book_now_page2.php");

    }else{

      

      if (!is_numeric($_POST['persons'])) {

        header("location: book_now_page2.php");  

      }

      //Fetching all values posted from previous page and storing it in variable.

       foreach ($_POST as $key => $value) {

          $_SESSION['post'][$key] = test_input($value);

        }

    }

  }else{

    if (empty($_SESSION['error_page3'])) {

       header("location: book_now_page1.php");

    }

  }

?>



<!-- show order data and fill payment details -->

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







<?php // get venue price, package price, and if opt_upacara_adat != none



  $id_venue = $_POST['select_venue']; 

  $sql_venue = "SELECT venue_price FROM venue where id_venue = '$id_venue' limit 1";

  $result_venue = mysqli_query(db_connection(),$sql_venue);

  $price_venue = mysqli_fetch_array($result_venue);



  $id_pkg = $_POST['select_package']; 

  $sql_pkg = "SELECT package_price FROM package where id_package = '$id_pkg' limit 1";

  $result_pkg = mysqli_query(db_connection(),$sql_pkg);

  $price_pkg = mysqli_fetch_array($result_pkg);



  mysqli_close(db_connection());





  if ($_POST['select_traditional_ceremony'] != 'none') {

    $price_traditional_ceremony = 5000000;

  }else {

      $price_traditional_ceremony = 0;

  }

  $total_price = $price_venue['venue_price'] + $price_pkg['package_price'] + $price_traditional_ceremony;



  //storing total price to session

  $_SESSION['total_price'] = "$total_price";

 

?>





<section>



    <form action="book_now_page4_confirm.php" id="form_order" name="form_payment" method="post">



      <div id="form_order_payment">

        <h4>Please Fill The Payment Details</h4>



          <div id="order_data">

            <div class="row_payment">

              <div>Venue Price</div>

              <div class="price">Rp <?php echo number_format($price_venue['venue_price'],0, ',' , '.');?></div>

            </div>

            <div class="row_payment">

              <div>Package Price</div>

              <div class="price">Rp <?php echo number_format($price_pkg['package_price'],0, ',' , '.');?></div>

            </div>

            <div class="row_payment">

              <div>Traditional Ceremony Fee</div>

              <div class="price">Rp <?php echo number_format($price_traditional_ceremony,0, ',' , '.');?></div>

            </div>



            <hr class="style_payment">

            <div class="row_payment">

              <div>Total Price</div>

              <div class="price total_price">Rp <?php echo number_format($total_price,0, ',' , '.');?></div>

            </div>

          </div>

          

          <p><i>The price above does not include the price of the food, we will contact you to discuss the detail after the payment is proceed within 24 hours </i></p>

        <div class="form-group">

          <label><br>Bank Name</label>

          <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="What Bank account you are using for the transfer?" required>

        </div>

        <div class="form-group">

          <label>Down Payment</label>

          <input type="text" class="form-control" name="DP" id="DP" placeholder="" onchange="dp_validation(document.form_payment.DP)" required>

          <div class="err_msg">*Down Payment must be at least Rp 1000.000</div>

        </div>

      </div>      

      <button type="submit" class="btn-order"><span>Next</span></button>

    </form>

</section>

<script src="js/book_now.js"></script>

</body>

</html>
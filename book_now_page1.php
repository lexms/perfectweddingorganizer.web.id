<?php

  require_once "test_input.php";

  session_start();

  if (isset($_POST['name'])) {

    if (empty($_POST['name'])

      || empty($_POST['email'])

      || empty($_POST['phone_number'])

      || empty($_POST['address'])

    )

    {

      //Error message if empty

      $_SESSION['error'] = "Mandatory field(s) are missing, Please fill it again";

      header("location: book_now_page.php");

    }else{



      // Sanitizing email field to remove unwanted characters.

      $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 



       // Validating phone number

      if (!preg_match("/^\d{10,15}$/", $_POST['phone_number'])){ 

        $_SESSION['error'] = "10-15 digit phone number is required.";

        header("location: book_now_page.php");

      }

      

      //Fetching all values posted from previous page and storing it in variable.

       foreach ($_POST as $key => $value) {

          $_SESSION['post'][$key] = test_input($value);



        }

    }

  }else{

    if (empty($_SESSION['error_page1'])) {

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

<body onload="setMinDate() ">



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

    <form action="book_now_page2.php" id="form_order" method="post">



    

      <div id="form_order_when_who">

        <h4>When & Who?</h4>

        <div class="form-group">

          <label>Wedding Date</label>

          <input type="date" class="form-control" name="wedding_date" id="wedding_date" required >

        </div>

        

        <div class="form-group">

          <label>Wedding Name</label>

          <input type="text" class="form-control" name="wedding_name" id="wedding_name" placeholder="e.g: Ray and Anne Wedding" required>

        </div>

        <div class="form-group">

          <label>Bridegroom's Name</label>

          <input type="text" class="form-control" name="name_bridegroom" id="name_bridegroom" placeholder="e.g: Ray Smith" required>

        </div>

        <div class="form-group">

          <label>Bride's Name</label>

          <input type="text" class="form-control" name="name_bride" id="name_bride " placeholder="e.g: Anne Chang" required>

        </div>

      </div>

      

      <button type="submit" class="btn-order"><span>Next</span></button>

    </form>



</section>



<script src="js/book_now.js"></script>

</body>

</html>
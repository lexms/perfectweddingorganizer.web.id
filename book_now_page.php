<?php session_start();?>

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
    <form action="book_now_page1.php" id="form_order" name="form_customer_order" method="post">   
      <div id="form_order_customer">
        <h4>Let us know who you are</h4>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Your name" required>
        </div>        
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Your Email address" required>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Your phone number" onchange="phone_number_validation(document.form_customer_order.phone_number)" required>
          <div class="err_msg">*phone number must be at least 10 digits <br>or maximum 15 digits and all numbers</div>
        </div>
        <div class="form-group">
          <label>Address</label>
          <!-- <input type="text" class="form-control" name="address" id="address" placeholder="Your addressr" required> -->
          <textarea class="form-control" name="address" id="address" cols="30" rows="5"  placeholder="Your address" onclick="phone_number_validation(document.form_customer_order.phone_number)" required></textarea>
        </div>
      </div>      
      <button type="submit" class="btn-order"><span>Next</span></button>
    </form>

</section>
<script src="js/book_now.js"></script>
</body>
</html>
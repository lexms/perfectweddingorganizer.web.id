<?php

  require_once "connection.php";

  require_once "test_input.php";

  session_start();



  if (isset($_POST['bank_name'])) {

    if (!empty($_SESSION['post'])) {

          if (empty($_POST['bank_name'])

            || empty($_POST['DP'])

          )

          {

            //Error message if empty

            $_SESSION['error_page4'] = "Mandatory field(s) are missing, Please fill it again";

            header("location: book_now_page3.php");

          }else{

            

            //Fetching all values posted from previous page and storing it in variable.

            foreach ($_POST as $key => $value) {

                $_SESSION['post'][$key] = test_input($value);

            }

     



            extract($_SESSION['post']); // Function to extract array.



             // Storing values in database.

            

            $sql_customer = "insert into customers 

            (email, name, phone_number, address) 

            values ('$email','$name','$phone_number','$address')";

            $res_customer=mysqli_query(db_connection(),$sql_customer);

            if ($res_customer) {

              

              $sql_customer = "SELECT id_customer FROM customers order by id_customer desc limit 1"; // select last id customer

              $result_customer = mysqli_query(db_connection(),$sql_customer);

              $id_customer_arr = mysqli_fetch_array($result_customer);

              $id_customer = $id_customer_arr['id_customer'];

              mysqli_close(db_connection());



            }



            $status = 0;

            $total_price = $_SESSION['total_price'];

            $sql_payment = "insert into payments 

            (bank_name, status, total_price, DP) 

            values ('$bank_name','$status','$total_price','$DP')";

            $res_payment=mysqli_query(db_connection(),$sql_payment);

            if ($res_payment) {

              

              $sql_payment = "SELECT id_payment FROM payments order by id_payment desc limit 1"; // select last id payment

              $result_payment = mysqli_query(db_connection(),$sql_payment);

              $id_payment_arr = mysqli_fetch_array($result_payment);

              $id_payment = $id_payment_arr['id_payment'];              

              mysqli_close(db_connection());

 

            }





            //get latest id mc, n all vendors, and increament id or start from first for new order

            

            $mc_vendors_arr = array("id_mc"=>"mc","id_vendor_makeup"=>"vendor_makeup","id_vendor_photo_video"=>"vendor_photo_video","id_vendor_catering"=>"vendor_catering","id_vendor_music"=>"vendor_music");    



            //get first row mc and vendors id

            foreach ($mc_vendors_arr as $key => $value) {

                $sql = "SELECT $key from $value order by $key asc limit 1"; //select mc vendors first row id

                $result = mysqli_query(db_connection(),$sql);

                $id_mc_vendors_first_row = mysqli_fetch_array($result);

                $id_mc_vendors_first_row_arr[$key] = $id_mc_vendors_first_row[$key];

            }



            //get last mc and vendors id in each of their table

            foreach ($mc_vendors_arr  as $key => $value ) {

                $sql = "SELECT $key from $value order by $key desc limit 1";

                $result = mysqli_query(db_connection(),$sql);

                $id_mc_vendors_last_row = mysqli_fetch_array($result);

                $id_mc_vendors_last_row_arr[$key] = $id_mc_vendors_last_row[$key];

                

            }

            

            //get latest mc and vendors id USED in table orders

            foreach ($mc_vendors_arr as $key => $value) {

                $sql = "SELECT $key from orders order by id_order desc limit 1";

                $result = mysqli_query(db_connection(),$sql);

                $id_mc_vendors_used = mysqli_fetch_array($result);

                $id_mc_vendors_used_arr[$key] = $id_mc_vendors_used[$key];

            }



            //get new mc and vendors id



            foreach ($mc_vendors_arr as $key => $value) {

                if ($id_mc_vendors_used_arr[$key] == $id_mc_vendors_last_row_arr[$key]) {

                    $id_NEW_mc_vendors_arr[$key] = $id_mc_vendors_first_row_arr[$key]; //back to first row

                }else {

                    $id_NEW_mc_vendors_arr[$key] = $id_mc_vendors_used_arr[$key] + 1; //next row

                }



            }



            extract($id_NEW_mc_vendors_arr);



            $sql_order = "INSERT INTO `orders` ( `order_date`, `persons`, `wedding_name`, `wedding_date`, 



            `name_bridegroom`, `name_bride`, `opt_upacara_adat`, `status_order`, `id_venue`, `id_package`, 



            `id_customer`, `id_payment`, `id_mc`, `id_vendor_makeup`, `id_vendor_photo_video`, `id_vendor_catering`, `id_vendor_music`) 



            

            VALUES (now(), $persons, '$wedding_name', '$wedding_date', 

            

            '$name_bridegroom', '$name_bride', '$select_traditional_ceremony', '0', $select_venue, $select_package, 

            

            $id_customer, $id_payment, $id_mc, $id_vendor_makeup, $id_vendor_photo_video, $id_vendor_catering, $id_vendor_music);";



            







            $res_order=mysqli_query(db_connection(),$sql_order);



            $amount_left_to_pay = 0;

            $order_msg = "Form Submission Not Processed";

            if ($res_order) {

              $order_msg = "Congratulation Your Wedding Date is Ticking";

              $amount_left_to_pay = $total_price - $DP;

              

            } else {

              $order_msg = "Form Submission Failed";

              header("location: book_failed.php");

            }



            unset($_SESSION['post']); // Destroying session.





          }



    }else { // if post empty

      header("location: book_now_page.php");

    }

  }else{ // if not isset

       header("location: book_now_page.php");

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



<section id="confimation page">



    <h1><?php echo $order_msg; ?></h1><br>

    <h4>Total Price:</h4>

    <h2>Rp <?php echo number_format($total_price,0, ',' , '.'); ?></h2>

    <hr style="margin-bottom = 27px">

    <h4>Down Payment:</h4>

    <h2>Rp <?php echo number_format($DP,0, ',' , '.'); ?></h2>

    <p>Please transfer (minimal down payment first) with 24 hours, otherwise any orders made will be cancelled </p>

  



  <h3>Bank Account: BCA 099 232 45</h3>

  <h4>Name        : Perfect Wedding Organizer</h4>



  <p>Please Send the transfer proof to <i style="color:#c7a663;">perfectweddingorganizer@web.id</i><br>Our Customer service will contact you soon after the payment has been made</p>

  <a href="index.php">Homepage</a>

</section>

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

</body>

</html>
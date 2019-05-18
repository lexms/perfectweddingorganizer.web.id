<?php require_once('session_check.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php require "head.php";?>
    <link rel="stylesheet" href="css/order.css">
</head>
<body>
    <?php require "navbar.php";
    require_once('order/order_model.php')?>
    <section class="order_section">
        <div id="table_customer">
            <form action="" method='post'>
                <select name="category" id="">
                    <option value="order_date"> Order Date</option>
                    <option value="wedding_name">Wedding Name</option>
                    <option value="wedding_date">Wedding Date</option>
                    <option value="package_name">Package</option>
                    <option value="venue_name">Venue</option>
                </select>


    <!--                 Search<input type="text" name="input_search"> -->


                    <input type="text" name="input_search" placeholder="Search">

                    <!-- <input type="submit" name="search"> -->


                    <button type="submit" class="btn-search"  name="search" ><i class="magnify-glass"></i></button>

        
    </form>
            <table id="customers" class="default_table">
            <tr>
                <th>No</th>
                <th>Order Date</th>
                <th>Wedding Name</th>
                <th>Wedding Date</th>
                <th>Package</th>
                <th>Venue</th>
                <th>Action</th>
            </tr>
            <?php
                $no=0;
                if (isset($hasil_search)) {
                    $res = $hasil_search;
                } else {
                    $res = selectAllorders();               
                }              
                   $ketemu = mysqli_num_rows($res);
           
                   if ($ketemu > 0) {
                       while ($data=mysqli_fetch_array($res)) {
                            $no++;
                            $id_package = $data['id_package'];
                            $id_venue = $data['id_venue'];
        
                            $resPackage = selectPackage($id_package);
                            $resVenue = selectVenue($id_venue);
        
                            $dataPackage = mysqli_fetch_array($resPackage);
                            $dataVenue = mysqli_fetch_array($resVenue);
                ?>
                           <tr>
                               <td> <a href="?id_order=<?php echo $data['id_order'] ?>&method=edit&pkg=update"> <?php echo $no ?> </td>
                               <td> <?php echo $data['order_date'] ?> </td>
                               <td> <?php echo $data['wedding_name'] ?> </td>
                               <td> <?php echo $data['wedding_date'] ?> </td>
                               <td> <?php echo $dataPackage['package_name'] ?> </td>
                               <td> <?php echo $dataVenue['venue_name'] ?> </td>
                               <td><a href="?id_order=<?php echo $data['id_order'] ?>&method=delete&pkg=delete">Delete</a></td>
                           </tr>
                <?php 
                    }
                } else {
                    echo "0 results";
                }
                
            ?>
            </table>
        </div>
    </section>
</body>
<script src="js/order.js"></script>
</html>
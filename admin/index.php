<?php require_once('session_check.php'); ?>

<!DOCTYPE html>

<html>

<head>

    <?php require "head.php";?>  

</head>

<body>

    <?php require "navbar.php";?>

    <?php require_once('order/order_model.php'); ?>

    <section class="overview-main">

        <ul>

            <li>

                <h3>Latest Order</h3>

                <h3><a href="order.php">All Order<span class="icon-arrow-right"></span></a></h3>

            </li>

            <?php

                $res = selectAllordersDesc();                  

                $ketemu = mysqli_num_rows($res);





                if ($ketemu > 0) {

                    while ($data=mysqli_fetch_array($res)) {

                        $id_package = $data['id_package'];

                        $id_venue = $data['id_venue'];



                        $resPackage = selectPackage($id_package);

                        $resVenue = selectVenue($id_venue);



                        $dataPackage = mysqli_fetch_array($resPackage);

                        $dataVenue = mysqli_fetch_array($resVenue);

            ?>

                        <li>

                            <h2><a href="order.php?id_order=<?php echo $data['id_order'] ?>&method=edit&pkg=update"><?php echo $data['wedding_name'] ?></a></h2>

                            <h5><?php echo $dataPackage['package_name'].'  - '.$data['wedding_date']?></h5>

                            <p><?php echo $data['order_date'] ?></p>

                        </li><hr>

            <?php 

                    }

                }

            ?>

            


        </ul>

        <ul>

            <li>

                <h3>Latest Order</h3>

                <h3><a href="order.php">All Order</a><span class="icon-arrow-right"></span></h3>

            </li>

            <?php  

                $jumlah=0;

                $resAllPackage = selectPackage(0);            

                $ketemuPackage = mysqli_num_rows($resAllPackage);



                if ($ketemuPackage > 0) {

                    while ($dataPackage=mysqli_fetch_array($resAllPackage)) {



                        $resOrder = selectAllorders();

                        $ketemuOrder = mysqli_num_rows($resOrder);  

                        if ($ketemuOrder > 0) {

                            while ($dataOrder=mysqli_fetch_array($resOrder)) {

                                if ($dataPackage['id_package'] == $dataOrder['id_package']) {

                                    $jumlah++;

                                } ;

                            }

                        }

                        ?>

                        <li>

                            <h2><a href="package.php?id_package=<?php echo $dataPackage['id_package'] ?>&method=edit&pkg=update"><?php echo $dataPackage['package_name']?></a></h2>

                            <h2><?php echo $jumlah.' Ordered' ?></h2>

                        </li><hr>

           <?php 

                        $jumlah=0;

                    }

                }

            ?>

                

            <!-- <li>

                <h3>Latest Order</h3>

                <h3><a href="order.php">All Order</a><span class="icon-arrow-right"></span></h3>

            </li>

            <li>

                <h2><a href="">1 Perfect One</a></h2>

                <h2>13 Ordered</h2>             

            </li><hr>         

            <li>

                <h2><a href="">2 Perfect Two</a></h2>

                <h2>13 Ordered</h2>               

            </li><hr>

            <li>

                <h2><a href="">3 Perfect Three</a></h2>

                <h2>13 Ordered</h2>             

            </li><hr>

            <li>

                <h2><a href="">4 Perfect Four</a></h2>

                <h2>13 Ordered</h2>               

            </li> 

            <hr>-->

        </ul>

    </section>

</body>

</html>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

</head>

<style>
#table_customer{
    display:none;
}

</style>

<body>


    <section class="order_section">
        <form action="" method="POST" class="default_form">
        <a href="order.php" class="btn-back">Back</a>
            <table id="lain">
            
                <tr>
        
                    <td>Order Date</td>
        
                    <td><?php echo $data['order_date'] ?></td>
        
                </tr>
        
                <tr>
        
                    <td>package name</td>
        
                    <td>
        
                        <select name="id_package" id="">
        
                        <?php
        
                            $resPackage = selectPackage(0);
        
                            while ($cari=mysqli_fetch_array($resPackage)) {
        
                                $id = $cari['id_package'];
        
                                $name = $cari['package_name'];  
        
                                if ($id == $selected['id_package']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Wedding Date</td>
        
                    <td><input type="text" name="wedding_date" value="<?php echo $data['wedding_date'] ?>" required></td>
        
                </tr>
        
                <tr>
        
                    <td></td>
        
                </tr>
        
                <tr>
        
                    <td>Wedding Name</td>
        
                    <td><input type="text" name="wedding_name" value="<?php echo $data['wedding_name'] ?>" required></td>
        
                </tr>
        
                <tr>
        
                    <td>bridegroom name</td>
        
                    <td><input type="text" name="name_bridegroom" value="<?php echo $data['name_bridegroom'] ?>" required></td>
        
                </tr>
        
                <tr>
        
                    <td>bride name</td>
        
                    <td><input type="text" name="name_bride" value="<?php echo $data['name_bride'] ?>" required></td>
        
                </tr>
        
                <tr>
        
                    <td>Venue</td>
        
                    <td>
        
                        <select name="id_venue" id="">
        
                        <?php
        
                            $resVenue = selectVenue(0);
        
                            while ($cari=mysqli_fetch_array($resVenue)) {
        
                                $id = $cari['id_venue'];
        
                                $name = $cari['venue_name'];  
        
                                if ($id == $selected['id_venue']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>MC</td>
        
                    <td>
        
                        <select name="id_mc" id="">
        
                        <?php
        
                            $resMC = selectMC(0);
        
                            while ($cari=mysqli_fetch_array($resMC)) {
        
                                $id = $cari['id_mc'];
        
                                $name = $cari['name'];  
        
                                if ($id == $selected['id_mc']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Vendor makeup</td>
        
                    <td>
        
                        <select name="id_VMakeup" id="">
        
                        <?php
        
                            $resVMakeup = selectVMakeup(0);
        
                            while ($cari=mysqli_fetch_array($resVMakeup)) {
        
                                $id = $cari['id_vendor_makeup'];
        
                                $name = $cari['name'];  
        
                                if ($id == $selected['id_VMakeup']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Vendor Photo & Video</td>
        
                    <td>
        
                        <select name="id_VPVV" id="">
        
                        <?php
        
                            $selectVPVV = selectVPVV(0);
        
                            while ($cari=mysqli_fetch_array($selectVPVV)) {
        
                                $id = $cari['id_vendor_photo_video'];
        
                                $name = $cari['name'];  
        
                                if ($id == $selected['id_VPVV']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Vendor Catering</td>
        
                    <td>
        
                        <select name="id_VCatering" id="">
        
                        <?php
        
                            $selectVPVV = selectVCatering(0);
        
                            while ($cari=mysqli_fetch_array($selectVPVV)) {
        
                                $id = $cari['id_vendor_catering'];
        
                                $name = $cari['name'];  
        
                                if ($id == $selected['id_VCatering']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Vendor Music</td>
        
                    <td>
        
                        <select name="id_VMusic" id="">
        
                        <?php
        
                            $resVMusic = selectVMusic(0);
        
                            while ($cari=mysqli_fetch_array($resVMusic)) {
        
                                $id = $cari['id_vendor_music'];
        
                                $name = $cari['name'];  
        
                                if ($id == $selected['id_VMusic']) {
        
                                    echo "<option selected value = $id> $name </option>";
        
                                } else {
        
                                    echo "<option value = $id> $name </option>";
        
                                }
        
                            }
        
                        ?>
        
                        </select>
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Bank Name</td>
        
                    <td><input type="text" name="bank_name" value="<?php echo $dataPayment['bank_name'] ?>" required></td>
        
                </tr>
        
                <tr>
        
                    <td>Status</td>
        
                    <td>
        
                        <input type="radio" name="status" id="" value=1 <?php echo $checked1 ?>>Transfered
        
                        <input type="radio" name="status" id="" value=0 <?php echo $checked2 ?>>Non-Transfered
        
                    </td>
        
                </tr>
        
                <tr>
        
                    <td>Total Price</td>
        
                    <td><?php echo $dataPayment['total_price'] ?></td>
        
                </tr>
        
                <tr>
        
                    <td>Down Payment</td>
        
                    <td><input type="number" name="DP" value="<?php echo $dataPayment['DP'] ?>" required></td>
        
                </tr>
        
                <tr>
        
                    <td>Email</td>
        
                    <td><?php echo $dataCustomer['email'] ?></td>
        
                </tr>
        
                <tr>
        
                    <td>Name</td>
        
                    <td><?php echo $dataCustomer['name'] ?></td>
        
                </tr>
        
                <tr>
        
                    <td>Phone Number</td>
        
                    <td><?php echo $dataCustomer['phone_number'] ?></td>
        
                </tr>
        
                <tr>
        
                    <td>Address</td>
        
                    <td><?php echo $dataCustomer['address'] ?></td>
        
                </tr>
        
            </table>
        
            <input type="submit" name="updateDataSubmit" value="Save">
    
        </form>
    </section>

</body>

</html> 
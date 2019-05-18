<?php 

if ( (isset($PVNameErr)) || (isset($PVPhoneNumberErr)) || (isset($PVAddressErr))) {

    echo $PVNameErr."<br>";

    echo $PVPhoneNumberErr."<br>";

    echo $PVAddressErr."<br>";  

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

</head>

<body>

<a href="?sdm=photovideo" class="btn-back">Back</a>



    <form action="?sdm=photovideo_model"  method="post">

    <table class="default_form">

        <tr>

            <td>Vendor Name</td>

            <td><input type="text" name="pm_name" id="" required></td>

        </tr>

        <tr>

            <td>Phone Number</td>

            <td><input type="number" name="phone_number" id="" required></td>

        </tr>

        <tr>

            <td>Address</td>

            <td><textarea name="address" id="" cols="30" rows="10" required></textarea></td>

        </tr>

    </table>

    <input type="submit" name="saveDataSubmit" value="Save">

    </form>

</body>

</html>   
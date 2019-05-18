<?php 

if ( (isset($mcNameErr)) || (isset($mcPhoneNumberErr)) || (isset($mcAddressErr))) {

    echo $mcNameErr."<br>";

    echo $mcPhoneNumberErr."<br>";

    echo $mcAddressErr."<br>";  

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

<a href="?sdm=mc" class="btn-back">Back</a>

    <form action="?sdm=mc_model" method="post" class="default_form">

    <table>

        <tr>

            <td>MC Name</td>

            <td><input type="text" name="mc_name" id="" required></td>

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
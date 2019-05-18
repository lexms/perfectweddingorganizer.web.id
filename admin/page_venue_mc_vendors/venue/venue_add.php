<?php 

if ( (isset($venueErr)) || (isset($maxCapacityErr)) || (isset($locationErr)) ||(isset($priceErr)) || (isset($status_venueErr) || (isset($imageErr)))) {

    echo $venueErr."<br>";

    echo $maxCapacityErr."<br>";

    echo $locationErr."<br>";

    echo $priceErr."<br>";

    echo $status_venueErr."<br>";

    echo $imageErr."<br>";

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

<a href="?sdm=venue" class="btn-back">Back</a>

    <form action="?sdm=venue_model" method="post" class="default_form" enctype="multipart/form-data">

    <table>

        <tr>

            <td>Name</td>

            <td><input type="text" name="venue_name" id="" required></td>

        </tr>

        <tr>

            <td>Max Capacity</td>

            <td><input type="number" name="max_capacity" id="" required></td>

        </tr>

        <tr>

            <td>Location</td>

            <td><textarea name="location" id="" cols="30" rows="10" required></textarea></td>

        </tr>

        <tr>

            <td>Price</td>

            <td><input type="number" name="price" id="" required></td>

        </tr>

        <tr>

            <td>

                ON<input type="radio" name="status_venue" id="" value="1" checked>

                OFF<input type="radio" name="status_venue" id="" value="0">

            </td>

        </tr>

        <tr>

            <td>Description</td>

            <td><textarea name="venue_desc" id="" cols="30" rows="10"></textarea></td>

        </tr>

        <tr>

            <td>Select image to upload:</td>

            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>

        </tr>

        

    </table>

    <input type="submit" name="saveDataSubmit" value="Save" required>

    </form>



</body>

</html>   
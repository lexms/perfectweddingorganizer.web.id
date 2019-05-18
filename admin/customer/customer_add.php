<?php 

if ( (isset($emailErr)) || (isset($nameErr)) || (isset($locationErr)) ||(isset($phonenumberErr)) || (isset($addressErr))) {
    echo $emailErr."<br>";
    echo $nameErr."<br>";
    echo $phonenumberErr."<br>";
    echo $addressErr."<br>";
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
<a href="customer.php">Back</a>
    <form action="customer_model.php" method="post">
    <table>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" id=""></td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td><input type="text" name="name" id=""></td>
        </tr>
        <tr>
            <td>Phone number</td>
            <td><input type="text" name="phonenumber" id=""></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><textarea name="address" id="" cols="30" rows="10"></textarea></td>
        </tr>
    </table>
    <input type="submit" name="saveDataSubmit" value="Save">
    </form>
</body>
</html>   
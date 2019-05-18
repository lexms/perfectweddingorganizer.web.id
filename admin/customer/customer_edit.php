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
    <form action="" method="post">
    <table>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" id="" value="<?php echo $data['email'] ?>"></td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td><input type="text" name="name" id="" value="<?php echo $data['name'] ?>"></td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td><input type="text" name="phone_number" id="" value="<?php echo $data['phone_number'] ?>"></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><textarea name="address" id="" cols="30" rows="10" ><?php echo $data['address'] ?></textarea></td>
        </tr>
    </table>
    <input type="submit" name="updateDataSubmit" value="Save">
    </form>
</body>
</html>   
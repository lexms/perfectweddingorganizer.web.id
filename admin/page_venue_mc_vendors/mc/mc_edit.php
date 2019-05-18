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

    <form action="" method="post" class="default_form">

    <table>

        <tr>

            <td>MC Name</td>

            <td><input type="text" name="mc_name" id="" value="<?php echo $data['name'] ?>" required></td>

        </tr>

        <tr>

            <td>Phone Number</td>

            <td><input type="number" name="phone_number" id="" value="<?php echo $data['phone_number'] ?>" required></td>

        </tr>

        <tr>

            <td>Address</td>

            <td><textarea name="address" id="" cols="30" rows="10" required><?php echo $data['address'] ?></textarea></td>

        </tr> 

    </table>

    <input type="submit" name="updateDataSubmit" value="Save">

    </form>

</body>

</html>   


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

    <form action="" method="post"  class="default_form" enctype="multipart/form-data">

    <table>

        <tr>

            <td>Name</td>

            <td><input type="text" name="venue_name" id="" value="<?php echo $data['venue_name'] ?>" required></td>

        </tr>

        <tr>

            <td>Max Capacity</td>

            <td><input type="number" name="max_capacity" id="" value="<?php echo $data['max_capacity'] ?>" required></td>

        </tr>

        <tr>

            <td>Location</td>

            <td><textarea name="location" id="" cols="30" rows="10" required><?php echo $data['location'] ?></textarea></td>

        </tr>

        <tr>

            <td>Price</td>

            <td><input type="number" name="price" id="" value="<?php echo $data['venue_price'] ?>" required></td>

        </tr>

        <tr>

            <td>Description</td>

            <td><textarea name="venue_desc" id="" cols="30" rows="10" required><?php echo $data['venue_desc'] ?></textarea></td>

        </tr>

    

        

    </table>

    <input type="submit" name="updateDataSubmit" value="Save" >

    </form>

</body>

</html>   
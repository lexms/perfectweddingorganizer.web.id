<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

 $msg = "";
if(isset($_POST['submit'])){
    require 'phpmailer/PHPMailerAutoLoad.php';

    function sendemail($to, $from ,$fromName , $body , $attachment)
    {
        $mail = new PHPMailer();
        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);
        $mail->addAttachment($attachment);
        $mail->Subject = 'Contact From - Email';
        $mail->Body = $body;
        $mail->isHTML("isHtml: false"   );

        return $mail->send();
    }

$subject = "Sending Email Using PHP Mailer";
$body ='<p>Congratulations!</p>';
$body .='<p>You have successfully received an email from
<a href="https://www.perfectweddingorganizer.web.id/">Perfect Wedding Organizer</a>.</p>';
// Enter Your Email Address Here To Receive Email
$email_to = "info@perfectweddingorganizer.web.id";
 
$email_from = "info@perfectweddingorganizer.web.id"; // Enter Sender Email
$sender_name = "This is sample"; // Enter Sender Name
require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "mail.perfectweddingorganizer.com"; // Enter Your Host/Mail Server
$mail->SMTPAuth = true;
$mail->Username = "info@perfectweddingorganizer.web.id"; // Enter Sender Email
$mail->Password = "dikisupriadi021";
//If SMTP requires TLS encryption then remove comment from below
//$mail->SMTPSecure = "tls";
$mail->Port = 25;
$mail->IsHTML(true);
$mail->From = $email_from;
$mail->FromName = $sender_name;
$mail->Sender = $email_from; // indicates ReturnPath header
$mail->AddReplyTo($email_from, "No Reply"); // indicates ReplyTo headers
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
// If you know receiver name use following
//$mail->AddAddress($email_to, "Recepient Name");
// To send CC remove comment from below
//$mail->AddCC('username@email.com', "Recepient Name");
// To send attachment remove comment from below
//$mail->AddAttachment('files/readme.txt');
/*
Please note file must be available on your
host to be attached with this email.
*/
 
if (!$mail->Send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
    echo "<div style='color:#FF0000; font-size:20px; font-weight:bold;'>
    An email has been sent to your email address.</div>";
}
?>
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        input, text {
            width : 250px;
            height : 27px;
            margin-bottom : 10px;
        }

        textarea{
            height : 100px;
            resize : vertical;

        }
        body{
            text-align : center;
            margin-top : 250px;
        }
    </style>
</head>
<body>
    <img src="images/logo.png" alt="">
    <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Name..." required> <br>
        <input type="email" name="email" id="" placholder> <br>
        <textarea name="body" id="" cols="30" rows="10" placeholder></textarea><br>
        <input type="file" name="attachment" required><br>
        <input type="submit" name="submit" value"Send">
    </form>
    <br><br>

    <?php
    echo $mail ;
    ?>

</body>
</html>

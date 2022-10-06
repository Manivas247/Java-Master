<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(!empty($name) && !empty($phone) &&!empty($email) &&!empty($message) ){
try {
   
$mail = new PHPMailer(true);

$mail->isSMTP();// Set mailer to use SMTP
$mail->CharSet = "utf-8";// set charset to utf8
$mail->SMTPAuth = true;// Enable SMTP authentication
$mail->SMTPSecure = 'ssl';// Enable TLS encryption, `ssl` also accepted

$mail->Host = 'bom1plzcpnl493855.prod.bom1.secureserver.net';// Specify main and backup SMTP servers
$mail->Port = 465;// TCP port to connect to
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);


$htmlContent = '<h2> Enquiry Received </h2>
<p> <b>Client Name: </b> '.$name . '</p>
<p> <b>Email: </b> '.$email .'</p>
<p> <b>Phone Number: </b> '.$phone .'</p>
<p> <b>Message: </b> '.$message .'</p>';
$subject = ' A New Message Received From ' .$yourName;

$mail->isHTML(true);// Set email format to HTML

$mail->Username = 'support@techmatesinfosolutions.com';// SMTP username
$mail->Password = 'Support@2022';// SMTP password

$mail->setFrom('support@techmatesinfosolutions.com');//Your application NAME and EMAIL
$mail->Subject = $subject;
$mail->Body    = $htmlContent;
$mail->addAddress('sales@techmatesinfosolutions.com');// Target email


$mail->send();
$_POST['name'] ="";
$_POST['phone'] ="";
$_POST['email'] ="";
$_POST['message'] ="";
echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    <title>Contact form</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/source/style.css" />
  </head>
  <body>
    <div class="container999">
      <h1>
        Thank you for contacting us. We will get back to you as soon as
        possible!
      </h1>
      <p class="back">Go back to the <a href="contact.html">Contact Page</a>.</p>
      <img class="sent" src="/source/assests/sent.gif" alt="" />
      
    </div>
  </body>
  <script>
  if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
  }
  </script>
</html>' ;

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
else{
    header("Location: contact.html");
}
<?php  
if( isset($_POST['submit']) ) {
//getting user data
$yourName = $_POST['yourname'];
$fromEmail = $_POST['email'];
$phone = $_POST['phone'];
$body = $_POST['yourmessage'];
 
//Recipient email, Replace with your email Address
$mailTo = 'marketing@luuluuhomes.com';
 
//email subject
$subject = ' A New Message Received From ' .$yourName;
 
//email message body
$htmlContent = '<h2> Enquiry Received </h2>
<p> <b>Client Name: </b> '.$yourName . '</p>
<p> <b>Email: </b> '.$fromEmail .'</p>
<p> <b>Phone Number: </b> '.$phone .'</p>
<p> <b>Message: </b> '.$body .'</p>';
 
//header for sender info
$headers = "From: " .$firstName . "<". $fromEmail . ">";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
 
//PHP mailer function
 $result = mail($mailTo, $subject, $htmlContent, $headers);
 
   //error checking
   if($result) {
       header("Location: contact.php");
    echo '<script>alert("The message was sent successfully!")</script>';
   
  
   } else {
       header("Location: contact.php");

    echo '<script>alert("The message was not sent!")</script>';
    
   
   }
}
 
?>
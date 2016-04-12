<?php

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
$to = $_POST['email'];
$subject = $_POST['tot']." is approximately needed for enclosed";

$message = $_POST['data']."<br /><br /><h2>".$_POST['tot']."</h2>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers .= 'From: <noreply@phploaded.com>' . "\r\n";

mail($to,$subject,$message,$headers);
echo'Email sent successfully!!!';
} else {
echo'Your email seems incorrect, please try again....!!!';
}

?>
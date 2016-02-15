<?php
// the message
$from = (isset($_POST['Email']) ? $_POST['Email'] : null);;
$name=(isset($_POST['Name']) ? $_POST['Name'] : null);;
$body=(isset($_POST['Body']) ? $_POST['Body'] : null);;
$mobile=(isset($_POST['Phone']) ? $_POST['Phone'] : null);


$to       = 'dinudiss@gmail.com';
$subject  = 'Feedback From OLPARC';
$message  = $body." ".$mobile;
$headers  = 'From: '.$from. "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

if(mail($to, $subject, $message, $headers)){
	header("location:index.php");
}
    
else
    echo "Email sending failed";
?>
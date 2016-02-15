<?php
// the message
$code = rand(1000,9999);

$to       = 'dinusha.12@cse.mrt.ac.lk';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, Thank you for registering with OLPARC. This is your confirmation key '.$code;
$headers  = 'From: dinudiss@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

if(mail($to, $subject, $message, $headers))
    echo "Email sent".code;
else
    echo "Email sending failed";
?>
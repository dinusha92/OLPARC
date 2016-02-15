<?php

 	$database = "olparc";
 	$dbpassword = "";
 	$dbhost = "localhost";
 	$dbuser = "root";
 	$prefix = "";

 	$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$database);
 	if (!$con){     
 		die('Could not connect: ' . mysqli_connect_error());  
    }    
	 mysqli_select_db($con,$database); 

?>
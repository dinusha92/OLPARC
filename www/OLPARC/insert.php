<?php 

 $database = "olparc";

$first = (isset($_POST['first']) ? $_POST['first'] : null);

$second = (isset($_POST['second']) ? $_POST['second'] : null);

$email= (isset($_POST['email']) ? $_POST['email'] : null);

$address = (isset($_POST['address']) ? $_POST['address'] : null);

$telephone = (isset($_POST['mobile']) ? $_POST['mobile'] : null);

$username = (isset($_POST['username']) ? $_POST['username'] : null);

$password = (isset($_POST['password']) ? $_POST['password'] : null);

$salt = rand(100,10000000);

$hashpass = md5($password.$salt);

 $con = mysqli_connect("localhost","root","",$database);
 if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    
 mysqli_select_db($con,$database); 
$query = "INSERT INTO `olparc`.`user details` (`First`, `Second`, `Email`, `MobileNumber`, `Address`,  `Username`, `Password`,`salt`) "
	    		."VALUES ('".$first."', '".$second."', '".$email."', '".$telephone."', '".$address."', '".$username."', '".$hashpass."', '".$salt."');"; 

	    		echo("SUccessss");
mysqli_query($con,$query); 
mysqli_close($con); 
header("location: signin.html");
exit();

?>
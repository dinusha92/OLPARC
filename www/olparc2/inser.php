<?php


	$first = (isset($_POST['firstname']) ? $_POST['firstname'] : null);
	
	$second = (isset($_POST['secondname']) ? $_POST['secondname'] : null);
	
	$email= (isset($_POST['email']) ? $_POST['email'] : null);

	$address = (isset($_POST['address']) ? $_POST['address'] : null);
	
	$telephone = (isset($_POST['mobile']) ? $_POST['mobile'] : null);
	
	$username = (isset($_POST['username']) ? $_POST['username'] : null);
	
	$city = (isset($_POST['city']) ? $_POST['city'] : null);
	
	$password = (isset($_POST['password']) ? $_POST['password'] : null);
	

	$database = "olparc";	//database name
	   $con = mysqli_connect("localhost","root" ,"",$database);//for wamp 3rd feild is balnk    
	   if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    
	    mysqli_select_db($con,$database); 
	    $query = "INSERT INTO `olparc`.`user details` (`First`, `Second`, `Email`, `MobileNumber`, `Address`, `City`, `Username`, `Password`) "
	    		."VALUES ('".$first."', '".$second."', '".$email."', '".$telephone."', '".$address."', '".$city."', '".$username."', '".$password."');"; 
	    mysqli_query($con,$query); 
	    mysqli_close($con); 
	    header("location: index.html");
	    exit();

?>
<?php 

 $database = "olparc";													//datacbase name which includes all the details

 /*line 6 to line 12 get the inpurs from the form  to the php variables*/
$first = (isset($_POST['first']) ? $_POST['first'] : null);
$second = (isset($_POST['second']) ? $_POST['second'] : null);
$email= (isset($_POST['email']) ? $_POST['email'] : null);
$address = (isset($_POST['address']) ? $_POST['address'] : null);
$telephone = (isset($_POST['mobile']) ? $_POST['mobile'] : null);
$username = (isset($_POST['username']) ? $_POST['username'] : null);
$password = (isset($_POST['password']) ? $_POST['password'] : null);
/* End of getting inputs from the input fields*/

$salt = rand(100,10000000);			//generate random variable between 100 to 10000000 to add to the password 
$hashpass = md5($password.$salt);		//after concatanate the random variable, the whole string of password s=is subjected to md5 technique

$con = mysqli_connect("localhost","root","",$database);     //connect to the database
if (!$con){  
   die('Could not connect: ' . mysqli_connect_error());  		//if connection fails
}    
mysqli_select_db($con,$database); 								//selecting database
$query = "INSERT INTO `olparc`.`user details` (`First`, `Second`, `Email`, `MobileNumber`, `Address`,  `Username`, `Password`,`salt`) "
	    		."VALUES ('".$first."', '".$second."', '".$email."', '".$telephone."', '".$address."', '".$username."', '".$hashpass."', '".$salt."');";  //take the query to input data
mysqli_query($con,$query); 			//implement the query
mysqli_close($con); 				//end of connection
header("location: signin.html");	//redirect to the signin page to sign in	
exit();

?>
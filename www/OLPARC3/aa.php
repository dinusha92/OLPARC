<?php 

 $database = "u416472291_olpar";													//datacbase name which includes all the details

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

$con = mysqli_connect("mysql.hostinger.in","u416472291_dinu","641023",$database);     //connect to the database
if (!$con){  
   die('Could not connect: ' . mysqli_connect_error());  		//if connection fails
}    
mysqli_select_db($con,$database); 								//selecting database
$query = "INSERT INTO `u416472291_olpar`.`user details` (`First`, `Second`, `Email`, `MobileNumber`, `Address`,  `Username`, `Password`,`salt`) "
	    		."VALUES ('".$first."', '".$second."', '".$email."', '".$telephone."', '".$address."', '".$username."', '".$hashpass."', '".$salt."');";  //take the query to input data
$results = mysqli_query($con,$query); 			//implement the query
mysqli_close($con); 				//end of connection
if($results){
		$code = rand(1000,9999);
		$to       = $email;
		$subject  = 'OLPARC';
		$message  = 'Hi, Thank you for registering with OLPARC. This is your confirmation key '.$code;
		$headers  = 'From: dinudiss@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

		mail($to, $subject, $message, $headers);
  
//the query has been implemented successfully on database
		$response["success"] = 1;
		$response["message"] = "User is registered in the OLPARC system";
		//response array gets these inputs if the query succeede and return to the android application
		$response["code"] = $code;
		
		echo json_encode($response);

	}
	else{
		//if the query implementation not succeeded
		$response["success"] = 0;
		$response["message"] = "Error Occured During Registering";
		//response array gets these inputs if the query fails and return to the android application
		echo json_encode($response);
	}
	//redirect to the signin page to sign in	
exit();

?>
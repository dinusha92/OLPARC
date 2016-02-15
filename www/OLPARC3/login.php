<?php
session_start();

 
  $database = "olparc";   // name ot the database is olparc


$username = (isset($_POST['username']) ? $_POST['username'] : null);   // get the user name from the input of the user

$password = (isset($_POST['password']) ? $_POST['password'] : null);   // get the password from the input of the user


 $con = mysqli_connect("localhost","root","",$database);				// connecting to the database which is hosted in localhost
 if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    	//if connection fails implement this
 mysqli_select_db($con,$database); 														//selecting database
$query =     // selecting the username and passowrd from the table in the database
$result=mysqli_query($con,$query); 																		//implement query on the selected database 
	 
$raw=mysqli_fetch_assoc($result);   																	//fetch the result as am assosiative array
if(md5($password.$raw["salt"])===$raw["Password"]){														//for secure purposes password has been subjected under salt : Input password is compared with database
	header("location: index.php");																		//redirect to this page
	$_SESSION["username"] = $username ;	
	$_SESSION["userId"] = $raw["userId"];																//start a new session with the relevant user
}
else{
	header("location: signin.html");																	//input password mismatched-> go the sign in page again
}	    		

mysqli_close($con); 																					//connection close

exit();

?>
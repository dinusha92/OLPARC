<?php
 
  $database = "olparc";


$username = (isset($_POST['username']) ? $_POST['username'] : null);

$password = (isset($_POST['password']) ? $_POST['password'] : null);


 $con = mysqli_connect("localhost","root","",$database);
 if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    
 mysqli_select_db($con,$database); 
$query = "SELECT `Password`,`salt` from `olparc`.`user details` WHERE `Username` = '".$username."'"; 
$result=mysqli_query($con,$query); 
	 

	 $raw=mysqli_fetch_assoc($result);   		
if(md5($password.$raw["salt"])===$raw["Password"]){
	header("location: index.html");
}
else{
	header("location: signin.html");
}	    		

mysqli_close($con); 

exit();

?>
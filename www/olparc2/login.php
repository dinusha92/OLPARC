<?php 

$username = $_GET['username'];
$password = $_GET['password'];
$database = "olparc";

if($username="" or $password=""){
	header("location: index.html");
}
$con = mysqli_connect("localhost","root","",$database);
if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    
	    mysqli_select_db($con,$database); 
	    $query = "SELECT `Password` FROM`olparc`.`user details`  WHERE `Username` ='".$username."'"; 
	    mysqli_query($con,$query); 
	    if($query== $password){
	    	echo "Successs";
	    }
	    mysqli_close($con); 

?>
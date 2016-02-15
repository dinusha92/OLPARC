<?php
$database = "u416472291_olpar";   // name ot the database is olparc

$userid = (isset($_POST['userid']) ? $_POST['userid'] : null);

$lotteryname =(isset($_POST['lotteryname']) ? $_POST['lotteryname'] : null);   // get the user name from the input of the user
$draw =  (isset($_POST['draw']) ? $_POST['draw'] : null); ;;
$numbers = (isset($_POST['numbers']) ? $_POST['numbers'] : null); ;;
$winning = -1000; // when the data is added to the database for the first time, the lottery has not been checked. Therefore the winning amount in considered to be a negative value.

//$password = (isset($_POST['password']) ? $_POST['password'] : null);   // get the password from the input of the user


 $con = mysqli_connect("mysql.hostinger.in","u416472291_dinu","641023",$database);				// connecting to the database which is hosted in localhost
 if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    	//if connection fails implement this
 mysqli_select_db($con,$database); 	
$query = "SELECT `lotteryId` from `u416472291_olpar`.`lottery details` WHERE `LotteryName` = '".$lotteryname."'"; 
$result1 = mysqli_query($con,$query);
 $larray =  mysqli_fetch_assoc($result1);	
 $lotid=$larray["lotteryId"];			
 									//selecting database
$query2 = "INSERT INTO `u416472291_olpar`.`Results` (`resultsId`, `userId`, `lotteryId`, `drawno`, `numbers`, `wining`)"." VALUES (NULL, '".$userid."', '".$lotid."', '".$draw."', '".$numbers."', '".$winning."');";   // selecting the username and passowrd from the table in the database
$result = mysqli_query($con,$query2); 
if($result){
	$response["success"]=1;
	$response["message"]="Successfully added for checking";
}
else{
	$response["success"]=0;
	$response["message"]="Error occurred";

}


?>
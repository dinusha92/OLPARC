<?php
$database = "u416472291_olpar";   // name ot the database is olparc

$userid = 12;//(isset($_GET['userid']) ? $_GET['userid'] : null);

 $con = mysqli_connect("mysql.hostinger.in","u416472291_dinu","641023",$database);				// connecting to the database which is hosted in localhost
 if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    	//if connection fails implement this
 mysqli_select_db($con,$database); 	
			
 									//selecting database
$query2 = "SELECT `lotteryId` ,`drawno` ,`numbers` ,`wining` FROM  `u416472291_olpar`.`Results` WHERE `userId` ='".$userid."'";   // selecting the username and passowrd from the table in the database
$array = mysqli_query($con,$query2);


	if (mysqli_num_rows($array) > 0) {
		$response["success"]=1;	

		$i=0;	
				//$array = array();
				while($row = mysqli_fetch_assoc($array)) {

					$dat[] =$row;
				
				//	echo $row["wining"];
					$i++;
				}
			$response["data"]=$dat;
			}	
	
else{
	$response["success"]=0;
	$response["message"]="Error occurred";

}
echo json_encode($response);


?>
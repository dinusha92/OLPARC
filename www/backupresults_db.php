<?php
 $database = "u416472291_olpar";   // name ot the database is olparc

$userid =(isset($_GET['userId']) ? $_GET['userId'] : null);

 $con = mysqli_connect("mysql.hostinger.in","u416472291_dinu","641023",$database);				// connecting to the database which is hosted in localhost
 if (!$con)     {     die('Could not connect: ' . mysqli_connect_error());     }    	//if connection fails implement this
 mysqli_select_db($con,$database); 	
			
 									//selecting database
$query2 = "SELECT `resultsId`,`lotteryId` ,`drawno` ,`numbers` ,`wining` FROM  `u416472291_olpar`.`Results` WHERE `userId` ='".$userid."'";   // selecting the username and passowrd from the table in the database
$array = mysqli_query($con,$query2);


	if (mysqli_num_rows($array) > 0) {
		$response["success"]=1;	

		$i=0;
				while($row = mysqli_fetch_assoc($array)) {

					if($row["wining"]<0 && $row["lotteryId"]==1){
						$rid = $row["resultsId"];
						
					   $winning =  CheckMahajana(trim($row["numbers"]),trim(check($row["lotteryId"], $row["drawno"])));
					   	$qry = "UPDATE  `u416472291_olpar`.`Results` SET  `wining` =  '".$winning."' WHERE  `Results`.`resultsId` ='".$rid."'";
					   	$r=mysqli_query($con,$qry);
					   	$row["wining"] = $winning;
					   					   
					}
						$dat[] =$row;


					
					$i++;
				}
				$response["data"]=$dat;

			}
	
else{
	//$response["success"]=0;
	//$response["message"]="Error occurred";

}
echo json_encode($response);


function check($ltryId, $drwno){
	$postdata = http_build_query(
    array(
        'lott' => $ltryId,
        'dno' => $drwno,
        'date' => null
    )
	);

	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => $postdata
	    )
	);

	$context  = stream_context_create($opts);

	$html = file_get_contents('http://www.nlb.lk/show-results.php', false, $context);


	$dom = new DOMDocument();

	# Parse the HTML from Google.
	# The @ before the method call suppresses any warnings that
	# loadHTML might throw because of invalid HTML in the page.
	@$dom->loadHTML($html);
	$resultString="";
	$response = array();
	foreach($dom->getElementsByTagName('table')  as $link) {
	        # Show the <a href>
	        if($link->getAttribute('class')=='lottery-numbers'){
	        	$i=0;
	        	foreach($link->getElementsByTagName('td')  as $link2) {
	        		//echo $link2->textContent;
	        		$response[$i]= trim($link2->textContent);
	                $resultString=$resultString." ".$response[$i];  //Result of the lottery is concatenated
	        		$i++;
	        		
	        	}
	            }
	}
	//echo trim($resultString);
	if(count($response)){
		$response["success"]=1;
	    //echo json_encode($response);
	}
	else{
	    $response["success"]=0;
	  // echo json_encode($response);
	}
	 return $resultString;

}


function CheckMahajana($resultString, $user){

$boardresult = explode(" ", $resultString);
$userInput = explode(" ", $user);

$letter=0;
$forawrd=0;
$backward=0;
$winning_amount=0;
if($boardresult[0]==$userInput[0]){
	$letter=1;
}

if($boardresult[1]==$userInput[1] && $boardresult[2]==$userInput[2]){
	$forawrd=2;
	for($i=3; $i<7;$i++){
		if($boardresult[$i]==$userInput[$i]){
			$forawrd++;
		}
		else{
			break;
		}
	}
}

if($boardresult[6]==$userInput[6]){
	$backward++;
	for($i=5; $i>0;$i--){

		if($boardresult[$i]==$userInput[$i]){
			$backward++;

		}
		else{
			break;
		}
	}
}

$max=0;


	if($letter==1){
		$winning_amount=20;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
	}

	if($forawrd==2){
		$winning_amount=50;	
		if($winning_amount>$max){
			$max=$winning_amount;
		}
	}
	if($forawrd==3){
		$winning_amount=100;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
	}
	if($forawrd==4){
		$winning_amount=1000;	
		if($winning_amount>$max){
			$max=$winning_amount;
		}
	}
	if($forawrd==5){
		$winning_amount=10000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
	}
	if($forawrd==6){
		$winning_amount= 2000000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
	}

	if($backward==1){
		$winning_amount=20;	
		if($winning_amount>$max){
			$max=$winning_amount;
		}
	}
	if($backward==2){
		$winning_amount=100;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
	}
	if($backward==3){
		$winning_amount=1000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
	}
	if($backward==4){
		$winning_amount=10000;	
		if($winning_amount>$max){
			$max=$winning_amount;
		}
	}
	if($backward==5){
		$winning_amount= 100000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
	}

	if($letter==1){
		if($forawrd==6){
			$winning_amount= 10000000;
			if($winning_amount>$max){
				$max=$winning_amount;
			}	
		}

	}

	return $max;
}


?>
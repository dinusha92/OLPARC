<?php

echo trim(check(41,564));
checkJathikaSampatha( trim(check(41,564)),"J 06 9 0 8 2 2 0");


function checkJathikaSampatha($resultString, $user){
	

$boardresult = explode(" ", $resultString);
$userInput = explode(" ", $user);

$letter=0;
$bonus=0;
$forawrd=0;
$backward=0;
$winning_amount=0;
if($boardresult[0]==$userInput[1]){
	$bonus=1;
}
if($boardresult[1]==$userInput[0]){
	$letter=1;
}

if($boardresult[2]==$userInput[2] && $boardresult[3]==$userInput[3]){
	$forawrd=2;
	for($i=4; $i<7;$i++){
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
	for($i=5; $i>1;$i--){

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
	$max=$winning_amount;
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
	
	if($backward==1){
		$winning_amount=20;	
		if($winning_amount>$max){
			$max=$winning_amount;
		}
	}
	if($backward==2){
		$winning_amount=50;	
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
		if($bonus==1){
			$winning_amount= 2000000;
			if($winning_amount>$max){
			$max=$winning_amount;
		}
		}	
	}


if($letter==1){
	if($bonus==1){
		$winning_amount=100;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		if($forawrd==5){
			$winning_amount= 5000000;
			if($winning_amount>$max){
			$max=$winning_amount;
		}
		}
	}

}

	echo $max;

}


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

?>
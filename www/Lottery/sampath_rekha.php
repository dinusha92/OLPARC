<?php

echo check(42,440);
checkSampathRekha(trim(check(42,440)),"F 39 42 44 59");
function checkSampathRekha($resultString, $user){

$boardresult = explode(" ", $resultString);
$userInput = explode(" ", $user);

$letter=0;
$bonus=0;
$forawrd=0;

$winning_amount=0;
for($i=0; $i<4;$i++){
		if($boardresult[0]==$userInput[$i+1]){
			$bonus++;
			break;
		}
		
	}
if($boardresult[1]==$userInput[0]){
	$letter=1;
}


	for($i=2; $i<6;$i++){
		if($boardresult[$i]==$userInput[$i-1]){
			$forawrd++;
		}
		
	}
 $max = 0;

	if($forawrd==1){
		$winning_amount=20;	
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		if($letter==1){
			$winning_amount=40;
			if($winning_amount>$max){
				$max=$winning_amount;
			}
		}
	}
	if($forawrd==2){
		$winning_amount=50;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
		if($letter==1){
			$winning_amount=100;
			if($winning_amount>$max){
				$max=$winning_amount;
			}
		}	
	}
	if($forawrd==3){
		$winning_amount=1000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		if($letter==1){
			$winning_amount=5000;
			if($winning_amount>$max){
				$max=$winning_amount;
			}
		}	
	}
	if($forawrd==3 && $bonus==1){
		$winning_amount=100000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		
	}
	if($forawrd==4 ){
		$winning_amount=1000000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		if($letter==1){
			$winning_amount= 5000000;
			if($winning_amount>$max){
				$max=$winning_amount;
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
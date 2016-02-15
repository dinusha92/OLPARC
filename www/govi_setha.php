<?php

function checkGoviSetha($resultString, $user){

$boardresult = explode(" ", $resultString);
$userInput = explode(" ", $user);

$letter=0;
$forawrd=0;

$winning_amount=0;
if($boardresult[0]==$userInput[0]){
	$letter=1;
}

	for($i=1; $i<5;$i++){
		if($boardresult[$i]==$userInput[$i]){
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
		$winning_amount=100;
		if($winning_amount>$max){
			$max=$winning_amount;
		}	
		if($letter==1){
			$winning_amount=1000;
			if($winning_amount>$max){
				$max=$winning_amount;
			}
		}	
	}
	if($forawrd==3){
		$winning_amount=2000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		if($letter==1){
			$winning_amount=20000;
			if($winning_amount>$max){
				$max=$winning_amount;
			}
		}	
	}
	if($forawrd==4){
		$winning_amount=1000000;
		if($winning_amount>$max){
			$max=$winning_amount;
		}
		if($letter==1){
			$winning_amount=40000000;
			if($winning_amount>$max){
				$max=$winning_amount;
			}
		}	
	}
	echo $max;

}
?>
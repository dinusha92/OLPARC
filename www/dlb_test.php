<?php
// the message
/*
$lottname = (isset($_GET['lotteryname']) ? $_GET['lotteryname'] : null);
$lotnum=0;
//$lottname = 'Mahajana Sampatha';
$drawnumber = (isset($_GET['draw']) ? $_GET['draw'] : null);
if($lottname=='Mahajana Sampatha'){
	$lotnum = 1 ;
}if($lottname=='Govi Setha'){
	$lotnum=2;
}if($lottname=='Vasana Sampatha'){
	$lotnum=6;
}if($lottname=='Supiri Wasana Sampatha'){
	$lotnum=5;
}
*/
$postdata = http_build_query(
    array(
        'db' => 'j',
        'dn' => 1190,
        'ename' => null
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

$html = file_get_contents('http://www.dlb.lk/dlb/index.php?option=com_jumi&fileid=31&Itemid=31', false, $context);


$dom = new DOMDocument();

# Parse the HTML from Google.
# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
@$dom->loadHTML($html);
$resultString="";
$response = array();

foreach($dom->getElementsByTagName('tr')  as $link) {
        # Show the <a href>
        if($link->getAttribute('class')=='alt'){
        	$i=0;
           	foreach($link->getElementsByTagName('td')  as $link2) {
        		//echo $link2->textContent;
               	$response[$i]= str_replace(chr(194)," ",$link2->textContent);
                $resultString=$resultString." ".$response[$i];  //Result of the lottery is concatenated
        		$i++;
        		echo " ";
        	}
            }
}
echo rtrim($resultString,"Â");
//echo json_encode($response);
/*
$classname="lottery-numbers";
    $finder = new DomXPath($dom);
    $spaner = $finder->query("//*[contains(@class, '$classname')]");

    echo $spaner; */
?>



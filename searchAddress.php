<?php 
	include("connection.php");
	
  $address = $_GET['address'];

  $url = 'https://maps.googleapis.com/maps/api/geocode/xml?address=' . urlencode($address) . '&key=' . $API_KEY;
  
 // Create a stream
 $opts = array(
 'http'=>array(
 'method' => "GET",
 'header' => "Authorization: Basic " 
 )
 );
 $context = stream_context_create($opts); 

 $xml = file_get_contents($url, FALSE, $context);
echo $xml;
 
 
?>


<?php 
  $url = $_GET['url'];

  
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


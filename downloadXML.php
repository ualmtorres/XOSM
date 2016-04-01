<?php
$file = "XOSM_data.xml";
$output = $_POST['mapXMLData'];
file_put_contents($file, $output);
$text = file_get_contents($file);

header("Content-type: application/text");
header("Content-Disposition: attachment; filename=\"$file\"");
die ($text); 
?>
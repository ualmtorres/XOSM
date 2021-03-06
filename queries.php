<?php

$queries[1] = array(
							'text' => '1. Retrieve the streets to the north of <i>Calzada de Castro</i> street.' ,
							'query' => 
'let  $street  :=  xosm_rtj:getElementByName (., "Calle  Calzada  de  Castro"),
$layer :=  xosm_rtj:getLayerByName (.,"Calle  Calzada  de  Castro", 100)
return  fn:filter(fn:filter($layer ,xosm_sp:furtherNorthWays($street ,?)),xosm_kw:searchKeyword (?,"highway"))',
							'exampleToRun' => 'example1rtj.xq');

$queries[2] = array(
							'text' => '2. Retrieve the streets crossing <i>Calle Calzada de Castro</i> and ending at <i>Avenida de Nuestra Señora de Montserrat</i> street.',
							'query' => 
'let  $s1 :=  xosm_rtj:getElementByName (., "Calle  Calzada  de  Castro"),
$s2 :=  xosm_rtj:getElementByName (., "Avenida  Nuestra  Señora  de  Montserrat"),
$layer  :=  xosm_rtj:getLayerByName (.,"Calle  Calzada  de  Castro" ,0),$cross  := fn:filter($layer ,xosm_sp:crossing(?,$s1))
return  fn:filter($cross ,xosm_sp:endsAt(?,$s2))',
							'exampleToRun' => 'example2rtj.xq');

$queries[3] = array(
							'text' => '3. Retrieve the schools next to an street, wherein <i>Calzada de Castro</i> street ends at',
							'query' => 
'let  $street  :=  xosm_rtj:getElementByName (., "Calle  Calzada  de  Castro"),
$layer  :=  xosm_rtj:getLayerByName (.,"Calle  Calzada  de  Castro", 0),
$ending  := fn:filter($layer ,xosm_sp:endsAt($street ,?))
return  fn:filter(fn:for-each($ending ,xosm_rtj:getLayerByElement (. ,? ,100)),xosm_kw:searchKeyword (?,"school"))',
							'exampleToRun' => 'example3rtj.xq');

$queries[4] = array(
							'text' => '4. Retrieve the buildings in the intersections of <i>Calle  Calzada  deCastro</i>',
							'query' => 
'let  $street  :=  xosm_rtj:getElementByName (., "Calle  Calzada  de  Castro"),
$layer  :=  xosm_rtj:getLayerByName (.,"Calle  Calzada  de  Castro" ,0),
$crossing  := fn:filter($layer ,xosm_sp:crossing(?, $street)),
$intpoints  := fn:for-each($crossing ,xosm_sp:intersectionPoint (?,$street))
return fn:filter(fn:for-each($intpoints , xosm_rtj:getLayerByElement (.,?,200)),xosm_kw:searchKeyword (?,"building"))',
							'exampleToRun' => 'example4rtj.xq');

$queries[5] = array(
							'text' => '5. Retrieve the schools and high schools close to <i>CalleCalzada de Castro</i> street.',
							'query' => 
'for  $layer  in  xosm_rtj:getLayerByName (.,"Calle  Calzada  de  Castro" ,100)
where  xosm_kw:searchKeywordSet($layer ,("high  school","school"))
return  $layer',
							'exampleToRun' => 'example5rtj.xq');

$queries[6] = array(
							'text' => '6. Retrieve the areas of the city in which there is a pharmacy (or chemist`s).',
							'query' => 
'for  $pharmacies  in  xosm_rtj:getElementsByKeyword (.,"pharmacy")
return  xosm_rtj:getLayerByElement (.,$pharmacies ,100)',
							'exampleToRun' => 'example6rtj.xq');

$queries[7] = array(
							'text' => '7. Retrieve the food venues close to hotels of the city.',
							'query' => 
'for  $hotels  in  xosm_rtj:getElementsByKeyword (.,"hotel")
let  $layer  :=  xosm_rtj:getLayerByElement (.,$hotels ,250)
where count(fn:filter($layer ,xosm_kw:searchKeywordSet(?,("bar","restaurant"))))  >= 3
return  $layer',
							'exampleToRun' => 'example7rtj.xq');

$queries[8] = array(
							'text' => '8. Retrieve the hotel with the greatest number of churches around.',
							'query' => 
'let  $hotels  :=  xosm_rtj:getElementsByKeyword (.,"hotel")
let $f :=  function($hotel){-(count(fn:filter(xosm_rtj:getLayerByElement (.,$hotel ,100),xosm_kw:searchKeyword (?,"church"))))}
return  fn:sort($hotels ,$f)[1]',
							'exampleToRun' => 'example8rtj.xq');

$queries[9] = array(
							'text' => '9. Retrieve the size of park areas close to <i>Paseo de Almeria</i> street.',
							'query' => 
'let  $layer  :=  xosm_rtj:getLayerByName (.,"Paseo  de  Almería" ,350),
$parkAreas  := fn:filter($layer ,xosm_kw:searchKeyword (?,"park"))
return  xosm_ag:metricSum($parkAreas ,"area")',
							'exampleToRun' => 'example9rtj.xq'
							);

$queries[10] = array(
							'text' => '10. Retrieve the hotels close to <i>Paseo de Almería</i> with the most frequent star rating',
							'query' => 
'let  $layer  :=  xosm_rtj:getLayerByName (.,"Paseo  de  Almeria" ,350),
$hotels  := fn:filter($layer ,xosm_kw:searchKeyword (?,"hotel"))
return  xosm_ag:metricMax(xosm_ag:metricMax($hotels ,"stars"), "area")',
							'exampleToRun' => 'example10rtj.xq');

$queries[11] = array(
							'text' => '11. Top star rating biggest hotels close to <i>Paseo de Almería</i>.',
							'query' => 
'let  $layer  :=  xosm_rtj:getLayerByName (.,"Paseo  de  Almeria" ,350),
$hotels  := fn:filter($layer ,xosm_kw:searchKeyword (?,"hotel"))
return  xosm_ag:metricMax(xosm_ag:metricMax($hotels ,"stars"), "area")',
							'exampleToRun' => 'example11rtj.xq');

$queries[12] = array(
							'text' => '12. Closest restaurant to <i>Paseo de Almería</i> with the most typical cuisine.',
							'query' => 
'let $layer := xosm_rtj:getLayerByName(. , "Paseo de Almería" , 0.003),
   $restaurants := fn:filter($layer , xosm_kw:searchKeyword(? , "restaurant")),
   $street := xosm_rtj:getElementByName(. , "Paseo de Almería")                  
return 
xosm_ag:minDistance(xosm_ag:metricMode($restaurants , "cuisine") , $street)',
							'exampleToRun' => 'example12rtj.xq');

?>
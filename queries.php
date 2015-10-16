<?php

$queries[1] = [
							'text' => '1. Retrieve the streets to the north of the street <i>Calzada de Castro</i>',
							'query' => 
'let $street := xosm_rtj:getElementByName($spatialIndex, "Calle Calzada de Castro"),
    $layer:= xosm_rtj:getLayerByName($spatialIndex,"Calle Calzada de Castro", 0.001)
return 
xosm_gml:_result2Osm( fn:filter(fn:filter($layer,xosm_sp:furtherNorthWays($street,?)),xosm_kw:searchKeyword(?,"highway")))',
							'exampleToRun' => 'example1rtj.xq'
							];

$queries[2] = [
							'text' => '2. Retrieve the streets crossing the street <i>Calzada de Castro</i> and ending to street <i>Avenida de Nuestra Señora de Montserrat</i>',
							'query' => 
'let $s1 := xosm_rtj:getElementByName($spatialIndex, "Calle Calzada de Castro"),
 $s2 := xosm_rtj:getElementByName($spatialIndex, 
           "Avenida Nuestra Señora de Montserrat"),
 $layer := xosm_rtj:getLayerByName($spatialIndex,"
Calle Calzada de Castro",0),
 $cross := fn:filter($layer,xosm_sp:isCrossing(?,$s1))
return 
xosm_gml:_result2Osm( fn:filter($cross,xosm_sp:isEndingTo(?,$s2)))',
							'exampleToRun' => 'example2rtj.xq'
							];

$queries[3] = [
							'text' => '3. Retrieve the schools close to an street, wherein the street <i>Calzada de Castro</i> ends',
							'query' => 
'let $street := xosm_rtj:getElementByName($spatialIndex, "Calle Calzada de Castro"),
    $layer := xosm_rtj:getLayerByName($spatialIndex,"Calle Calzada de Castro", 0),
  $ending := fn:filter($layer,xosm_sp:isEndingTo($street,?))
return
xosm_gml:_result2Osm(
fn:filter(
fn:for-each($ending,
xosm_rtj:getLayerByElement($spatialIndex,?,0.001)),
xosm_kw:searchKeyword(?,"school")))',
							'exampleToRun' => 'example3rtj.xq'
							];

$queries[4] = [
							'text' => '4. Retrieve the buildings in the intersections of <i>Calle  Calzada  deCastro</i>',
							'query' => 
'let $street := xosm_rtj:getElementByName($spatialIndex, "Calle Calzada de Castro"),
    $layer := xosm_rtj:getLayerByName($spatialIndex,"Calle Calzada de Castro",0),
    $crossing := fn:filter($layer,xosm_sp:isCrossing(?, $street)),
    $intpoints := 
fn:for-each($crossing,xosm_sp:intersectionPoint(?,$street))
return 
xosm_gml:_result2Osm( 
fn:filter(
fn:for-each($intpoints, xosm_rtj:getLayerByElement($spatialIndex,?,0.001)),
xosm_kw:searchKeyword(?,"building")))',
							'exampleToRun' => 'example4rtj.xq'
							];

$queries[5] = [
							'text' => '5. Retrieve the schools and high schools close to the street <i>CalleCalzada de Castro</i>.',
							'query' => 
'xosm_gml:_result2Osm( 
for $layer in xosm_rtj:getLayerByName($spatialIndex,"Calle Calzada de Castro",0.001)
where xosm_kw:searchKeywordSet($layer,("high school","school"))
return $layer)',
							'exampleToRun' => 'example5rtj.xq'
							];

$queries[6] = [
							'text' => '6. Retrieve the areas of the city in which there is a pharmacy.',
							'query' => 
'xosm_gml:_result2Osm( 
for $pharmacies in xosm_rtj:getElementsByKeyword($spatialIndex,"pharmacy")
return xosm_rtj:getLayerByElement($spatialIndex,$pharmacies,0.001))
',
							'exampleToRun' => 'example6rtj.xq'
							];

$queries[7] = [
							'text' => '7. Retrieve the food areas close to hotels of the city.',
							'query' => 
'xosm_gml:_result2Osm( 
for $hotels in xosm_rtj:getElementsByKeyword($spatialIndex,"hotel") 
let $layer := xosm_rtj:getLayerByElement($spatialIndex,$hotels,0.002) 
where count(fn:filter($layer,
xosm_kw:searchKeywordSet(?,("bar","restaurant")))) >= 3
return $layer)',
							'exampleToRun' => 'example7rtj.xq'
							];

$queries[8] = [
							'text' => '8. Retrieve the hotel with the greatest number of churches around',
							'query' => 
'let $hotels := xosm_rtj:getElementsByKeyword($spatialIndex,"hotel")
let $f := function($hotel) 
{-(count(fn:filter(xosm_rtj:getLayerByElement($spatialIndex,$hotel,0.001),xosm_kw:searchKeyword(?,"church"))))}
return xosm_gml:_result2Osm(fn:sort($hotels,$f)[1])',
							'exampleToRun' => 'example8rtj.xq'
							];

$queries[9] = [
							'text' => '9. Retrieve the size of park areas close to the street <i>Paseo de Almeria</i>',
							'query' => 
'let $layer := xosm_rtj:getLayerByName($spatialIndex,"Paseo de Almería",0.003),
    $parkAreas := fn:filter($layer,xosm_kw:searchKeyword(?,"park"))          
return 
xosm_ag:metricSum($parkAreas,"area")',
							'exampleToRun' => 'example9rtj.xq'
							];

$queries[10] = [
							'text' => '10. Retrieve the most frequent star rating of hotels close to <i>Paseo de Almería</i>',
							'query' => 
'let $layer := xosm_rtj:getLayerByName($spatialIndex,"Paseo de Almería",0.003),
   $hotels := fn:filter($layer,xosm_kw:searchKeyword(?,"hotel"))                  
return xosm_gml:_result2Osm(xosm_ag:metricMode($hotels,"stars"))',
							'exampleToRun' => 'example10rtj.xq'
							];

$queries[11] = [
							'text' => '11. Biggest hotels of top star ratings close to <i>Paseo de Almería</i>.',
							'query' => 
'let $layer := xosm_rtj:getLayerByName($spatialIndex,"Paseo de Almería",0.003),
$hotels := fn:filter($layer,xosm_kw:searchKeyword(?,"hotel"))                  
return
xosm_gml:_result2Osm( xosm_ag:metricMax(xosm_ag:metricMax($hotels,"stars"), "area"))',
							'exampleToRun' => 'example11rtj.xq'
							];

$queries[12] = [
							'text' => '12. Closest restaurant to <i>Paseo de Almería</i> having the most typical cuisine.',
							'query' => 
'let $street := xosm_rtj:getElementByName($spatialIndex,"Paseo de Almeria"),
$layer := xosm_rtj:getLayerByName($spatialIndex,"Paseo de Almeria",0.003),
$restaurants := fn:filter($layer,xosm_kw:searchKeyword(?,"restaurant")),                 
return 
xosm_gml:_result2Osm( xosm_ag:minDistance(xosm_ag:metricMode($restaurants,"cuisine"),$street))',
							'exampleToRun' => 'example12rtj.xq'
							];

?>
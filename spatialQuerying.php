<?php
	include('connection.php');
	include ('header.php');
?>

<script type="text/javascript">
$('document').ready (
  function (){
    $('#spatialbtn').addClass("active");
  });      
</script>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Spatial OpenStreetMap Queries</h3>
      </div>
      <div class="modal-body">
        <span>In our library, we have proposed and designed a repertoire of Spatial Operators, 
          suitable for OSM maps; that is, it handles the particular nature of the XML representation of OSM, 
          as well as it is designed to be able to check specific spatial relationships over elements in OSM maps. 
          Spatial Operators will allow us to express Geo-Localized Queries over OSM layers, by means of two kind of operators: Coordinate based OSM Operators and 
          Clementini based OSM Operators
        </span>
        <h3>Spatial OpenStreetMap Operators</h3>
        <ul>
          <li><b>Coordinate based OSM Operators</b></li>
          <ul>
            <li>Based on Distance<br/>
              <code>isIn(s1,s2), isNext(s1,s2), isAway(s1,s2)</code></li>
              <li>Based on Latitude and Longitude<br/>
                <code>furtherNorthPoints(p1,p2), furtherSouthPoints(p1,p2), furtherEastPoints(p1,p2), furtherWestPoints(p1,p2), furtherNorthWays(s1,s2), furtherSouthWays(s1,s2), furtherEastWays(s1,s2), furtherWestWays(s1,s2)</code></li>
          </ul>
          <li><b>Clementini based OSM Operators</b></li>
          <code>inWay(p,s), inSameWay(p1,p2), intersectionPoint(s1,s2), isCrossing(s1,s2), isParallel(s1,s2), isEndingTo(s1,s2), isContinuationOf(s1,s2)</code>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Running Query</h3>
      </div>
      <div class="modal-body">
        <div class="loader" data-initialize="loader"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showOSM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">OSM data</h3>
      </div>
      <div class="modal-body">
      	<code>
      		<div id="osmData">
      		</div>
      	</code>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="container fu-docs-container">

  <div class="row">
    <div class="col-md-9" role="main">


      <div class="fu-docs-section">
        <h2 id="wizard" class="page-header">Running XQuery Queries</h2>

        <p>Make queries on OpenStreetMap using Spatial operators

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal">
          Show Info
        </button>
        </p>

         <div>

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#menuPredefinedExamples" aria-controls="home" role="tab" data-toggle="tab">Predefined Examples</a></li>
            <li role="presentation"><a href="#menuXQueryShell" aria-controls="profile" role="tab" data-toggle="tab">XQuery Shell</a></li>
            <li role="presentation"><a href="#menuExamples" aria-controls="messages" role="tab" data-toggle="tab">Examples</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="menuPredefinedExamples">
              <h4>Test Predefined Examples over Almeria Map</h4>

              <div class = "form-group">
                <div class="input-group">
                  <span class="input-group-addon">Query Example</span>
                  <select name = 'exampleList' id = 'exampleList' class="form-control" 
                  onclick ="exampleListQuery();">
                </select> 
              </div>
            </div>
            <button type = "button" id = "runXQueryExamplebtn" class="btn btn-primary">Run</button>
            </div>
            <div role="tabpanel" class="tab-pane" id="menuXQueryShell">
              <h4>Running a XQuery example from a shell</h4>

              <div class="wizard" data-initialize="wizard" id="XQueryShell">
                <ul class="steps">
                  <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Select Index<span class="chevron"></span></li>
                  <li data-step="2"><span class="badge">2</span>Run XQuery<span class="chevron"></span></li>
                </ul>
                <div class="actions">
                  <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Prev</button>
                  <button type="button" class="btn btn-default btn-next" data-last="Complete">Next<span class="glyphicon glyphicon-arrow-right"></span></button>
                </div>
                <div class="step-content">
                  <div class="step-pane active sample-pane" data-step="1">
                    <h4>Select a Spatial Index</h4>
                    <div class="input-group">
                      <span class="input-group-addon">Spatial Index</span>
                      <select name = 'database' id = 'database' class="form-control" 
                      onclick ="databaseListing()">
                    </select>    
                  </div>
                </div>

                <div class="step-pane" data-step="2">
                  <h4>Run XQuery query using the selected index</h4>
                  <textarea id = 'query' name = 'query' rows = '10' cols = '80' placeholder = 'XQuery shell - Examples Tab provides some testing examples'></textarea><br/>
                  <button onclick = "$('#query').val('');" class="btn btn-warning">Clear</button>
                  <button  id = "runXQueryShellbtn" class="btn btn-primary">Run</button><br/>
                  
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="menuExamples">
            <h3>Spatial OSM Query Examples</h3>
            <h4>Spatial Index to be used: <b>spatialIndexCalzadaCastroAlmeria</b></h4>




            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Retrieve the streets to the north of the street <i>Calzada de Castro</i>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                   <pre>           
osm_gml:_result2Osm(
fn:filter(rt:getLayerByName($spatialIndex,"Calle Calzada de Castro", 0.001), 
osm:furtherNorthWays(rt:getElementByName($spatialIndex, "Calle Calzada de Castro"),?)))
                  </pre>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Retrieve the streets crossing the street <i>Calzada de Castro</i> and ending to street <i>Avenida de Nuestra Señora de Montserrat</i>
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <pre>
let $onewaysCrossing := 
fn:filter(rt:getLayerByName($spatialIndex,"Calle Calzada de Castro",0), 
osm:isCrossing(?, rt:getElementByName($spatialIndex, "Calle Calzada de Castro")))
return
osm_gml:_result2Osm(
fn:filter($onewaysCrossing,osm:isEndingTo(?,rt:getElementByName($spatialIndex, "Avenida de Nuestra Señora de Montserrat"))))
                  </pre>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Retrieve the schools close to an street, wherein the street <i>Calzada de Castro</i> ends
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <pre>
let $onewaysAllEndingTo :=
fn:filter(rt:getLayerByName($spatialIndex,"Calle Calzada de Castro", 0),
osm:isEndingTo(rt:getElementByName($spatialIndex, "Calle Calzada de Castro"),?))
return
osm_gml:_result2Osm(
fn:filter(fn:for-each($onewaysAllEndingTo, rt:getLayerByElement($spatialIndex,?,0.01)), 
osm:searchTags(?,"school")))
                  </pre>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
			<br/>
      <div id="map" style="width: 600px; height: 400px"></div>
      <br/>
      <button id="showOSMbtn" class="btn btn-primary" data-toggle="modal" data-target="#showOSM">Show OSM data</button><br/>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">
          <div id="modalAlertTitle"></div>
        </h3>
      </div>
      <div class="modal-body">
        <p>
          <div id="modalAlertBody"></div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script src="js/XOSM.js"></script>

<?php
include ('footer.php');
?>


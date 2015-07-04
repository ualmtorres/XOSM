<?php
	include('connection.php');
	include ('header.php');
?>

<script type="text/javascript">
$('document').ready (
  function (){
    $('#keywordbtn').addClass("active");
  });      
</script>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Keyword OpenStreetMap Queries</h3>
      </div>
      <div class="modal-body">
        <span>In our library, we have proposed and designed a repertoire of Keyword Operators, 
            suitable for OSM maps; that is, it handles the particular nature of the XML representation of OSM, 
            as well as it is designed to be able to check the textual features of OSM elements. 
            Keyword Operators will allow us to manipulate pairs <b>@k</b> and <b>@v</b> in XML tags <b>tag</b>
        </span>
        <h3>Keyword OpenStreetMap Operators</h3>
        <ul>
          <li><code>addTag(osmElement,kValueToAdd,vValueToAdd)</code></li>
          <li><code>removeTag(osmElement,kValueToRemove,vValueToRemove)</code></li>
          <li><code>replaceTag(osmElement,kValueToReplace,vValueToReplace)</code></li>
          <li><code>searchOneTag(osmElement,valueToSearch)</code></li>
          <li><code>searchTags(osmElement,collectionValueToSearch)</code></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="container fu-docs-container">

  <div class="row">
    <div class="col-md-12" role="main">


      <div class="fu-docs-section">
        <h2 id="wizard" class="page-header">Running XQuery Keyword Queries</h2>

        <p>Make queries on OpenStreetMap using Keyword operators

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
                  onclick ="exampleListQuery('keyword');">
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
            <h3>Keyword OSM Query Examples</h3>
            <h4>Keyword Index to be used: <b>spatialIndexCalzadaCastroAlmeria</b></h4>




            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Retrieve the schools and high schools close to the street <i>Calzada de Castro</i>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                   <pre>           
osm_gml:_result2Osm(fn:filter(rt:getLayerByName($spatialIndex,
"Calle Calzada de Castro", 0.001),
osm:searchTags(?,("high school","school"))))
                  </pre>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Retrieve the areas of the city in which there is a pharmacy
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <pre>
osm_gml:_result2Osm(fn:for-each(rt:getElementsByKeyword($spatialIndex,"pharmacy"),
rt:getLayerByElement($spatialIndex, ?, 0.001)))
                  </pre>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Retrieve the food areas close to hotels of the city
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <pre>
osm_gml:_result2Osm(fn:filter(fn:for-each(
rt:getElementsByKeyword($spatialIndex,"hotel"),
rt:getLayerByElement($spatialIndex,?,0.001)),function($osmLayer)
  {count(fn:filter($osmLayer, osm:searchTags(?,("bar", "restaurant")))) >= 3}))
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

<?php
  include('mapDiv.php');
  include('commonModals.php');
?>

<script src="js/XOSM.js"></script>

<?php
include ('footer.php');
?>


<?php
	include('connection.php');
	include ('header.php');
?>

<script type="text/javascript">
$('document').ready (
  function (){
    $('#aggregationbtn').addClass("active");
  });      
</script>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Aggregation OpenStreetMap Queries</h3>
      </div>
      <div class="modal-body">
        <p>
          Here, we will show the proposed operators in our library for expressing aggregation queries. 
             The aggregation operators are inspired by the SOLAP operators. They consider two levels of operators. 
             <ul>
              <li>The first level includes Numeric-Spatial and Numeric-Multidimensional operators. Numeric-Spatial operators 
             can be topological (boolean (i.e., one-zero) Clementini’s operators), 
             and metric (area,length, perimeter and distance), while Numeric-Multidimensional 
             are max, min, sum, count and distinct count, among others.</li>
             <li>A second level is defined from the first level and it enables the retrieval 
             of objects according to the corresponding numeric values. </li>
           </ul>
           Additionally, Numeric-Multi dimensional 
             operators can be classified by Distributive, Algebraic or Holistic. 
             <ul>
              <li>An aggregate function 
             is Distributive if it can be computed in a distributed manner, that is, the result 
             derived by applying the function to the n aggregate values is the same as that derived by applying
             the function to the entire data set (without parti- tioning). </li>
             <li>An aggregate function 
             is Algebraic if it can be computed by an algebraic function with m 
             arguments (where m is a bounded positive integer), each of which is 
             obtained by applying a distributive aggregate function. </li>
             <li>An aggregate 
             function is Holistic when there does not exist an algebraic function with m arguments that characterizes the computation.</li>
           </ul>

        </p>
        <h3>Aggregation OpenStreetMap Operators</h3>
        <ul>
          <li><b>Distributive Operators</b></li>
          <ul>
            <li><code>topologicalCount(osmElements,osmElement,topologicalRelation)</code></li>
            <li><code>metricMin(osmElements,metricOperator)</code></li>
            <li><code>metricMax(osmElements,metricOperator)</code></li>
            <li><code>metricSum(osmElements,metricOperator)</code></li>
            <li><code>minDistance(osmElements)</code></li>
            <li><code>maxDistance(osmElements)</code></li>
          </ul>
          <li><b>Algebraic Operators</b></li>
          <ul>
            <li><code>metricAvg(osmElements,metricOperator)</code></li>
            <li><code>avgDistance(osmElements)</code></li>
            <li><code>metricStdev(osmElements,metricOperator)</code></li>
            <li><code>metricTopCount(osmElements,metricOperator,k)</code></li>
            <li><code>metricBottomCount(osmElements,metricOperator,k)</code></li>
            <li><code>TopCountDistance(osmElements,k)</code></li>
            <li><code>BottomCountDistance(osmElements,k)</code></li>
          </ul>
          <li><b>Holistic Operators</b></li>
          <ul>
            <li><code>metricMedian(osmElements,metricOperator)</code></li>
            <li><code>metricMode(osmElements,metricOperator)</code></li>
            <li><code>metricRank(osmElements,metricOperator)</code></li>
            <li><code>metricRange(osmElements,metricOperator)</code></li>
          </ul>
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
        <h2 id="wizard" class="page-header">Running XQuery Aggregation Queries</h2>

        <p>Make queries on OpenStreetMap using Aggregation operators

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
                  onclick ="exampleListQuery('aggregation');">
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
            <h3>Aggregation OSM Query Examples</h3>
            <h4>Aggregation Index to be used: <b>spatialIndexCalzadaCastroAlmeria</b></h4>




            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Retrieve the size of park areas close to the street <i>Paseo de Almería</i>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                   <pre>           
let $parkAreas := fn:filter(rt:getLayerByName($spatialIndex,"Paseo de Almeria",0.003), 
osm:searchTags(?,"park"))
return osm_aggr:metricSum($parkAreas,"osm:getArea")
                  </pre>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Retrieve the most frequent star rating of hotels close to <i>Paseo de Almeria</i>
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <pre>
let $hotels := fn:filter(rt:getLayerByName($spatialIndex,"Paseo de Almeria",0.003),
osm:searchTags(?,"hotel"))
return osm_aggr:metricMode($hotels,"osm:getHotelStars")
                  </pre>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Retrieve he biggest hotels of top star ratings close to <i>Paseo de Almeria</i>
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <pre>
let $hotels := fn:filter(rt:getLayerByName($spatialIndex,"Paseo de Almeria",0.003),
osm:searchTags(?,"hotel"))
return osm_aggr:metricMax(osm_aggr:metricMax($hotels,
"osm:getHotelStars"),"osm:getArea")
                  </pre>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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


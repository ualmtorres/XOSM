<?php
  include('connection.php');
  include('header.php');
?>

<script language="JavaScript" type="text/javascript">
  $('document').ready (
    function (){
    $('#indexingbtn').addClass("active");
  });
</script>

<div class="container fu-docs-container">

  <div class="row">
    <div class="col-md-12" role="main">


      <div class="fu-docs-section">
        <h2 id="wizard" class="page-header">OpenStreetMap Spatial Indexing Wizard</h2>

        <p>
          Follow the steps below to define the spatial index.

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
          Show Info
        </button>
        </p>

        <div class="wizard" data-initialize="wizard" id="indexingWizard">
          <ul class="steps">
            <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Select Region<span class="chevron"></span></li>
            <li data-step="2"><span class="badge">2</span>Select Index<span class="chevron"></span></li>
            <li data-step="3" data-name="template"><span class="badge">3</span>Create index<span class="chevron"></span></li>
          </ul>
          <div class="actions">
            <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Prev</button>
            <button type="button" class="btn btn-default btn-next" data-last="Complete">Next<span class="glyphicon glyphicon-arrow-right"></span></button>
          </div>
          <div class="step-content">
            <div class="step-pane active sample-pane" data-step="1">
              <h3>Selection of Map and Zoom Level for Indexing</h3>
              <div>
                <div id = 'datos'></div>
                <div id="map" style="height: 300px"></div>
              </div>
            </div>
            <div class="step-pane" data-step="2">
              <h3>Specification of Spatial Index Name</h3>
              <div class = "form-group">
                <div class="input-group">
                  <span class="input-group-addon">Spatial Index Name</span>
                  <input type = 'text' placeholder="i.e. osm" name = 'database' id = 'database' class="form-control" >
                </div>
              </div>
            </div>
            <div class="step-pane" data-step="3">
              <h3>Spatial Index Creation</h3>

              <button type = "button" value = "databaseName" id = "btnAjax" onclick = "indexing();" class="btn btn-primary"/>Create Index</button>
           </div>
         </div>

       </div>

     </div>

     <script type="text/javascript">
     $('#indexingWizard').on('changed.fu.wizard', function (evt, data) {
      switch(data.step) {
        case 2:
        if (map.getZoom() < 16) {
          $('#zoomToLarge').modal('show');
          $('#indexingWizard').wizard('selectedItem', {
            step: 1
          });
          map.setZoom(16);            
        }
        break;
        case 3:
        if (jQuery.trim($('#database').val()).length == 0) {
          $('#emptyTextbox').modal('show');
          $('#database').val('');
          $('#indexingWizard').wizard('selectedItem', {
            step: 2
          });
        }
        break;
      }});
     </script>
   </div>
 </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Spatial Index Creation</h3>
      </div>
      <div class="modal-body">
        <span>In order to handle large city maps, in which the layer can include many OSM elements, 
          an R-tree structure to index objects has been implemented. 
          The R-tree structure is based as usual on MBR's (<b>Minimum Bounding Rectangles</b>) to hierarchically 
          organize the content of an OSM map, and they are also used to enclose in leaves nodes and ways of OSM
        </span>
        <h3>Spatial Index Process</h3>
        <span><b>In order to query OSM maps from the library, the next steps are needed:</b><br/>
          <ol>
            <li>Select the map and zoom level to be indexed</li>
            <li>Specify a spatial index name</li>
            <li>Click over the button in order to create the spatial index over the selected map</li>
          </ol>
          A database will be generated, and it could be used at the query (i.e. spatial, keyword and aggregation) pages
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id = 'spatialIndexModalTitle'>Creating Spatial Index</h3>
      </div>
      <div class="modal-body">
        <div class="loader" data-initialize="loader"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="zoomToLarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Zoom too large</h3>
      </div>
      <div class="modal-body">
        <p>
          Zoom too large. Please, select a smaller zoom.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="emptyTextbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Empty Index Name</h3>
      </div>
      <div class="modal-body">
        <p>
          The index name cannot be empty
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<script language="JavaScript" type="text/javascript">

var controls = [];

var map = L.map('map').setView([36.8395487, -2.45245], 16);

    L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'examples.map-i875mjb7'
    }).addTo(map); 

function indexing(){
  
    var southWest = map.getBounds().getSouthWest();
    var northEast = map.getBounds().getNorthEast();


       var url = 'http://basex.cloudapp.net:8984/rest?run=indexing.xq' + '&databaseName=' + $('#database').val() + '&bbox1=' + southWest.lng + '&bbox2=' + southWest.lat + '&bbox3=' + northEast.lng + '&bbox4=' + northEast.lat;  

       $('#spatialIndexModalTitle').text('Creating Spatial Index ' + $('#database').val());
       $('#loader').modal('toggle');

       $.ajax({
         url: 'XQueryIndexing.php',
         type: 'GET',
         data: {url:url},
         success: actualizar
       })

       function actualizar(datos){
             $('#loader').modal('hide');
         }
      }
      
</script>

<?php
  include('footer.php');
?>
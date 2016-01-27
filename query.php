<?php
include('connection.php');
include('header.php');
include('queries.php');
?>



<div class="container fu-docs-container">

  <div class="row">
    <div class="col-md-12" role="main">


      <div class="fu-docs-section">

        <div class="page-header">
        </div>

        <div class = "col-md-9">


          <div class="form-group row">
                <label for="inputKey" class="col-md-1 control-label">Address:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="address" placeholder="i.e. Calzada de Castro, Almeria, Spain">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary" onclick="getLngLat($('#address').val());">Search</button>
                </div>
            </div>

          <div id = 'datos'></div>
          <div id="map" style="height: 700px"></div>
          <p></p>
        </div>

        <div class = "col-md-3">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#menuXQueryShell" aria-controls="profile" role="tab" data-toggle="tab">XQuery Shell</a></li>
            <li role="presentation"><a href="#menuExamples" aria-controls="messages" role="tab" data-toggle="tab">Examples</a></li>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal">
              Show Info
            </button>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="menuXQueryShell">
                  <textarea id = 'query' name = 'query' rows = '30' cols = '50' placeholder = 'XQuery shell - Examples Tab provides some testing examples'></textarea><br/>
                  <button onclick = "removeMapLayers();" class="btn btn-warning">Clear Map</button>
                  <button onclick = "clearQuery();" class="btn btn-warning">Clear Query</button>
                  <button  id = "runXQueryShellbtn" class="btn btn-primary">Run</button><br/>
            </div>
            <div role="tabpanel" class="tab-pane" id="menuExamples">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

              <?php
              for ($i = 1; $i < count($queries) + 1; $i++) {
  echo '<div class="panel panel-default">';
  echo '  <div class="panel-heading" role="tab" id="heading' . $i . '">';
  echo '    <h4 class="panel-title">';
  echo '    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $i .'" aria-controls="collapse' . $i . '">';
  echo $queries[$i]["text"];
  echo '    </a>';
  echo '    </h4>';
  echo '  </div>';
  if ($i == 1) {
    echo '  <div id="collapse' . $i. '" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading' . $i . '">';
  }
  else {
    echo '  <div id="collapse' . $i. '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $i . '">';
  }
  echo '    <div class="panel-body">';
  echo '      <div class = "col-md-11">';
  echo '        <pre>';
  echo $queries[$i]["query"];
  echo '        </pre>';
  echo '      </div>';
  echo '      <div class = "col-md-1 vcenter">';
  echo '        <button class="btn btn-primary" onclick="runningXQueryExample(\'' . $queries[$i]["exampleToRun"] . '\');">Run</button>';
  echo '      </div>';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
}
?>                                 
          </div>           
            </div>
          </div>
        </div>

      </div>
    </div>
</div>
</div>

<script language="JavaScript" type="text/javascript">

var lat = 36.8395487;
var lng = -2.45245;

function getLngLat(address) {

     $.ajax({
      url: 'searchAddress.php',
      type: 'GET',
      data: {address:address},
      dataType: 'text',
      success: refresh
    })
     function refresh(data){

       var returnedXML = data; 
       var xmlParsed = $.parseXML( returnedXML );
       var xmlDoc = $( xmlParsed );

       lat = xmlDoc.find("geometry").find("location").find("lat").text();
       lng = xmlDoc.find("geometry").find("location").find("lng").text();

       map.panTo([lat, lng]);
     }

}

var controls = [];

var map = L.map('map').setView([lat, lng], 16);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

    var southWest = map.getBounds().getSouthWest();
    var northEast = map.getBounds().getNorthEast();


function indexing(){
  
    var southWest = map.getBounds().getSouthWest();
    var northEast = map.getBounds().getNorthEast();


       var url = 'http://basexserver.cloudapp.net:8984/rest?run=indexing.xq' + '&databaseName=' + $('#database').val() + '&bbox1=' + southWest.lng + '&bbox2=' + southWest.lat + '&bbox3=' + northEast.lng + '&bbox4=' + northEast.lat;  

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

    function showModalAlert(alertTitle, alertBody) {
      $('#modalAlertTitle').text(alertTitle);
      $('#modalAlertBody').text(alertBody);
      $('#modalAlert').modal('show');
     }

    function showModalLoader(loaderTitle, loaderBody) {
      $('#loaderTitle').text(loaderTitle);
      $('#loaderBody').text(loaderBody);
      $('#loader').modal('show');
     }

    function hideModalLoader() {
      $('#loader').modal('hide');
     }

    $('#runXQueryShellbtn').click(function() {
      if ($('#query').val() == '') {
          showModalAlert('XQuery code is missing', 'XQuery code must me typed');
      }
      else {
        runningXQueryShell();
      }
    });



$(function(){
 
  $(document).on( 'scroll', function(){
 
    if ($(window).scrollTop() > 100) {
      $('.scroll-top-wrapper').addClass('show');
    } else {
      $('.scroll-top-wrapper').removeClass('show');
    }
  });
 
  $('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
  verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
  element = $('body');
  offset = element.offset();
  offsetTop = offset.top;
  $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}


  function runningXQueryShell(){
    if (map.getZoom() < 16) {
      showModalAlert('Zoom too large', 'Zoom too large. Please, select a smaller zoom.');
      map.setZoom(16);
    }
    else {

      var southWest = map.getBounds().getSouthWest();
      var northEast = map.getBounds().getNorthEast();

      var text = $('#query').val();  

      // Create database

      var url = 'http://basexserver.cloudapp.net:8984/rest?run=creatingDatabase.xq&bbox1=' + southWest.lng + '&bbox2=' + southWest.lat + '&bbox3=' + northEast.lng + '&bbox4=' + northEast.lat; 

      // Cambiar para que sea síncrono
      createDatabase(url); 

      // Retrieve OSM data

      var url = 'http://basexserver.cloudapp.net:8984/rest?run=runningXQueryEvalrtj.xq&textArea=' + encodeURIComponent(text); 

      runQuery(url);    
    }


  }

    function runningXQueryExample(example){
    //$('#indexing').modal('show');
    

    var url = 'http://basexserver.cloudapp.net:8984/rest?run=' + example;

    runQuery(url);
    }

  function createDatabase(url) {
    $.ajax({
      url: 'elementsFromAPI.php',
      type: 'GET',
      data: {url:url},
      dataType: 'text',
      async: false,
      success: refresh
    })
      function refresh(){
        hideModalLoader();
    }
  }

  function runQuery(url) {
    showModalLoader("Querying", "Querying and depicting resulting objects");

    $.ajax({
      url: 'elementsFromAPI.php',
      type: 'GET',
      data: {url:url},
      dataType: 'text',
      success: refresh
    }
    )
    function refresh(data){
      // Empty documents return 3 characters
      if (data.length > 3) {
        $('#osmData').text(data);

        if (data.indexOf("<") > -1) {
          $('#showOSMbtn').show();
          drawMap(data);        
        }
        else {
          removeMapLayers();
          $('#showOSM').modal('show');
        }
      }
      else {
        removeMapLayers();
      }
      hideModalLoader();
      scrollToTop();


    }
  }

function clearQuery() {
  $('#query').val('');
}

function removeMapLayers() {
    for (z = 0; z < controls.length; z++) {
      map.removeLayer(controls[z]);
    }
}

function drawMap(data) {
  
    for (z = 0; z < controls.length; z++) {
      map.removeLayer(controls[z]);
    }

    controls = [];

    $('#map').show();

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

 
        var pointList = [];

        // Obtener la primera latitud y longitud que aparece para tomarla como centro del mapa
        var firstNode = $(data).find("node").first();
        var firstLat = firstNode.attr("lat");
        var firstLon = firstNode.attr("lon");

        map.panTo([firstLat, firstLon]);

        // Find ways
        $(data).find("way").each(function(){
          pointList = [];
          var name = $(this).find("tag[k='name']").attr('v');

          $(this).find("nd").each(function(){

            var ref = $(this).attr('ref');
            var elementToFind = 'node[id=' + ref + ']';

            var lat = $(data).find(elementToFind).attr('lat');
            var lon = $(data).find(elementToFind).attr('lon');

            var point = new L.LatLng(lat, lon);
            pointList.push(point);
          })

          var firstpolyline = new L.polyline(pointList, {
            color: "blue",
            opacity: 1
          });

          firstpolyline.addTo(map).bindPopup(name);

          controls.push(firstpolyline);
        })

        /* Find isolated points: node elements that are not nd elements */

        //Build a string list of nd elements
        var stringNDList = "";
        $(data).find("nd").each(function(){
          stringNDList += "·" + $(this).attr('ref') + "· ";
        })

        // Show node element if it is not included in the list of nd elements
        $(data).find("node").each(function(){
          // Get the id attribute of the node
          var id = "·" + $(this).attr('id') + "·";

          // If the id is not included in the list of nd's (it is an isolated node)
          if (stringNDList.indexOf(id) == -1) {
            //Get lat, lon and name
            var lat = $(this).attr('lat');
            var lon = $(this).attr('lon');
            var name = $(this).find("tag[k='name']").attr('v');
            
            // Create a marker and add it to the map
            var control = L.marker([lat, lon]);
            control.addTo(map)
            .bindPopup(name);      
            controls.push(control);

          }
        })
  }
</script>


<?php
include('footer.php');
?>
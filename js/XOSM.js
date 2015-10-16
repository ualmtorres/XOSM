//basex.cloudapp.net:8984/rest devuelve la lista de BD creadas en BaseX 


var controls = [];

var map = L.map('map').setView([36.8395487, -2.45245], 16);

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



    function showModalAlert(alertTitle, alertBody) {
      $('#modalAlertTitle').text(alertTitle);
      $('#modalAlertBody').text(alertBody);
      $('#modalAlert').modal('show');
     }


$('document').ready (
  function (){
    $('#map').hide();
    $('#showOSMbtn').hide();

    $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
     $('#map').hide();
     $('#showOSMbtn').hide();
   })
  });



     $('#XQueryShell').on('actionclicked.fu.wizard', function (evt, data) {

       $('#map').hide();
       $('#showOSMbtn').hide();

      switch(data.step) {
        case 1:
        if ($('#database').val() == null) {
          showModalAlert('Index not selected', 'An Index must be selected');
          $('#XQueryShell').wizard('selectedItem', {
            step: 1
          });  
          evt.preventDefault();     
        }
        break;
      }});

     $('#XQueryShell').on('finished.fu.wizard', function (evt, data) {
        if ($('#query').val() == '') {
          showModalAlert('XQuery code is missing', 'XQuery code must me typed');
        }
        else {
          runningXQueryShell();
        }
      });  

     $('#runXQueryExamplebtn').click(function() {
      if ($('#exampleList').val() == null) {
          showModalAlert('Example not selected', 'An example must be selected');
      }
      else {
        runningXQueryExample();
      }
    });
 
     $('#runXQueryShellbtn').click(function() {
      alert "Hey";
      if ($('#query').val() == '') {
          showModalAlert('XQuery code is missing', 'XQuery code must me typed');
      }
      else {
        runningXQueryShell();
      }
    });


      function databaseListing(){

       var url = 'http://basex.cloudapp.net:8984/rest/appSetup/appSetup.xml';

       $.ajax({
        url: 'elementsFromAPI.php',
        type: 'GET',
        data: {url:url},
        dataType: 'text',
        success: refresh
      })
       function refresh(data){

        var returnedXML = data; 

        var xmlParsed = $.parseXML( returnedXML );
        var xmlDoc = $( xmlParsed );
        var database = xmlDoc.find('database');
        var selection = $('#database');

        selection.empty();

        database.each(function(){
         var elem = $(this);
         var databaseName = elem.find('name').text();	        
         $('#database').append(
          $('<option />')
          .text(databaseName)
          .val(databaseName)
          );      	
       }
       )
      } 
    }

    function exampleListQuery(option){

     var url = 'http://basex.cloudapp.net:8984/rest/appSetup/appSetup.xml';

     $.ajax({
      url: 'elementsFromAPI.php',
      type: 'GET',
      data: {url:url},
      dataType: 'text',
      success: refresh
    })
     function refresh(data){

       var returnedXML = data; 
       var xmlParsed = $.parseXML( returnedXML );
       var xmlDoc = $( xmlParsed );

       var queryFilter = '';

       switch (option) {
        case 'spatial':
          queryFilter = 'spatialExample';
          break;
        case 'keyword':
          queryFilter = 'keywordExample';
          break;
        case 'aggregation':
          queryFilter = 'aggregationExample';
          break;
       }

       var exampleList = xmlDoc.find(queryFilter);
       var selection = $('#exampleList');

       selection.empty();

       exampleList.each(function(){

         var elem = $(this);
         var idQuery = elem.find('id').text();
         var descriptionQuery = elem.find('description').text();	        
         selection.append(
          $('<option />')
          .text(descriptionQuery)
          .val(idQuery)
          );      	
       }
       ) 
     } 
   }

  function runningXQueryExample(){

    var example = $('#exampleList').val();

    var url = 'http://basex.cloudapp.net:8984/rest?run=' + example;
    $('#loader').modal('toggle');

    runQuery(url);
    }
  
  function runningXQueryShell(){
    alert "Hola";

    var text = $('#query').val();  

    // Retrieve OSM data

    var url = 'http://basex.cloudapp.net:8984/rest?run=creatingDatabase.xq&bbox1=' + southWest.lng + '&bbox2=' + southWest.lat + '&bbox3=' + northEast.lng + '&bbox4=' + northEast.lat; 

    $('#loader').modal('toggle');

    // Cambiar para que sea síncrono
    createDatabase(url); 

    var url = 'http://basex.cloudapp.net:8984/rest?run=runningXQueryEval.xq&textArea=' + encodeURIComponent($text); 

    runQuery(url); 

  }

function runningNewXQueryExample(){

    var example = 'let   $street  :=  xosm_rtj:getElementByName(., "Calle  Calzada  de  Castro"),
      $layer:=  xosm_rtj:getLayerByName(.,"Calle  Calzada  de  Castro", 0.001)
return
fn:filter(fn:filter($layer ,xosm_sp:furtherNorthWays($street ,?)),
          xosm_kw:searchKeyword(?,"highway"))'

    var url = 'http://basex.cloudapp.net:8984/rest?run=' + example;
    $('#loader').modal('toggle');

    runQuery(url);
    }

  function createDatabase(url) {
    $.ajax({
      url: 'elementsFromAPI.php',
      type: 'GET',
      data: {url:url},
      dataType: 'text',
      async: false
    })}

  function runQuery(url) {
    $.ajax({
      url: 'elementsFromAPI.php',
      type: 'GET',
      data: {url:url},
      dataType: 'text',
      success: refresh
    }
    )
    function refresh(data){
      $('#loader').modal('hide');
      $('#osmData').text(data);
      if (data.indexOf("<") > -1) {
        $('#showOSMbtn').show();
        drawMap(data);        
      }
      else {
        $('#showOSM').modal('show');
      }
    }
  }
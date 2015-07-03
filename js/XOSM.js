
var controls = [];

var map = L.map('map').setView([36.8395487, -2.45245], 16);

L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
  '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
  'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  id: 'examples.map-i875mjb7'
}).addTo(map); 


function drawMap(data) {
    for (z = 0; z < controls.length; z++) {
      map.removeLayer(controls[z]);
    }

    controls = [];

    $('#map').show();

        L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
          maxZoom: 18,
          attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
          id: 'examples.map-i875mjb7'
        }).addTo(map);

        var pointList = [];

        // Obtener la primera latitud y longitud que aparece para tomarla como centro del mapa
        var firstNode = $(data).find("node").first();
        var firstLat = firstNode.attr("lat");
        var firstLon = firstNode.attr("lon");

        map.panTo([firstLat, firstLon]);

        $(data).find("way").each(function(){
          pointList = [];

          $(this).find("nd").each(function(){

            var ref = $(this).attr('ref');
            var elementToFind = 'node[id=' + ref + ']';

            var lat = $(data).find(elementToFind).attr('lat');
            var lon = $(data).find(elementToFind).attr('lon');

            var point = new L.LatLng(lat, lon);
            pointList.push(point);
          })

          var firstpolyline = new L.polygon(pointList, {
            color: "blue",
            opacity: 0.5
          });

          firstpolyline.addTo(map);

          controls.push(firstpolyline);
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
          showModalAlert('Spatial Index not selected', 'A Spatial Index must be selected');
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
      $('#showOSMbtn').show();
      drawMap(data);
      }
    }
  
  function runningXQueryShell(){

    var text = $('#query').val();  
    var databaseName = $('#database').val();

    var url = 'http://basex.cloudapp.net:8984/rest?run=runningXQueryEval.xq&databaseName=' + databaseName + '&textArea=' + encodeURIComponent(text);
    $('#loader').modal('toggle');

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
      $('#showOSMbtn').show();
      drawMap(data);
    } 
  }
<?php
  include('header.php');
?>

<script language="JavaScript" type="text/javascript">
  $('document').ready (
    function (){
    $('#homebtn').addClass("active");
  });
</script>

<div class="jumbotron app-jumbotron">
  <h1>XOSM</h1>
  <p>Spatial Queries on OpenStreetMap using XQuery</p>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-12" role="main">
          <h2 class="page-header">The Aim of the Project</h2>
          <p>
            Volunteered geographic information (VGI) makes available a very large resource of geographic data. The exploitation of data coming from such resources requires an additional effort in the form of tools and effective processing techniques. One of the most stablished VGI is Open Street Map (OSM) offering data of urban and rural maps from the earth.
In this paper we present a tool, called XOSM, for the processing of geospatial queries on OSM.
The tool is equipped with a rich query language based on a set of operators
defined for OSM which have been implemented as a library of the XML query language XQuery.  
The library provides a rich repertoire of spatial, keyword and aggregation based functions, which act on the XML representation of an OSM layer. The use of the higher order facilities of XQuery makes possible the definition of complex geospatial queries
involving spatial relations, keyword searching and aggregation functions. XOSM indexes OSM data enabling efficient retrieval of answers.</p>
      </div>
    </div>
  </div>


    <footer class="app-footer" role="contentinfo">
        <h2>Project Team</h2>        
        Jesús Manuel Almendros-Jimenez <a href="mailto:jalmen@ual.es">jalmen@ual.es</a><br/>
        Antonio Becerra-Terón <a href="mailto:abecerra@ual.es">abecerra@ual.es</a><br/>
        Manuel Torres <a href="mailto:mtorres@ual.es">mtorres@ual.es</a><br/>
        Departamento de Informatica (<a href="http://www.ual.es">University of Almería)</a><br/>
        04120 Almería (Spain)
    </footer>

<?php
  include('footer.php');
?>
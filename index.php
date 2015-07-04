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
            The aim of this project is to develop a library for querying OSM maps with XQuery. 
            With this aim, we will define a XQuery library that enables to query XML data from OSM. 
            This library is based on the well-known spatial operators defined by Clementini, 
            providing a set of XQuery functions that encapsulates the search on the XML 
            document representing a layer of OSM, and makes easy the definition of queries on top of OSM layers. 
            In essence, the library provides a repertory of Urban Operators for points and lines which, 
            in combination with Higher Order facilities of XQuery, makes easy the composition of queries 
            and the definition of keyword based search geo-localized queries. OSM data are 
            indexed by an R-tree structure, in which points and lines are enclosed by Minimum 
            Bounding Rectangles (MBRs), in order to get shorter answer time.</p>
      </div>
    </div>
  </div>


    <footer class="app-footer" role="contentinfo">
        <h2>Project Team</h2>        
        Jesús Manuel Almendros-Jimenez <a href="mailto:jalmen@ual.es">jalmen@ual.es</a><br/>
        Antonio Becerra-Terón <a href="mailto:abecerra@ual.es">abecerra@ual.es</a><br/>
        Manuel Torres <a href="mailto:mtorres@ual.es">mtorres@ual.es</a><br/>
        Departamento de Informatica (<a href="www.ual.es">University of Almería)</a><br/>
        04120 Almería (Spain)
    </footer>

<?php
  include('footer.php');
?>
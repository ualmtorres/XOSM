<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XOSM</title>
    <!-- CSS -->
    <link href="bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="app.css" rel="stylesheet">
  </head>
  <body>
    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//www.fuelcdn.com/fuelux/3.6.3/js/fuelux.min.js"></script>
    <!-- Leaflet -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
    <script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>


<script type="text/javascript">
  jQuery(function($) {
  $("#contactUsLink").click(function(e) {
      e.preventDefault();       
      $('#contactUs').modal('show');
  });
});
</script>

<?php
include('commonModals.php');
?>

<nav class="navbar navbar-default app-navbar"> 
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">XOSM</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li id = 'homebtn'><a href="index.php">Home</a></li>
<!--
        <li id = "indexingbtn"><a href="indexing.php">Index a region</a></li>
        <li id = "spatialbtn"><a href="spatialQuerying.php">Spatial Query</a></li>
        <li id = "keywordbtn"><a href="keywordQuerying.php">Keyword Query</a></li>            
        <li id = "aggregationbtn"><a href="aggregationQuerying.php">Aggregation Query</a></li>     
-->
        <li id = "querybtn"><a href="query.php">Query</a></li>     
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" id="contactUsLink">Contact us</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

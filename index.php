<?php

$connect = @mysqli_connect ( 'localhost', 'root', '') 
    OR die ( mysqli_connect_error() ) ;
 
 
# Set encoding to match PHP script encoding.
 
mysqli_set_charset( $connect, 'utf8' ) ;

$sql= file_get_contents('limbo.sql');
$query = "source limbo.sql";
$results = mysqli_multi_query($connect, $sql);
if ($results == 0) {
    
    echo "Error creating database: " . mysqli_error($connect);
    
} else {
    
      //nothing:)
    }


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Limbo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
<style type="text/css">
    #cover{
        align-content: center
        display: block;
        max-width:5000px;
        max-height:1100px;
        
     
}
    
</style>
</head>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Limbo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="announcements.php">Announcements</a></li>
        <li><a href="lost.php">Lost</a></li>  
        <li><a href="found.php">Found</a></li>
        <li><a href="admin.php">Admin</a></li>
        <li><a href="search.php" class="active"><span class="glyphicon glyphicon-search">   </span>       Search Database</a></li>    
      </ul>
    </div>
  </div>
</nav>
<body>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/shoes.jpg" id="cover">
      <div class="carousel-caption">
        <h1><label>Claim lost items and report found items. Use Limbo to help find and reclaim your things!</label></h3>
      </div> 
    </div>
  </div>

    <div class="container text-center">
  <h3>The Team</h3>
</div>

<div class="container" style="text-align:center">
  <div class="col-sm-4">
    <p class="text-center"><strong>Morgan Stippa</strong></p><br>
    <a href="#demo" data-toggle="collapse">
      <img src="images/morgan.jpg" class="img-circle person" alt="Random Name" style="text-align: center;">
   </a>

    <div id="demo" class="collapse" style="text-align:center">
      <p>Junior</p>
      <p>Loves long walks on the beach and turtles</p>
      <p>Marist College Rower</p>
    </div>
  </div>
  <div class="col-sm-4" style="text-align:center">
    <p class="text-center"><strong>Tadd Bindas</strong></p><br>
    <a href="#demo2" data-toggle="collapse">
      <img src="images/tadd.jpg" class="img-circle person" alt="Random Name">
    </a>
    <div id="demo2" class="collapse">
      <p>Sophomore</p>
      <p>Wants to be a coder</p>
      <p>Rower</p>
    </div>
  </div>
  <div class="col-sm-4" style="text-align:center">
    <p class="text-center"><strong>Elijah Johnson</strong></p><br>
    <a href="#demo3" data-toggle="collapse">
 <img src="images/elijah.jpg" class="img-circle person" alt="Random Name" style="text-align:center">
    </a>
    <div id="demo3" class="collapse" style="text-align:center">
      <p>Junior</p>
      <p>RA</p>
      <p>Software Guy</p>
    </div>
  </div>
</div>
    
<div class="container" style="text-align:center">
  <h3 class="text-center">Contact</h3>
  <p class="text-center"><em>Send us anything!</em></p>
 
      <p>Do you use this page? Drop us a note!</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>We are located at Marist College in the beautiful hudson valley</p>
      <p><span class="glyphicon glyphicon-phone"></span>Phone: 282-201-2012</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: taddbindas@gmail.com</p> 
    </div>
    
<style>
#googleMap {
    width: 100%; /* Span the entire width of the screen */
    height: 400px; /* Set the height to 400 pixels */
}
</style>
    
<div id="googleMap"></div>

<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(41.7225, -73.9341);

function initialize() {
var mapProp = {
center:myCenter,
zoom:12,
scrollwheel:false,
draggable:false,
mapTypeId:google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
position:myCenter,
});

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>
    
    <footer class="text-center">
<br><br>
  <p>Bootstrap Theme Made By <a data-toggle="tooltip" title="Visit w3schools">www.w3schools.com</a></p> 
        <p> Bootstrap Theme implemented through Tadd, Eli, and Morgan</p>
</footer>

<script>
$(document).ready(function(){
    // Initialize Tooltip
    $('[data-toggle="tooltip"]').tooltip(); 
})
</script>
</html>



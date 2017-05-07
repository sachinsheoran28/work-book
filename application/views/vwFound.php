<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> Found</title>
    <!-- Bootstrap core CSS -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
      
    <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
      <script>
         var winHeight = 0; /* Window height */
        var winWidth = 0;  /* Window width */


 $(document).ready(function() {


setContainerDims();


function setContainerDims(){
    winHeight = parseInt($(window).height());
    winWidth = parseInt($(window).width());

    $(".row").css({"width":winWidth,"height":winHeight});
}



$(window).resize(function(){
    setContainerDims();
})

});
      </script>
<style>
  body, html{
    margin: 0;
    height: 100%;
    width: 100%;
    font-size: 20px;
      position: relative;
 }
  a#map_link {
      position: absolute;
      top:10px;
      right:10px;
      font-size: 10px;
      line-height:30px;
      width:30px;
      height: 30px;
      border:1px solid #ddd;
      border-radius: 50%;
      background:#ffffff;
      verticle-align: middle;
      text-align: center;
  }
</style>
</head>
<body>
      <div id="page-wrapper">
        <script>
      var map;
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo $lat;?>, lng:<?php echo $long;?>},
          zoom: 17
        });
          var marker = new google.maps.Marker({
          position: {lat: <?php echo $lat;?>, lng:<?php echo $long;?>},
          map: map,
          title: 'Got you!'
        });
      }
    </script>
          
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeZOAOxt9hXg-eMOe7W0aWely2x9fK698&callback=initMap"
  type="text/javascript"></script>
       
    <div id="capture"></div>
          <div class="row" style="">
              
<div id="map" style="width:100%; height: 100%;"></div>  
              <a href="http://maps.google.com/maps?daddr=<?php echo $lat;?>,<?php echo $long;?>&amp" id="map_link">Map</a>
          </div>
</div>
    </body>
</html>
<?php
$this->load->view('vwHeaderC');
?>
<!--  
-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Results <small>Video</small></h1>
            <ol class="breadcrumb">
              <li><a href="Results"><i class="icon-dashboard"></i> Video</a></li>
              <li class="active"><i class="icon-file-alt"></i> Video List</li>
              
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div>
          <?php if($list->vid_longitude != '') { ?>
        <script>
      var map;
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo $list->vid_latitude; ?>, lng:<?php echo $list->vid_longitude; ?>},
          zoom: 17
        });
          var marker = new google.maps.Marker({
          position: {lat: <?php echo $list->vid_latitude; ?>, lng:<?php echo $list->vid_longitude; ?>},
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
          
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeZOAOxt9hXg-eMOe7W0aWely2x9fK698&callback=initMap"
  type="text/javascript"></script>
          <?php } ?>
          <!-- /.row -->
<?php /*
$ip = $this->input->ip_address();
echo '<br/>'.$ip .'-'.$_SERVER['REMOTE_ADDR'];
?>
          <p id="demo">Click the button to get your coordinates:</p>
<button onclick="getLocation()">Try It</button>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
function showPosition(position)
  {
  x.innerHTML="Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;    
  }
    
   
</script>
          <script>
      var map;
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 28.622538841868497, lng: 77.04983133543779},
          zoom: 17
        });
          var marker = new google.maps.Marker({
          position: {lat: 28.622538841868497, lng: 77.04983133543779},
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
          <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDeZOAOxt9hXg-eMOe7W0aWely2x9fK698&callback=initMap"
  type="text/javascript"></script>
<div id="map" style="height:400px;width:600px;"></div>
     */ ?>     
    <div id="capture"></div>
        
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="header">Video ID <i class="fa fa-sort"></i></th>
                    <th class="header">Assessor name <i class="fa fa-sort"></i></th>
                    <th class="header">Time Captured<i class="fa fa-sort"></i></th>
                      
                  </tr>
                </thead>
                <tbody>
                    
                    <?php 
                        echo '<tr>';
                        echo '<td>'.$list->vid.'</td>';
                        echo '<td>'.$list->first_name.' '.$list->last_name.'</td>';
                        echo '<td>'.date("d-m-Y g:i:s a", $list->vid_date).' (dd-mm-yyyy HH:MM:SS)</td>';
                        echo '</tr>';
                       
                     ?>
                </tbody>
              </table>
            </div>
          <div class="row">
              <div class="col-sm-6">
               <video width="400" controls>
                         <source src="https://mcd.glocalthinkers.in/uploads/video/<?php echo $list-> vid_url; ?>" type="video/webm">
            </video>
              </div>
              <div class="col-sm-6"><div id="map" style="height:400px;width:100%;"></div> </div>
          </div>
           
          </div>
        
 
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('vwFooter');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
      }
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
      #directions-panel {
        margin-top: 10px;
        background-color: #FFEE77;
        padding: 10px;
      }
    </style>
  </head>
  <body>
      <?php

      $servername = "localhost";
          $username = "kochiat";
          $password = "jStfpV8AsKJr5mw3";
          $dbname = "kochiat";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT sender,  value, lat ,lon FROM kochiat";
    $result = $conn->query($sql);

    $lat = array("10.044331");
    $lon = array("76.324484");

    if ($result->num_rows > 0)
     {
        // output data of each row
       $i=0;
        while($row = $result->fetch_assoc())
        {
           // echo  $row["sender"].  " : " . $row["value"]. " " .$row["lat"] . " " . $row["lon"] . "<br>";
            $lat[$i]=(float)$row["lat"];
            $lon[$i]=(float)$row["lon"];
            $i=$i+1;
        }
     }
     else 
     {
        echo "<script>alert('0 results')</script>";
     }
    $conn->close();

    ?>
    <div id="map"></div>
    <div id="right-panel">
    <div>
    <b>Start:</b>

    <div id="directions-panel"></div>
    </div>
    <br>

    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 10.04, lng: 76.65}
        });
        directionsDisplay.setMap(map);

        
        calculateAndDisplayRoute(directionsService, directionsDisplay); 
        
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
       

        var i=<?php echo $i; ?>;
        var len=i-1;
        var lat=<?php echo json_encode($lat); ?>;
        var lon=<?php echo json_encode($lon); ?>;
       // alert(lat[0]);
        // alert(typeof(lat[0]));
        for(var j=0;j<len;j++)
        {
          lat[j]=Number(lat[j]);
          lon[j]=Number(lon[j]);
        }
        i=0;

        while(i<=len)
          {
            waypts.push({ 
              location:new google.maps.LatLng(lat[i],lon[i]), 
              stopover: true});
            i=i+1;
          } 

        directionsService.route({
          origin: '10.046831, 76.328074',
          destination: '10.046831, 76.328074',
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_HCthiLRKIcpu33JAbk9QbF6g4psUEuE&callback=initMap">
    </script>
  </body>
</html>
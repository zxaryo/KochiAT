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
$lat=array("");
$lon=array("");
$i=1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["sender"].  " : " . $row["value"]. " " .$row["lat"] . ", " . $row["lon"] . "<br>";

            $lat[$i]=.$row["lat"].;
            $lon[$i]=.$row["lon"].;
            $i=$i+1;
            echo $lat[$i];
            echo $lon[$i];
    }
} else {
    echo "0 results";
}
$conn->close();

?>
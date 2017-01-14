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

$sql = "SELECT sender,  value, lat ,lon FROM zxdot";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["sender"].  " : " . $row["value"]. " " .$row["lat"] . " " . $row["lon"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
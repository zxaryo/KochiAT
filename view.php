<?php

$servername = "localhost";
$username = "adminvj197IY";
$password = "unZ7s7rQx4YqL";
$dbname = "kochiat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT sender, timesamp, value FROM zxdot ORDER BY timesamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["timesamp"]. "| " .$row["sender"].  " : " . $row["value"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
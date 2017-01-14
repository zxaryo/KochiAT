<?php

 	  $servername = "localhost";
      $username = "kochiat";
      $password = "jStfpV8AsKJr5mw3";
      $dbname = "kochiat";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$valu = $_GET['value'];
$sende = $_GET['sender'];

$sql = "UPDATE kochiat SET value=$valu WHERE sender= '$sende' ";

//echo $sql;
echo "<script>alert($sql)</script>";
if (mysqli_query($conn,$sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
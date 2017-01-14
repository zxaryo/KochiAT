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

$sql = "UPDATE kochiat SET value=".$_GET['value']." WHERE sender= ' ".$_GET['sender']." '' ";

//echo $sql;
echo "<scipt>alert($sql)</script>";
if (mysqli_query($conn,$sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
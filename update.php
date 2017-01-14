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

$sql = "UPDATE kochiAT SET value=".$_GET['value']." WHERE sender=' ".$_GET['sender']." ' ";

//echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<?php 

define(USER,'cimer');
define(PASS,'cimeri');
define(DB,'Budzet');
define(HOST,'localhost');

$conn = new mysqli(HOST,USER,PASS,DB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

?>
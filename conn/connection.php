<?php
$servername = "localhost";
$username = "gisa";
$password = "222008906";
$dbname = "event_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

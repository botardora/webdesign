<?php
$servername = "localhost";
$dbname = "konferencia";
$conn = new mysqli($servername, $dbname);
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    
}

?>
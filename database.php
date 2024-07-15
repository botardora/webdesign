<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "konferenciaphp";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Nem sikerult csatlakozni az adatbazishoz!");
}
                

     ?>             
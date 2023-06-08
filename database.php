<?php
$servername = "localhost";
$username = "david";
$password = "FScomunica2";
$database = "ToDoApp";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>

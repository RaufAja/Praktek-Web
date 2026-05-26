<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "2526_16db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
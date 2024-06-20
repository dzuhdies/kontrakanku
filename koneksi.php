<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "kontrakanku"; 

$koneksi = mysqli_connect($host, $username, $password, $database);

if ($koneksi) {
    echo "";
} else {
    echo "Koneksi database gagal!";
}
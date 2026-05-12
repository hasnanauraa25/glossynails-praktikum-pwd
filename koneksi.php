<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "glossynails";

$konek = new mysqli(
    $hostname,
    $username,
    $password,
    $database
);

if($konek->connect_error){
    die("Koneksi gagal: " . $konek->connect_error);
}

?>
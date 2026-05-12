<?php
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($konek, "DELETE FROM booking WHERE id='$id'");

header("Location: data_booking.php");
exit;
?>
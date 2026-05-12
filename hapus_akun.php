<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

mysqli_query(

    $konek,

    "DELETE FROM booking
    WHERE nama='$user'"

);

mysqli_query(

    $konek,

    "DELETE FROM user
    WHERE username='$user'"

);

session_destroy();
echo "
<script>
    alert('Akun berhasil dihapus');
    window.location.href='login.php';
</script>
";

?>
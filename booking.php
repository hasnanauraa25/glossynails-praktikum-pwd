<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$booking_update = null;

if(isset($_GET['update'])){

    $id = $_GET['update'];
    $ambil = mysqli_query(
        $konek,
        "SELECT * FROM booking WHERE id='$id'"
    );
    $booking_update = mysqli_fetch_assoc($ambil);
}

$layanan = [
    "Manicure",
    "Pedicure",
    "Nail Extension",
    "Gel Polish",
    "Nail Removal"
];
$harga_layanan = [
    "Manicure" => 50000,
    "Pedicure" => 60000,
    "Nail Extension" => 120000,
    "Gel Polish" => 80000,
    "Nail Removal" => 30000
];
$nail_art = [
    "Korean Style",
    "Glitter Nails",
    "Floral Design",
    "Marble Nails",
    "Luxury Nails",
    "Cute Nails"
];

$error = "";
$sukses = "";

if(isset($_POST['booking'])){

    $nama = $_SESSION['user'];
    $layanan_pilih = isset($_POST['layanan'])
        ? implode(", ", $_POST['layanan'])
        : "";

    $nail = $_POST['nail'];

    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    $total_harga = 0;

    if(isset($_POST['layanan'])){
        foreach($_POST['layanan'] as $item){
            if(isset($harga_layanan[$item])){
                $total_harga += $harga_layanan[$item];
            }
        }
    }

    if(
        $layanan_pilih == "" ||
        $tanggal == "" ||
        $jam == ""
    ){
        $error = "Data masih ada yang kosong ❌";
    } else {

        mysqli_query(

            $konek,

            "INSERT INTO booking(
                nama,
                layanan,
                nail,
                tanggal,
                jam,
                total_harga
            )

            VALUES(
                '$nama',
                '$layanan_pilih',
                '$nail',
                '$tanggal',
                '$jam',
                '$total_harga'
            )"

        );
        $sukses = "Booking berhasil 💖";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking GlossyNails</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap"
        rel="stylesheet"
    >

    <style>
        body{
            background-color: #fff5f7;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar{
            background-color: white;
        }
        .card{
            border: none;
            border-radius: 20px;
        }
        .judul{
            color: #ff4f81;
        }
        .btn-pink{
            background-color: #ff4f81;
            color: white;
            border: none;
        }
        .btn-pink:hover{
            background-color: #ff2f6d;
            color: white;
        }
        .layanan-box{
            background-color: #fff0f5;
            padding: 15px;
            border-radius: 15px;
        }
        .footer{
            background-color: white;
            padding: 40px 0;
            border-top: 3px solid #ff4f81;
            color: #666;
            margin-top: auto;
        }
        .footer h5{
            color: #ff4f81;
        }
        .footer p{
            font-size: 14px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger" href="index.php">
            💅 GlossyNails
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active fw-bold text-danger" href="data_booking.php">
                        Riwayat Booking
                    </a>
                </li>

                <li class="nav-item">
                    <span class="nav-link">
                        Halo, <?= $_SESSION['user']; ?> 
                    </span>
                </li>

                <li class="nav-item">
                    <a class="btn btn-danger ms-2" href="logout.php">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <div class="col-md-7 mx-auto">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4 judul">
                Booking Nail Art 💅
            </h2>

            <form method="POST">
                <label class="fw-bold">
                    Nama Customer
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control mb-3"
                    value="<?= $_SESSION['user']; ?>"
                    readonly
                >

                <label class="fw-bold mb-2">
                    Pilih Layanan
                </label>

                <div class="layanan-box mb-3">
                    <?php
                    foreach($layanan as $item){
                    ?>

                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="layanan[]"
                                value="<?= $item; ?>"
                            >

                            <label class="form-check-label">
                                <?= $item; ?> - Rp <?= number_format($harga_layanan[$item], 0, ',', '.'); ?>
                            </label>
                        </div>

                    <?php } ?>
                </div>

                <label class="fw-bold mb-2">
                    Jenis Nail Art (Opsional)
                </label>

                <div class="layanan-box mb-3">
                    <div class="form-check mb-2">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="nail"
                            value="Tidak Pakai Nail Art"
                            checked
                        >
                        <label class="form-check-label">
                            Tidak Pakai Nail Art
                        </label>
                    </div>

                    <?php
                    foreach($nail_art as $nail_list){
                    ?>

                        <div class="form-check mb-2">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="nail"
                                value="<?= $nail_list; ?>"
                            >

                            <label class="form-check-label">
                                <?= $nail_list; ?> - Rp 100.000
                            </label>
                        </div>

                    <?php } ?>
                </div>

                <label class="fw-bold">
                    Tanggal Booking
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control mb-3"
                    required
                >

                <label class="fw-bold">
                    Jam Booking
                </label>

                <input
                    type="time"
                    name="jam"
                    class="form-control mb-4"
                    required
                >

                <button
                    type="submit"
                    name="booking"
                    class="btn btn-pink w-100"
                >
                    Booking Sekarang
                </button>
            </form>

            <?php if($error != "") { ?>
                <div class="alert alert-danger mt-4">
                    <?= $error; ?>
                </div>

            <?php } ?>

            <?php if($sukses != "") { ?>
                <?php
                $id_booking = mysqli_insert_id($konek);
                ?>

                <div class="alert alert-success mt-4">
                    <h5 class="fw-bold">
                        <?= $sukses; ?>
                    </h5>

                    <hr>

                    <p>
                        <b>Nama Customer :</b>
                        <?= $nama; ?>
                    </p>

                    <p>
                        <b>Layanan :</b>
                        <?= $layanan_pilih; ?>
                    </p>

                    <p>
                        <b>Jenis Nail Art :</b>
                        <?= $nail; ?>
                    </p>

                    <p>
                        <b>Tanggal Booking :</b>
                        <?= $tanggal; ?>
                    </p>

                    <p>
                        <b>Jam Booking :</b>
                        <?= $jam; ?>
                    </p>

                    <p>
                        <b>Total Harga :</b>
                        Rp <?= number_format($total_harga); ?>
                    </p>

                    <div class="mt-3">
                        <a href="edit_booking.php?id=<?= $id_booking; ?>" class="btn btn-warning">
                            Edit Booking
                        </a>

                        <a href="index.php" class="btn btn-pink ms-2">
                            Kembali ke Home
                        </a>
                    </div>
                </div>

            <?php } ?>

            <?php if($booking_update != null) { ?>
                <div class="alert alert-success mt-4">
                    <h5 class="fw-bold">
                        Booking berhasil diupdate 💖
                    </h5>

                    <hr>

                    <p>
                        <b>Nama Customer :</b>
                        <?= $booking_update['nama']; ?>
                    </p>

                    <p>
                        <b>Layanan :</b>
                        <?= $booking_update['layanan']; ?>
                    </p>

                    <p>
                        <b>Jenis Nail Art :</b>
                        <?= $booking_update['nail']; ?>
                    </p>

                    <p>
                        <b>Tanggal Booking :</b>
                        <?= $booking_update['tanggal']; ?>
                    </p>

                    <p>
                        <b>Jam Booking :</b>
                        <?= $booking_update['jam']; ?>
                    </p>

                    <p>
                        <b>Total Harga :</b>
                        Rp <?= number_format($booking_update['total_harga'], 0, ',', '.'); ?>
                    </p>

                    <div class="mt-3">
                        <a href="edit.php?id=<?= $booking_update['id']; ?>" class="btn btn-warning">
                            Edit Lagi
                        </a>

                        <a href="index.php" class="btn btn-pink ms-2">
                            Kembali ke Home
                        </a>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container text-center">
        <h5 class="fw-bold mb-2">
            💅 GlossyNails Studio
        </h5>

        <p class="mb-2">
            Make your nails beautiful and elegant ✨
        </p>

        <small>
            &copy; 2026 GlossyNails Studio | All Rights Reserved
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
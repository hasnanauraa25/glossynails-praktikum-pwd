<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

/* =========================
   CEK POPUP SETELAH EDIT
========================= */

$booking_update = null;

if(isset($_GET['update'])){

    $id = $_GET['update'];

    $ambil = mysqli_query($konek,
        "SELECT * FROM booking WHERE id='$id'"
    );

    $booking_update = mysqli_fetch_assoc($ambil);
}

/* =========================
   DATA LAYANAN
========================= */

$layanan = [

    "Manicure",
    "Pedicure",
    "Nail Extension",
    "Gel Polish",
    "Nail Art Design",
    "Nail Removal"

];

/* =========================
   DATA NAIL ART
========================= */

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

    $nama = $_POST['nama'];

    // CHECKBOX
    $layanan_pilih = isset($_POST['layanan'])
        ? implode(", ", $_POST['layanan'])
        : "";

    $nail = $_POST['nail'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    if(
        $nama == "" ||
        $layanan_pilih == "" ||
        $tanggal == "" ||
        $jam == ""
    ){

        $error = "Data masih ada yang kosong ❌";

    } else {

        mysqli_query($konek,

            "INSERT INTO booking(
                nama,
                layanan,
                nail,
                tanggal,
                jam
            )

            VALUES(
                '$nama',
                '$layanan_pilih',
                '$nail',
                '$tanggal',
                '$jam'
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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>

        body{
            background-color: #fff5f7;
            font-family: 'Poppins', sans-serif;
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

    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold text-danger" href="index.php">
            💅 GlossyNails
        </a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

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
                    <a class="nav-link active fw-bold text-danger" href="booking.php">
                        Booking
                    </a>
                </li>

                <li class="nav-item">
                    <span class="nav-link">
                        Halo, <?= $_SESSION['user']; ?> 💖
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

<!-- FORM BOOKING -->
<div class="container mt-5 mb-5">

    <div class="col-md-7 mx-auto">

        <div class="card shadow p-4">

            <h2 class="text-center mb-4 judul">
                Booking Nail Art 💅
            </h2>

            <form method="POST">

                <!-- NAMA -->
                <label class="fw-bold">
                    Nama Customer
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control mb-3"
                    placeholder="Masukkan nama"
                    required
                >

                <!-- CHECKBOX LAYANAN -->
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
                                <?= $item; ?>
                            </label>

                        </div>

                    <?php } ?>

                </div>

                <!-- NAIL ART -->
                <label class="fw-bold">
                    Jenis Nail Art
                </label>

                <select
                    name="nail"
                    class="form-control mb-3"
                >

                    <?php
                    foreach($nail_art as $nail_list){
                    ?>

                        <option>
                            <?= $nail_list; ?>
                        </option>

                    <?php } ?>

                </select>

                <!-- TANGGAL -->
                <label class="fw-bold">
                    Tanggal Booking
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control mb-3"
                    required
                >

                <!-- JAM -->
                <label class="fw-bold">
                    Jam Booking
                </label>

                <input
                    type="time"
                    name="jam"
                    class="form-control mb-4"
                    required
                >

                <!-- BUTTON -->
                <button
                    type="submit"
                    name="booking"
                    class="btn btn-pink w-100"
                >
                    Booking Sekarang
                </button>

            </form>

            <!-- ERROR -->
            <?php if($error != "") { ?>

                <div class="alert alert-danger mt-4">

                    <?= $error; ?>

                </div>

            <?php } ?>

            <!-- SUKSES BOOKING BARU -->
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

                    <div class="mt-3">

                        <a
                            href="edit.php?id=<?= $id_booking; ?>"
                            class="btn btn-warning"
                        >
                            Edit Booking
                        </a>

                        <a
                            href="hapus.php?id=<?= $id_booking; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin mau hapus booking ini?')"
                        >
                            Hapus Booking
                        </a>

                    </div>

                </div>

            <?php } ?>

            <!-- POPUP SETELAH EDIT -->
            <?php if($booking_update != null) { ?>

                <div class="alert alert-success mt-4">

                    <h5 class="fw-bold">
                         Booking berhasil 💖
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

                    <div class="mt-3">

                        <a
                            href="edit.php?id=<?= $booking_update['id']; ?>"
                            class="btn btn-warning"
                        >
                            Edit Lagi
                        </a>

                        <a
                            href="hapus.php?id=<?= $booking_update['id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin mau hapus booking ini?')"
                        >
                            Hapus Booking
                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

<!-- FOOTER -->
<footer class="bg-danger text-white text-center p-3">

    &copy; 2026 GlossyNails Studio | All Rights Reserved

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
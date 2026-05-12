<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($konek,
    "SELECT * FROM booking WHERE id='$id'"
);

$row = mysqli_fetch_assoc($data);

/* DATA LAYANAN */
$layanan = [

    "Manicure",
    "Pedicure",
    "Nail Extension",
    "Gel Polish",
    "Nail Art Design",
    "Nail Removal"

];

/* DATA NAIL ART */
$nail_art = [

    "Korean Style",
    "Glitter Nails",
    "Floral Design",
    "Marble Nails",
    "Luxury Nails",
    "Cute Nails"

];

/* UBAH STRING JADI ARRAY */
$layanan_terpilih = explode(", ", $row['layanan']);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];

    // CHECKBOX
    $layanan_pilih = isset($_POST['layanan'])
        ? implode(", ", $_POST['layanan'])
        : "";

    $nail = $_POST['nail'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    mysqli_query($konek,

        "UPDATE booking SET

        nama='$nama',
        layanan='$layanan_pilih',
        nail='$nail',
        tanggal='$tanggal',
        jam='$jam'

        WHERE id='$id'"

    );

    // BALIK KE BOOKING + TAMPILKAN DATA UPDATE
    header("Location: booking.php?update=$id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>

        body{
            background-color: #fff5f7;
            font-family: 'Poppins', sans-serif;
        }

        .card{
            border: none;
            border-radius: 20px;
        }

        .judul{
            color: #ff4f81;
        }

        .btn-warning{
            border-radius: 10px;
            font-weight: bold;
        }

        .layanan-box{
            background-color: #fff0f5;
            padding: 15px;
            border-radius: 15px;
        }

    </style>

</head>

<body>

<div class="container mt-5 mb-5">

    <div class="col-md-7 mx-auto">

        <div class="card shadow p-4">

            <h2 class="text-center mb-4 judul">
                Edit Booking 💅
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
                    value="<?= $row['nama']; ?>"
                    required
                >

                <!-- LAYANAN -->
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

                                <?= in_array($item, $layanan_terpilih)
                                    ? 'checked'
                                    : ''
                                ?>
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

                    <?php foreach($nail_art as $n){ ?>

                        <option
                            value="<?= $n ?>"
                            <?= $row['nail'] == $n ? 'selected' : '' ?>
                        >
                            <?= $n ?>
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
                    value="<?= $row['tanggal']; ?>"
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
                    value="<?= $row['jam']; ?>"
                    required
                >

                <!-- BUTTON -->
                <button
                    type="submit"
                    name="update"
                    class="btn btn-warning w-100"
                >
                    Update Booking
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
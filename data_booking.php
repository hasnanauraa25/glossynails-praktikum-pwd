<?php

session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit;

}

include 'koneksi.php';

$query = mysqli_query($konek, "SELECT * FROM booking");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking GlossyNails</title>

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

        .judul{
            color: #ff4f81;
        }

        .table{
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
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

        .card-table{
            background-color: white;
            border-radius: 20px;
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
                    <a class="nav-link" href="booking.php">
                        Booking
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active fw-bold text-danger" href="data_booking.php">
                        Data Booking
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

<!-- DATA BOOKING -->
<div class="container mt-5 mb-5">

    <div class="card-table shadow p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="judul fw-bold">
                Data Booking 💅
            </h2>

            <a href="booking.php" class="btn btn-pink">
                + Tambah Booking
            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-danger text-center">

                    <tr>

                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Layanan</th>
                        <th>Nail Art</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $no = 1;

                    while($data = mysqli_fetch_array($query)){

                    ?>

                    <tr>

                        <td class="text-center">
                            <?= $no++; ?>
                        </td>

                        <td>
                            <?= $data['nama']; ?>
                        </td>

                        <td>
                            <?= $data['layanan']; ?>
                        </td>

                        <td>
                            <?= $data['nail']; ?>
                        </td>

                        <td>
                            <?= $data['tanggal']; ?>
                        </td>

                        <td>
                            <?= $data['jam']; ?>
                        </td>

                        <td class="text-center">

                            <a
                                href="edit.php?id=<?= $data['id']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                Edit
                            </a>

                            <a
                                href="hapus.php?id=<?= $data['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin mau hapus booking ini?')"
                            >
                                Hapus
                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

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
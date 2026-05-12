<?php
session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit;

}

include 'koneksi.php';

$user = $_SESSION['user'];
$query = mysqli_query(

    $konek,

    "SELECT * FROM booking
    WHERE nama='$user'
    ORDER BY id DESC
    LIMIT 1"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title> Riwayat Booking GlossyNails </title>
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
        .judul{
            color: #ff4f81;
        }
        .card-table{
            background-color: white;
            border-radius: 20px;
        }
        .table{
            border-radius: 15px;
            overflow: hidden;
        }
        .kosong{
            text-align: center;
            padding: 30px;
            color: gray;
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
        <a
            class="navbar-brand fw-bold text-danger"
            href="index.php"
        >
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

        <div
            class="collapse navbar-collapse"
            id="navbarNav"
        >
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="index.php"
                    >
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link active fw-bold text-danger"
                        href="data_booking.php"
                    >
                        Riwayat Booking
                    </a>
                </li>

                <li class="nav-item">
                    <span class="nav-link">
                        Halo,
                        <?= $_SESSION['user']; ?> 
                    </span>
                </li>

                <li class="nav-item">
                    <a
                        class="btn btn-danger ms-2"
                        href="logout.php"
                    >
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <div class="card-table shadow p-4">
        <h2 class="judul fw-bold mb-4">
            Riwayat Booking Saya 💅
        </h2>

        <div class="table-responsive">
            <table
                class="table table-bordered table-hover align-middle"
            >
                <thead class="table-danger text-center">
                    <tr>
                        <th>No</th>
                        <th>Layanan</th>
                        <th>Nail Art</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Total Harga</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;

                    if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_array($query)){
                    ?>

                    <tr>
                        <td class="text-center">
                            <?= $no++; ?>
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

                        <td>
                            Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?>
                        </td>

                    </tr>

                    <?php

                        }

                    } else {
                    ?>

                    <tr>
                        <td
                            colspan="5"
                            class="kosong"
                        >
                            Belum ada booking 💅
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
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
            &copy; 2026 GlossyNails Studio
            | All Rights Reserved
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
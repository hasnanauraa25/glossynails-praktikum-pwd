<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlossyNails</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background-color: #fffafc;
        }

        /* BANNER */
        .banner{
            background:
                linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
                url('img/a.jpg') no-repeat center center;

            background-size: cover;
            height: 90vh;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
            text-align: center;
        }

        .banner h1{
            font-size: 3.5rem;
        }

        .banner p{
            font-size: 1.2rem;
        }

        /* BOX */
        .box{
            border-radius: 15px;
            transition: 0.3s;
            background: white;
            overflow: hidden;
        }

        .box:hover{
            transform: translateY(-10px);
        }

        .box img{
            height: 220px;
            width: 100%;
            object-fit: cover;
            transition: 0.3s;
        }

        .box:hover img{
            transform: scale(1.05);
        }

        /* ABOUT */
        .about-section{
            background-color: #fff0f5;
        }

        /* FOOTER */
        .footer-section{
            background: #ff9a9e;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

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

                <!-- HOME -->
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        Home
                    </a>
                </li>

                <!-- LAYANAN -->
                <li class="nav-item">
                    <a class="nav-link" href="#layanan">
                        Layanan
                    </a>
                </li>

                <!-- GALERI -->
                <li class="nav-item">
                    <a class="nav-link" href="#galeri">
                        Galeri
                    </a>
                </li>

                <?php if(isset($_SESSION['user'])) { ?>

                    <!-- DATA BOOKING -->
                    <li class="nav-item">
                        <a class="nav-link" href="data_booking.php">
                            Data Booking
                        </a>
                    </li>

                    <!-- USER -->
                    <li class="nav-item">
                        <span class="nav-link">
                            Halo, <?= $_SESSION['user']; ?> 💖
                        </span>
                    </li>

                    <!-- LOGOUT -->
                    <li class="nav-item">
                        <a class="btn btn-danger ms-2" href="logout.php">
                            Logout
                        </a>
                    </li>

                <?php } else { ?>

                    <!-- LOGIN -->
                    <li class="nav-item">
                        <a class="btn btn-outline-danger me-2" href="login.php">
                            Login
                        </a>
                    </li>

                    <!-- REGISTER -->
                    <li class="nav-item">
                        <a class="btn btn-danger" href="register.php">
                            Register
                        </a>
                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>

<!-- BANNER -->
<section class="banner">

    <div class="container">

        <?php

            $jam = date("H");

            if($jam < 12){

                echo "<h3>Selamat Pagi 💖</h3>";

            } elseif($jam < 18){

                echo "<h3>Selamat Siang 💅</h3>";

            } else {

                echo "<h3>Selamat Malam ✨</h3>";

            }

        ?>

        <h1 class="fw-bold">
            Welcome to GlossyNails 💖
        </h1>

        <p class="lead">
            Salon Nail Art modern dengan desain cantik & elegan
        </p>

        <?php if(isset($_SESSION['user'])) { ?>

            <a href="booking.php"
               class="btn btn-light btn-lg mt-3">
                Booking Sekarang
            </a>

        <?php } else { ?>

            <a href="login.php"
               class="btn btn-light btn-lg mt-3">
                Booking Sekarang
            </a>

        <?php } ?>

    </div>

</section>

<!-- LAYANAN -->
<section class="py-5" id="layanan">

    <div class="container">

        <h2 class="text-center mb-5 fw-bold">
            Layanan Kami 💅
        </h2>

        <div class="row g-4">

            <!-- MANICURE -->
            <div class="col-md-4">

                <div class="box text-center shadow-sm p-4">

                    <span class="badge bg-danger mb-2">
                        Best Seller
                    </span>

                    <h4>✨ Manicure</h4>

                    <p>
                        Perawatan kuku tangan agar lebih bersih,
                        sehat, dan cantik.
                    </p>

                    <h5 class="text-danger fw-bold">
                        Rp50.000
                    </h5>

                </div>

            </div>

            <!-- PEDICURE -->
            <div class="col-md-4">

                <div class="box text-center shadow-sm p-4">

                    <h4>🌸 Pedicure</h4>

                    <p>
                        Perawatan kuku kaki untuk menjaga
                        kebersihan dan kesehatan kuku.
                    </p>

                    <h5 class="text-danger fw-bold">
                        Rp60.000
                    </h5>

                </div>

            </div>

            <!-- NAIL EXTENSION -->
            <div class="col-md-4">

                <div class="box text-center shadow-sm p-4">

                    <span class="badge bg-warning text-dark mb-2">
                        Premium
                    </span>

                    <h4>💎 Nail Extension</h4>

                    <p>
                        Menyambung kuku agar terlihat lebih panjang
                        dan elegan.
                    </p>

                    <h5 class="text-danger fw-bold">
                        Rp120.000
                    </h5>

                </div>

            </div>

            <!-- GEL POLISH -->
            <div class="col-md-4">

                <div class="box text-center shadow-sm p-4">

                    <h4>🎀 Gel Polish</h4>

                    <p>
                        Cat kuku gel dengan hasil glossy
                        dan tahan lama.
                    </p>

                    <h5 class="text-danger fw-bold">
                        Rp80.000
                    </h5>

                </div>

            </div>

            <!-- NAIL ART DESIGN -->
            <div class="col-md-4">

                <div class="box text-center shadow-sm p-4">

                    <span class="badge bg-success mb-2">
                        Favorite
                    </span>

                    <h4>🖤 Nail Art Design</h4>

                    <p>
                        Desain nail art sesuai request customer
                        dengan berbagai style menarik.
                    </p>

                    <h5 class="text-danger fw-bold">
                        Rp100.000
                    </h5>

                </div>

            </div>

            <!-- NAIL REMOVAL -->
            <div class="col-md-4">

                <div class="box text-center shadow-sm p-4">

                    <h4>💅 Nail Removal</h4>

                    <p>
                        Melepas nail extension atau gel polish
                        dengan aman dan rapi.
                    </p>

                    <h5 class="text-danger fw-bold">
                        Rp40.000
                    </h5>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- GALERI -->
<section class="py-5 bg-light" id="galeri">

    <div class="container">

        <h2 class="text-center mb-5 fw-bold">
            Galeri Nail Art 🎨
        </h2>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="box text-center shadow-sm">

                    <img src="img/b.jpg">

                    <div class="p-3">

                        <h5 class="fw-bold">
                            💖 Korean Style
                        </h5>

                        <p>
                            Nail art minimalis dengan warna soft dan elegan
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="box text-center shadow-sm">

                    <img src="img/c.jpg">

                    <div class="p-3">

                        <h5 class="fw-bold">
                            ✨ Glitter Nails
                        </h5>

                        <p>
                            Kuku berkilau dengan efek glitter yang cantik
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="box text-center shadow-sm">

                    <img src="img/d.jpg">

                    <div class="p-3">

                        <h5 class="fw-bold">
                            🌸 Floral Design
                        </h5>

                        <p>
                            Desain bunga yang manis dan feminin
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="box text-center shadow-sm">

                    <img src="img/e.jpg">

                    <div class="p-3">

                        <h5 class="fw-bold">
                            🖤 Marble Nails
                        </h5>

                        <p>
                            Desain marble elegan seperti batu alam
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="box text-center shadow-sm">

                    <img src="img/f.jpg">

                    <div class="p-3">

                        <h5 class="fw-bold">
                            💎 Luxury Nails
                        </h5>

                        <p>
                            Nail art premium dengan aksesoris kristal
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="box text-center shadow-sm">

                    <img src="img/g.jpg">

                    <div class="p-3">

                        <h5 class="fw-bold">
                            🎀 Cute Nails
                        </h5>

                        <p>
                            Desain lucu dengan warna cerah dan unik
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ABOUT -->
<section class="about-section py-5">

    <div class="container text-center">

        <h2 class="fw-bold">
            Tentang Kami
        </h2>

        <p class="mt-3 w-75 mx-auto">
            GlossyNails adalah salon nail art modern yang menyediakan
            berbagai layanan kecantikan kuku dengan desain kekinian,
            pelayanan profesional, dan harga yang terjangkau.
        </p>

    </div>

</section>

<!-- FOOTER -->
<footer class="footer-section">

    <p>
        &copy; 2026 GlossyNails Studio | All Rights Reserved
    </p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
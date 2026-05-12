<?php

session_start();

include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($konek,

        "SELECT * FROM user
        WHERE username='$username'
        AND password='$password'"

    );

    $cek = mysqli_num_rows($query);

    if($cek > 0){

        $_SESSION['user'] = $username;

        header("Location: index.php");
        exit;

    } else {

        echo "
        <script>

            alert('Username atau Password salah');

        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login GlossyNails</title>

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
            border-radius: 20px;
            border: none;
        }

        .judul{
            color: #ff4f81;
        }

        .btn-pink{
            background-color: #ff4f81;
            color: white;
        }

        .btn-pink:hover{
            background-color: #ff2f6d;
            color: white;
        }

    </style>

</head>

<body>

<div class="container mt-5">

    <div class="col-md-5 mx-auto">

        <div class="card shadow p-4">

            <h2 class="text-center mb-4 judul">
                Login Customer 💅
            </h2>

            <form method="POST">

                <label class="fw-bold">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    class="form-control mb-3"
                    placeholder="Masukkan username"
                    required
                >

                <label class="fw-bold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control mb-4"
                    placeholder="Masukkan password"
                    required
                >

                <button
                    type="submit"
                    name="login"
                    class="btn btn-pink w-100"
                >
                    Login
                </button>

            </form>

            <!-- REGISTER -->
            <div class="text-center mt-3">

                Belum punya akun?

                <a href="register.php"
                   class="text-danger fw-bold text-decoration-none">
                    Register
                </a>

            </div>

            <!-- KEMBALI -->
            <div class="text-center mt-2">

                <a href="index.php"
                   class="text-secondary text-decoration-none">
                    ← Kembali ke Home
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>
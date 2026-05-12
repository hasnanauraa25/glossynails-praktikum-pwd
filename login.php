<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $konek,

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
            alert('Username atau Password salah ❌');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login GlossyNails</title>
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
        .login-box{
            margin-top: 70px;
            margin-bottom: 70px;
        }
        .card{
            border-radius: 25px;
            border: none;
        }
        .judul{
            color: #ff4f81;
        }
        .btn-pink{
            background-color: #ff4f81;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            transition: 0.3s;
        }
        .btn-pink:hover{
            background-color: #ff2f6d;
            color: white;
        }
        .input-style{
            border-radius: 12px;
            padding: 10px;
        }
        .footer{
            background-color: white;
            padding: 35px 0;
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

<div class="container login-box">
    <div class="col-md-5 mx-auto">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4 judul fw-bold">
                Login Customer 💅
            </h2>

            <form method="POST">
                <label class="fw-bold mb-2">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    class="form-control input-style mb-3"
                    placeholder="Masukkan username"
                    required
                >

                <label class="fw-bold mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control input-style mb-4"
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

            <div class="text-center mt-4">
                Belum punya akun?
                <a
                    href="register.php"
                    class="text-danger fw-bold text-decoration-none"
                >
                    Register
                </a>
            </div>

            <div class="text-center mt-2">
                <a
                    href="index.php"
                    class="text-secondary text-decoration-none"
                >
                    ← Kembali ke Home
                </a>
            </div>
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

</body>
</html>
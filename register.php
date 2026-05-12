<?php
include 'koneksi.php';
if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    mysqli_query($konek,

    "INSERT INTO user(username, email, password)
    VALUES(
        '$username',
        '$email',
        '$password'
    )"

   );
     echo "
    <script>
        alert('Register berhasil');
        window.location.href = 'login.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register GlossyNails</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color: #fff5f7;
        }
        .card{
            border-radius: 20px;
            border: none;
        }
        .judul{
            color: #ff4f81;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <div class="col-md-5 mx-auto">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4 judul">
                Register Customer 💅
            </h2>

            <form method="POST">
                <label>Username</label>

                <input
                   type="text"
                   name="username"
                   class="form-control mb-3"
                >

                <label class="fw-bold">
                   Email
                </label>

                <input
                   type="email"
                   name="email"
                   class="form-control mb-3"
                   placeholder="Masukkan email"
                   required
                >

                <label>Password</label>

                <input
                   type="password"
                   name="password"
                   class="form-control mb-4"
                >

                <button
                   type="submit"
                   name="register"
                   class="btn btn-danger w-100"
                >
                   Register
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
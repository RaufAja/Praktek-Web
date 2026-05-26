<?php
session_start();
include 'koneksi.php';

// Jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); 

    $query = "SELECT * FROM `user-cristal` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        $_SESSION['id']       = $data['id'];       
        $_SESSION['username'] = $data['username']; 
        $_SESSION['role']     = $data['role'];     
        
        echo "<script>alert('Login Berhasil!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Ekskul Cristal</title>
    <style>
        /* Mengubah warna background halaman menjadi hijau sangat muda */
        body {
            background-color: #e8f5e9;
            font-family: Arial, sans-serif;
        }

        /* Desain Kotak Login */
        .login-container { 
            max-width: 400px; 
            margin: 50px auto; 
            padding: 30px 20px; 
            background-color: white; /* Latar belakang kotak tetap putih agar kontras */
            border-top: 5px solid #2e7d32; /* Garis hijau tua di atas kotak */
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sedikit bayangan agar elegan */
            text-align: center; 
        }

        body {
            /* Gradasi diagonal hitam ke hijau tua */
            background: linear-gradient(to bottom, #28a745, #0c561d);
            font-family: Arial, sans-serif;
            height: 150vh; /* Memastikan background memenuhi tinggi layar */
            margin: 0;
        }

        /* Desain Logo */
        .logo-ekskul {
            width: 200px; /* Atur ukuran logo di sini */
            height: auto;
            margin-bottom: 15px;
        }

        h2 {
            color: #2e7d32; /* Warna teks hijau tua */
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-group { 
            margin-bottom: 15px; 
            text-align: left; 
        }
        
        label { 
            display: block; 
            margin-bottom: 5px; 
            color: #333;
            font-weight: bold;
        }
        
        input { 
            width: 100%; 
            padding: 10px; 
            box-sizing: border-box; 
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 5px rgba(46, 125, 50, 0.3);
        }

        /* Tombol nuansa hijau */
        button { 
            padding: 10px 15px; 
            background-color: #28a745; /* Hijau dasar */
            color: white; 
            border: none; 
            border-radius: 4px; 
            width: 100%; 
            font-size: 16px;
            font-weight: bold;
            cursor: pointer; 
            transition: 0.3s;
        }
        
        button:hover { 
            background-color: #218838; /* Hijau lebih gelap saat disentuh */
        }

        .link-daftar {
            margin-top: 15px;
            font-size: 14px;
        }

        .link-daftar a {
            color: #2e7d32;
            text-decoration: none;
            font-weight: bold;
        }

        .link-daftar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="logo.png" alt="Logo Ekskul Cristal" class="logo-ekskul">
    
    <h2>Login Ekskul Cristal</h2>
    
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Masukkan username...">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password...">
        </div>
        <button type="submit" name="login">Masuk</button>
    </form>
    
    <div class="link-daftar">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</div>

</body>
</html>
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['tambah'])) {
    $username      = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap  = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $kelas         = $_POST['kelas'];
    $jabatan       = $_POST['jabatan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
    $role          = $_POST['role'];
    
    // Cek kecocokan password
    if ($_POST['password'] !== $_POST['repassword']) {
        echo "<script>alert('Password dan Konfirmasi Password tidak cocok!');</script>";
    } else {
        $password_hashed = md5($_POST['password']);
        
        $query = "INSERT INTO `user-cristal` 
                  (username, password, role, nama_lengkap, kelas, jabatan, jenis_kelamin, alamat) 
                  VALUES 
                  ('$username', '$password_hashed', '$role', '$nama_lengkap', '$kelas', '$jabatan', '$jenis_kelamin', '$alamat')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Anggota baru berhasil ditambah!'); window.location='dashboard.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota Baru</title>
    <style>
        body {
        /* Gradasi diagonal hitam ke hijau tua */
            background: linear-gradient(to bottom, #28a745, #0c561d);
            font-family: Arial, sans-serif;
            height: 150vh; /* Memastikan background memenuhi tinggi layar */
            margin: 0;
        }

        .form-container { max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; font-weight: bold; }
        .btn-tambah { background-color: #28a745; }
        .btn-tambah:hover { background-color: #0056b3; }
        .btn-batal { background-color: #6c757d; text-decoration: none; padding: 10px 15px; border-radius: 4px; color: white; display: inline-block; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Anggota Baru</h2>
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="repassword" required>
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" required>
                <option value="X TJKT 1">X TJKT 1</option>
                <option value="X TJKT 2">X TJKT 2</option>
                <option value="X TJKT 3">X TJKT 3</option>
                <option value="XI TJKT 1">XI TJKT 1</option>
                <option value="XI TJKT 2">XI TJKT 2</option>
                <option value="XI TJKT 3">XI TJKT 3</option>
                <option value="XI TJKT 4">XI TJKT 4</option>          
            </select>
        </div>
        <div class="form-group">
            <label>Jabatan</label>
            <select name="jabatan" required>
                <option value="Anggota Baru">Anggota Baru</option>
                <option value="Pengurus">Pengurus</option>
                <option value="Ketua Ekskul">Ketua Ekskul</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Sekretaris">Sekretaris</option>
                <option value="Bendahara">Bendahara</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" required></textarea>
        </div>
        <div class="form-group">
            <label>Hak Akses (Role)</label>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div style="margin-top: 20px;">
            <button type="submit" name="tambah" class="btn btn-tambah">Simpan Anggota</button>
            <a href="dashboard.php" class="btn-batal">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
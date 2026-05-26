<?php
session_start();
include 'koneksi.php';

if (isset($_POST['daftar'])) {
    // Menangkap semua data dari form
    $username      = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap  = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $kelas         = mysqli_real_escape_string($conn, $_POST['kelas']);
    $jabatan       = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
    
    $password      = $_POST['password'];
    $repassword    = $_POST['repassword'];
    $role          = 'user'; // Otomatis diset sebagai user biasa

    // 1. Verifikasi apakah Password dan Re-enter Password sama
    if ($password !== $repassword) {
        echo "<script>alert('Pendaftaran Gagal: Password dan Konfirmasi Password tidak cocok!');</script>";
    } else {
        // Enkripsi password setelah dipastikan cocok
        $password_hashed = md5($password);

        // 2. Cek apakah username sudah dipakai orang lain
        $cek_user = mysqli_query($conn, "SELECT * FROM `user-cristal` WHERE username='$username'");
        if (mysqli_num_rows($cek_user) > 0) {
            echo "<script>alert('Username sudah terdaftar! Silakan gunakan username lain.');</script>";
        } else {
            // 3. Simpan semua data ke database
            $query = "INSERT INTO `user-cristal` 
                    (username, password, role, nama_lengkap, kelas, jabatan, jenis_kelamin, alamat) 
                    VALUES 
                    ('$username', '$password_hashed', '$role', '$nama_lengkap', '$kelas', '$jabatan', '$jenis_kelamin', '$alamat')";
                                
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Pendaftaran akun berhasil! Silakan login.'); window.location='login.php';</script>";
            } else {
                die("Pendaftaran gagal! Error MySQL: " . mysqli_error($conn));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Ekskul Cristal</title>
    <style>

        body {
            /* Gradasi diagonal hitam ke hijau tua */
            background: linear-gradient(to bottom, #28a745, #0c561d);
            font-family: Arial, sans-serif;
            height: 150vh; /* Memastikan background memenuhi tinggi layar */
            margin: 0;
        }

        body { font-family: 'Segoe UI', sans-serif; background-color: #f4fbf7; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 40px 20px; box-sizing: border-box; }
        .box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 420px; border-top: 5px solid #2e7d32; }
        .box h2 { color: #2e7d32; margin-top: 0; text-align: center; margin-bottom: 5px; }
        .box p.subtitle { text-align: center; color: #666; font-size: 14px; margin-bottom: 25px; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px; color: #444; }
        input[type="text"], input[type="password"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-family: inherit; font-size: 14px; background-color: #fff; }
        textarea { resize: vertical; height: 80px; }
        
        .row { display: flex; gap: 15px; }
        .row .col { flex: 1; }

        .btn-submit { background-color: #2e7d32; color: white; width: 100%; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; margin-top: 15px; font-size: 15px; transition: 0.3s; }
        .btn-submit:hover { background-color: #1b5e20; }
        .link { display: block; text-align: center; margin-top: 15px; font-size: 13px; color: #555; text-decoration: none; }
        .link:hover { color: #2e7d32; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Pendaftaran Anggota</h2>
        <p class="subtitle">Lengkapi biodata di bawah ini</p>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" required>
                            <option value="" disabled selected>Pilih Kelas...</option>
                            <option value="X TJKT 1">X TJKT 1</option>
                            <option value="X TJKT 2">X TJKT 2</option>
                            <option value="X TJKT 3">X TJKT 3</option>
                            <option value="XI TJKT 1">XI TJKT 1</option>
                            <option value="XI TJKT 2">XI TJKT 2</option>
                            <option value="XI TJKT 3">XI TJKT 3</option>
                            <option value="XI TJKT 4">XI TJKT 4</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="" disabled selected>Pilih...</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Jabatan di Ekskul</label>
                <select name="jabatan" required>
                    <option value="" disabled selected>Pilih Jabatan...</option>
                    <option value="Pengurus">Pengurus</option>
                    <option value="Ketua Ekskul">Ketua Ekskul</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" placeholder="Masukkan alamat" required></textarea>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

            <div class="form-group">
                <label>Buat Username (Untuk Login)</label>
                <input type="text" name="username" placeholder="Buat username tanpa spasi" required>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Buat password" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Ulangi Password</label>
                        <input type="password" name="repassword" placeholder="Ketik ulang" required>
                    </div>
                </div>
            </div>

            <button type="submit" name="daftar" class="btn-submit">Daftar Sekarang</button>
        </form>
        
        <a href="login.php" class="link">Sudah punya akun? Login di sini</a>
    </div>
</body>
</html>
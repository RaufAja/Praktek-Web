<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='dashboard.php';</script>";
    exit();
}

$id = $_GET['id'];

// Proses Update Data
if (isset($_POST['update'])) {
    $username      = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap  = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $kelas         = mysqli_real_escape_string($conn, $_POST['kelas']);
    $jabatan       = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
    $role          = $_POST['role'];

    // Cek apakah admin mengisi password baru
    if (!empty($_POST['password'])) {
        $password_baru = md5($_POST['password']); // Enkripsi password baru
        $query_update = "UPDATE `user-cristal` SET 
                         username='$username', 
                         password='$password_baru',
                         nama_lengkap='$nama_lengkap', 
                         kelas='$kelas', 
                         jabatan='$jabatan', 
                         jenis_kelamin='$jenis_kelamin',
                         alamat='$alamat', 
                         role='$role' 
                         WHERE id='$id'";
    } else {
        // Jika password kosong, update data tanpa mengubah password
        $query_update = "UPDATE `user-cristal` SET 
                         username='$username', 
                         nama_lengkap='$nama_lengkap', 
                         kelas='$kelas', 
                         jabatan='$jabatan', 
                         jenis_kelamin='$jenis_kelamin',
                         alamat='$alamat', 
                         role='$role' 
                         WHERE id='$id'";
    }

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='dashboard.php';</script>";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}

// Ambil data lama
$result = mysqli_query($conn, "SELECT * FROM `user-cristal` WHERE id = '$id'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Anggota</title>
    <style>

        body {
            /* Gradasi diagonal hitam ke hijau tua */
            background: linear-gradient(to bottom, #28a745, #0c561d);
            font-family: Arial, sans-serif;
            height: 150vh; /* Memastikan background memenuhi tinggi layar */
            margin: 0;
        }

        .form-container { max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;}
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; font-weight: bold; }
        .btn-update { background-color: #28a745; }
        .btn-update:hover { background-color: #218838; }
        .btn-batal { background-color: #6c757d; text-decoration: none; padding: 10px 15px; border-radius: 4px; color: white; display: inline-block; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Data: <?php echo $user['username']; ?></h2>
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Password Baru (Opsional)</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
            <small style="color: red;">*Karena sistem keamanan enkripsi, password lama tidak dapat ditampilkan.</small>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?php echo $user['nama_lengkap']; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" required>
                <?php 
                $list_kelas = ["X TJKT 1", "X TJKT 2", "X TJKT 3", "XI TJKT 1", "XI TJKT 2", "XI TJKT 3", "XI TJKT 4"];
                foreach($list_kelas as $k) {
                    $selected = ($user['kelas'] == $k) ? "selected" : "";
                    echo "<option value='$k' $selected>$k</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Jabatan</label>
            <select name="jabatan" required>
                <?php
                $list_jabatan = ["Anggota Baru", "Pengurus", "Ketua Ekskul", "Wakil Ketua", "Sekretaris", "Bendahara"];
                foreach($list_jabatan as $j) {
                    $selected = ($user['jabatan'] == $j) ? "selected" : "";
                    echo "<option value='$j' $selected>$j</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki" <?php if($user['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if($user['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required><?php echo $user['alamat']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Hak Akses (Role)</label>
            <select name="role" required>
                <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" name="update" class="btn btn-update">Simpan Perubahan</button>
            <a href="dashboard.php" class="btn-batal">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
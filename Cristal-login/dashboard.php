<?php
session_start();
include 'koneksi.php';

// 1. Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. Ambil data dari session dengan nilai default agar tidak ada error undefined variable
$username_sekarang = $_SESSION['username'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Ekskul Cristal</title>
    <style>
        /* Desain dasar halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Desain untuk Header Dashboard (Logo + Judul) menggunakan Flexbox */
        .header-dashboard {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2e7d32;
        }

        .logo-dashboard {
            width: 60px;
            height: auto;
            margin-right: 15px;
        }
        
        .judul-teks {
            flex-grow: 1; /* Membuat teks mengisi ruang sisa */
        }

        .judul-teks h2 {
            margin: 0;
            color: #2e7d32;
        }

        /* Desain Tabel agar teks di tengah */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th, td {
            text-align: center;      /* Teks tengah horizontal */
            vertical-align: middle;  /* Teks tengah vertikal */
            padding: 10px;
            border: 1px solid #ddd;
        }
        
        th {
            background-color: #2e7d32;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        body {
            /* Gradasi diagonal hitam ke hijau tua */
            background: linear-gradient(to bottom, #28a745, #0c561d);
            font-family: Arial, sans-serif;
            height: 100vh; /* Memastikan background memenuhi tinggi layar */
            margin: 0;
        }

        /* Desain Tombol */
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
            transition: 0.3s;
            margin: 2px;
        }
        
        .btn-edit { background-color: #28a745; }
        .btn-edit:hover { background-color: #218838; }
        
        .btn-hapus { background-color: #dc3545; }
        .btn-hapus:hover { background-color: #c82333; }

        .btn-tambah { 
            background-color: #007bff; 
            padding: 10px 15px; 
            font-size: 14px; 
            margin-bottom: 15px; 
        }
        .btn-tambah:hover { background-color: #0056b3; }

        .btn-logout { 
            background-color: #c82333; 
            padding: 8px 15px; 
            font-size: 14px;
        }
        .btn-logout:hover { background-color: #5a6268; }
    </style>
</head>
<body>

<div class="container">
    
    <div class="header-dashboard">
        <img src="logo.png" alt="Logo Ekskul Cristal" class="logo-dashboard">
        <div class="judul-teks">
            <h2>Dashboard Ekskul Cristal</h2>
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #555;">
                Selamat datang, <strong><?php echo $username_sekarang; ?></strong> 
                (<?php echo ucfirst($role); ?>)
            </p>
        </div>
        <div>
            <a href="logout.php" class="btn btn-logout" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
        </div>
    </div>

    <?php if($role == 'admin'): ?>
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Anggota Baru</a>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <?php if($role == 'admin') { echo "<th>Alamat</th><th>Aksi</th>"; } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ambil seluruh data dari database
            $query = "SELECT * FROM `user-cristal` ORDER BY id DESC";
            $data = mysqli_query($conn, $query); // Eksekusi query
            $no = 1;

            // Perulangan untuk menampilkan isi tabel
            while($row = mysqli_fetch_assoc($data)) {
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".(isset($row['username']) ? $row['username'] : '-')."</td>";
                echo "<td>".(isset($row['nama_lengkap']) ? $row['nama_lengkap'] : '-')."</td>";
                echo "<td>".(isset($row['kelas']) ? $row['kelas'] : '-')."</td>";
                echo "<td>".(isset($row['jabatan']) ? $row['jabatan'] : '-')."</td>";
                echo "<td>".(isset($row['jenis_kelamin']) ? $row['jenis_kelamin'] : '-')."</td>";
                
                // Menampilkan Alamat dan Tombol Edit/Hapus khusus admin
                if($role == 'admin') {
                    echo "<td>".(isset($row['alamat']) ? $row['alamat'] : '-')."</td>";
                    echo "<td>
                            <a href='edit.php?id=".$row['id']."' class='btn btn-edit'>Edit</a>
                            <a href='hapus.php?id=".$row['id']."' class='btn btn-hapus' onclick='return confirm(\"Yakin ingin menghapus akun ini?\")'>Hapus</a>
                          </td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
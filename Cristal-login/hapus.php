<?php
session_start();
include 'koneksi.php';

// Keamanan 1: Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='dashboard.php';</script>";
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Keamanan 2: Cegah admin menghapus akunnya sendiri yang sedang aktif
    if ($id == $_SESSION['id']) {
        echo "<script>alert('Peringatan: Anda tidak diizinkan menghapus akun Anda sendiri saat sedang login!'); window.location='dashboard.php';</script>";
        exit(); // Hentikan proses di sini
    }
    
    // Jika lolos pengecekan di atas, lakukan penghapusan data
    $query = "DELETE FROM `user-cristal` WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Akun berhasil dihapus!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "'); window.location='dashboard.php';</script>";
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke dashboard
    header("Location: dashboard.php");
}
?>
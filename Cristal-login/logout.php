<?php
session_start();
session_destroy(); // Bersihkan semua data session login
header("location:login.php");
exit;
?>
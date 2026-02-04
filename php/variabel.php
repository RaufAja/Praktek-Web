<?php
    echo "Biodata<br>" ;
    echo "Nama: Rauf Putra Gunawan <br>";
    echo "Kelas: XI TJKT 2 <br>";
    echo "<hr>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Sederhana dengan PHP</title>
</head>
<body>

<form action="kalkulator.php" method="post">
    Angka 1: <input type="text" name="angka1"><br>
    Angka 2: <input type="text" name="angka2"><br>
    Operasi: 
    <select name="operasi">
        <option value="tambah">Tambah</option>
        <option value="kurang">Kurang</option>
        <option value="kali">Kali</option>
        <option value="bagi">Bagi</option>
    </select>
    <br>
    <input type="submit" name="hitung" value="Hitung">
</form>

</body>
</html>

<?php
if(isset($_POST['hitung'])){
    $angka1 = $_POST['angka1'];
    $angka2 = $_POST['angka2'];
    $operasi = $_POST['operasi'];

    switch ($operasi) {
        case 'tambah':
            $hasil = $angka1 + $angka2;
            break;
        case 'kurang':
            $hasil = $angka1 - $angka2;
            break;
        case 'kali':
            $hasil = $angka1 * $angka2;
            break;
        case 'bagi':
            $hasil = $angka1 / $angka2;
            break;            
        default:
            break;
    }
    echo "Hasil: " . $hasil;
    echo "<h2>Hasil: " . $hasil . "</h2>";
    
}
?>


<?php 
   $level=4;

   switch ($level) {
    case 1:
        echo"pelajari HTML <br>";
        break;
    case 2:
        echo "pelajari CSS <br>";
        break;
    case 3:
        echo "pelajari Javascript <br>";
        break;
    case 4:
        echo "pelajari PHP <br>";
        break;
    default:
    echo "Kamu bukan Programmer <br>";
}


$nilai = 90;

if ($nilai >= 90) {
    $grade = "A+";
    $status = "Kamu Lulus!";
} elseif($nilai > 80){
    $grade = "A";
    $status = "Kamu Tidak Lulus!";
} elseif($nilai > 70){
    $grade = "B+";
    $status = "Kamu Tidak Lulus!";
} elseif($nilai > 60){
    $grade = "B";
    $status = "Kamu Tidak Lulus!";
} elseif($nilai > 50){
    $grade = "C+";
    $status = "Kamu Tidak Lulus!";
} elseif($nilai > 40){
    $grade = "C";
    $status = "Kamu Tidak Lulus!";
} elseif($nilai > 30){
    $grade = "D";
    $status = "Kamu Tidak Lulus!";
} elseif($nilai > 20){
    $grade = "E";
    $status = "Kamu Tidak Lulus!";
} else {
    $grade = "F";
    $status = "Kamu Tidak Lulus!";
}

echo "Nilai anda: $nilai<br>";
echo "Grade: $grade <br>";
echo $status;


?>
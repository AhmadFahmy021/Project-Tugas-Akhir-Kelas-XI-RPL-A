<?php
include "functions.php";

$bulan = $_POST["bulan"];
$tahun = $_POST["tahun"];
$id = $_POST["id"];
$kamar = $_POST["kamar"];
$tarif = $_POST["tarif"];

$query = "INSERT INTO tagihan (bulan,tahun,idpenghuni,tagihan,statuss) VALUES ('$bulan','$tahun','$id','$kamar','$tarif','BL'";
mysqli_query($conn, $query);
?>
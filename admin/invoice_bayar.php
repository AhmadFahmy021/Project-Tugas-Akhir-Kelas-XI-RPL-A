<?php
include '../functions.php';
$id = $_GET['id'];
// $sql = "SELECT * FROM pembayaran p Join kamar k ON k.idkamar=p.idkamar WHERE p.idpembayaran = $id";
// $sql = "SELECT * FROM penghuni p INNER JOIN kamar k on p.idkamar=k.idkamar INNER JOIN status s ON p.idstatus=s.idstatus WHERE p.idpenghuni = $id";
$sql = "SELECT * FROM pembayaran p INNER Join kamar k ON k.idkamar=p.idkamar INNER JOIN status s ON s.idstatus=p.idstatus WHERE p.idpembayaran = $id";
$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($r);
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LAPORAN INVOICE PEMBAYARAN</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    
</head>
<body>
   <h4><i>LAPORAN INVOICE LUNAS TUGAS AKHIR</i></h4>
   <p><i>Waktu Sewa: '.$row['lama'].' Bulan</i></p><br>
   <table>
        <tr>
            <td>Nama Penyewa</td>
            <td>:</td>
            <td><b>' . $row["namapenghuni"] .' </b></td>
        </tr>
        <tr>
            <td>Kamar</td>
            <td>:</td>
            <td>' . $row["nokamar"] . ' </td>
        </tr>
        <tr>
            <td>Tarif</td>
            <td>:</td>
            <td>Rp. ' . $row["tarif"] . '</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>:</td>
            <td>Rp. ' . $row["tarif"] * $row['lama']. '</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td><h1 style = "text-transform: uppercase;">' . $row["status"].'</h1></td>
        </tr>
    </table><br><br><br>';
$mpdf->WriteHTML($html);
$mpdf->Output();
<?php
include '../functions.php';
// $sql = "SELECT * FROM pembayaran p Join kamar k ON k.idkamar=p.idkamar WHERE p.idpembayaran = $id";
$sql = "SELECT * FROM penghuni p INNER JOIN kamar k ON p.idkamar=k.idkamar";
$phn = query("SELECT * FROM penghuni p INNER JOIN kamar k ON p.idkamar=k.idkamar");
// $sql = "SELECT * FROM pembayaran p INNER Join kamar k ON k.idkamar=p.idkamar INNER JOIN status s ON s.idstatus=p.idstatus inner join penghuni h on h.idkamar = p.idkamar";
$r = mysqli_query($conn, $sql);
require_once __DIR__ . '/vendor/autoload.php';
$i = 1;
$cetakPenghuni = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LAPORAN INVOICE PEMBAYARAN</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    
</head>
<body>
   <h4><i>CETAK DATA PENGHUNI</i></h4>
   <p><i></i></p><br>
   <table border="1" cellpadding="10" cellspacing="0">
        
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kamar</th>
            <th>Kampus</th>
            <th>No. Hp</th>
            <th>Tanggal Masuk</th>
            <th>Foto KTP</th>
        </tr>';
foreach ($phn as $row)  {
    # code...
    $html .='<tr>
                <td>' . $i++ . ' </td>
                <td>' . $row["namapenghuni"] . ' </td>
                <td>' . $row["nokamar"] . ' </td>
                <td>' . $row["kampus"] . ' </td>
                <td>' . $row["telepon"] . ' </td>
                <td>' . date(' d-m-Y', strtotime($row['masuk'])).' </td>
                <td><img src="../img/'.$row["foto"].'" width="100px" ></td>
            </tr>
            
        ';
}
        
$html .= '
</table><br><br><br>
</body>
</html>';
$cetakPenghuni->WriteHTML($html);
$cetakPenghuni->Output();
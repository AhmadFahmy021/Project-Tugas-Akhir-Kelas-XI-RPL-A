<?php 
session_start();
include '../functions.php';
$id = $_SESSION['nama'];
$sql = "SELECT * FROM penghuni WHERE idkamar = $id";
// $sql = "SELECT * FROM status  WHERE idkamar = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran Belum Lunas</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>


    <h1 class="text-center mt-5 pt-5 text-dark font-weight-bold fs">Anda Belum Melunasi Pembayaran</h1>
        <h1 class="text-center mt-2 pb-5 text-dark font-weight-bold fs">Silahkan Bayar Di No Rekening 09832923</h1>
    <a href="../logout.php" class=" btn btn-danger container btn-lg btn-block col-md-8 mt-5">Logout</a>
    <!-- <a href="bayar.php?id=<?= $row['idpenghuni']; ?>&idstatus=<?= $row['idstatus']; ?>" class=" btn btn-danger container btn-lg btn-block col-md-8 mt-5">Bayar</a> -->
</body>

</html>
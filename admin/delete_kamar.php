<?php
session_start();
// if (!isset($_SESSION["login"])) {
//     header("location: login.php");
//     exit;
// }
include '../functions.php';

$id = $_GET["id"];

if (hapus_kamar($id) > 0) {
    echo "<script>
        alert('Berhasil menghapus data');
        location.href = 'kamar.php';
        </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data');
        location.href = 'kamar.php';
        </script>";
}
?>
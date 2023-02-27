<?php
include '../functions.php';
$id = $_GET['id'];
$date = date('d-m-y');
$sql = "UPDATE pembayaran SET
    idstatus = 3,
    bayar = '$date'
    WHERE idpembayaran = $id
    ";
    // var_dump($sql);
    // die;
$result = mysqli_query($conn, $sql);
//  mysqli_query($conn, $sql1);
// header("location : 'lunas.php';");
// $row = mysqli_fetch_assoc($result);
if ($result > 0) {
    echo "
        <script>
            
            location.href = 'lunas.php';
        </script>
    ";
} else {
    echo "
    <script>
        alert('gagal');
        location.href = 'tagihan.php';
    </script>
";
}
// header("Location : lunas.php");
// $row = mysqli_fetch_assoc($r);
// $result3 = mysqli_query($conn, "SELECT * FROM penghuni p JOIN kamar k ON k.idkamar = p.idkamar");
?>
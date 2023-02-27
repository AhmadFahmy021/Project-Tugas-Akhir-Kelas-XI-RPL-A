<?php

use Mpdf\Tag\Header;

session_start();
include '../functions.php';
if (!isset($_SESSION['user'])) {
    header('location: ../index.php');
}
$result = mysqli_query($conn, "SELECT * FROM kamar k join status s on k.idstatus=s.idstatus WHERE k.idstatus = 2");

if (isset($_POST["submit"])) {
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$kota = $_POST['kota'];
$hp = $_POST['hp'];

$kamar = $_POST['kamar'];
$lama = $_POST['lama'];

if (tambah($_POST) > 0) {
    // header("location: masuk.php");
    echo "
    <script>
    alert('Berhasil Daftar Sebagai Penghuni');
    location.href = 'masuk.php';
    </script>
    ";
    header("location: https://api.whatsapp.com/send?phone=$wa&text=Nama:%20$nama%20%0DAlamat:%20$alamat%20%0DKota:%20$kota");
    } else {
        echo mysqli_error($conn);
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pendaftaran</title>
    <!-- <link rel="stylesheet" href="css/sb-admin-2.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body class="">
    <div class="container mb-3 col-md-8 justify-content-center">
        <div class="row mt-5 pt-5">
            <div class="card ">
                <div class="card-header fw-bold fs-4 text-center ">
                    Daftar Penghuni
                </div>
                <div class="card-body mb-3">
                    <!-- <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    <form action="" method="POST" enctype="multipart/form-data" >
                        <div class="row mb-1">
                            <input type="hidden" name="wa" value="6281252512088">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input class="form-control" name="nama" id="inputLastName" type="text" placeholder="Enter your last name" autofocus />
                                    <label for="inputLastName">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mt-2 col">
                                    <textarea class="form-control" name="alamat" id="inputLastName" type="text" placeholder="Enter your last name"></textarea>
                                    <label for="inputLastName">Alamat Asal</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mt-2 col">
                                    <input class="form-control" name="kota" id="inputLastName" type="text" placeholder="Enter your last name">
                                    <label for="inputLastName">Kota Asal</label>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="hp" id="inputFirstName" type="number" placeholder="Enter your first name" />
                                    <label for="inputFirstName">No. HP</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="kampus" id="inputLastName" type="text" placeholder="Enter your last name" />
                                    <label for="inputLastName">Universitas</label>
                                </div>
                            </div>
                        </div>
                        <label for="inputEmail" class="mb-2">Foto KTP</label>
                        <div class="mb-3">
                            <input class="form-control" name="gambar" id="inputEmail" type="file" placeholder="KTP" />
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-4 mb-md-4">
                                    <input class="form-control" name="masuk" id="inputPassword" type="date" placeholder="Tanggal Masuk" />
                                    <label for="inputPassword">Tanggal Masuk</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class=" mb-3 mb-md-0">
                                    <select class="form-select" name="batas" aria-label="Default select example">
                                        <option value="0" selected>Pilih Lama Sewa</option>
                                        <option value="1">1 Bulan</option>
                                        <option value="2">2 Bulan</option>
                                        <option value="3">3 Bulan</option>
                                        <option value="4">4 Bulan</option>
                                        <option value="5">5 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="7">7 Bulan</option>
                                        <option value="8">8 Bulan</option>
                                        <option value="9">9 Bulan</option>
                                        <option value="10">10 Bulan</option>
                                        <option value="11">11 Bulan</option>
                                        <option value="12">12 Bulan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mt-3 mb-md-0">
                                        <?php
                                        function getRandom($length)
                                        {

                                            $str = 'abcdefghijklmnopqrstuvwzyz';
                                            $str1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            // $str2= '0123456789';
                                            $shuffled = str_shuffle($str);
                                            $shuffled1 = str_shuffle($str1);
                                            // $shuffled2 = str_shuffle($str2);
                                            $total = $shuffled . $shuffled1;
                                            $shuffled3 = str_shuffle($total);
                                            $result = substr($shuffled3, 0, $length);

                                            return $result;
                                        }

                                        // $str =  getRandom(8);


                                        ?>
                                        <input class="form-control" name="sandi" readonly id="inputPassword" type="text" placeholder="Tanggal Masuk" value="<?= getRandom(8); ?>" />
                                        <label for="inputPassword">Kunci Kamar</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select class="form-select" name="kamar" aria-label="Default select example">
                                            <option selected> -- Pilih Kamar -- </option>
                                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                <option value="<?= $row['idkamar']; ?>"><?= "Kamar Nomer " . $row['nokamar'], "  Tarif " . $row['tarif'], " Status " . $row['status']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="mt-4 mb-0">
                                <button>Submit</button>
                            </div> -->
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary" type="submit" name="submit">Daftar Penghuni</button>
                                    <a href="masuk.php" class="btn btn-danger mt-2 justify-content-end">Batal</a>

                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
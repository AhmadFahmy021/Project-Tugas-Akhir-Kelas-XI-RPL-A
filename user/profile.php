<?php
session_start();
include '../functions.php';
if (!isset($_SESSION["masuk"])) {
    header("location: masuk.php");
    exit;
}

$nama = $_SESSION['nama'];
$id = $_SESSION['idpenghuni'];
// var_dump($nama);
// die;
$resuly2 = "SELECT * FROM penghuni ";

$resuly = "SELECT * FROM penghuni p  INNER JOIN pembayaran b ON p.idkamar = b.idkamar INNER JOIN kamar k ON k.idkamar=p.idkamar WHERE p.idpenghuni = $id ";
// $resuly = "SELECT * FROM penghuni p INNER JOIN kamar k ON p.idkamar=k.idkamar Where idpenghuni = $id";
// $resuly2 = "SELECT * FROM pembayaran WHERE idstatus = $id ";
$a = mysqli_query($conn, $resuly);
$a2 = mysqli_query($conn, $resuly2);
$phn = mysqli_fetch_assoc($a);
$phn2 = mysqli_fetch_assoc($a2);
if (isset($_POST["submit"])) {
    if (ubahUser($_POST) > 0) {
        if ($phn['idkamar'] == $_POST['kamar']) {
            echo "<script>
            alert('Berhasil Upadate data!!');
            location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
            alert('Berhasil Upadate data!!');
            location.href = '../logout.php';
            </script>";
        }
    } else {
        // echo "<script>
        // alert('Gagal Upadate data!!');
        // location.href = 'index.php';
        // </script>";
        echo mysqli_error($conn);
        header('location: profile.php');
        exit;
    }
}
if ($phn['idstatus'] == 4) {
    header("location: belum.php");
    exit;
} else if ($phn['idstatus'] == 5) {
    header("location: tenggat.php");
    exit;
} else if (date("d-m-Y") === date('d-m-Y', strtotime('+' . $phn['lama'] . 'month', strtotime($phn2['masuk'])))) {
    $sql = "UPDATE pembayaran SET 
    idstatus = 5
    Where nama = '$nama'
    ";
    $resuly3 = mysqli_query($conn, $sql);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'layout/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 fw-bold">Profile Penghuni</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row 1 -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $phn['idpenghuni']; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $phn['foto']; ?>">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="nama" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= $phn["namapenghuni"]; ?>" />
                                    <label for="inputFirstName">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="alamat" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $phn["alamat"]; ?>" />
                                    <label for="inputLastName">Alamat Asal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="kota" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $phn["kota"]; ?>" />
                                    <label for="inputLastName">Kota Asal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="hp" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= $phn["telepon"]; ?>" />
                                    <label for="inputFirstName">No. HP</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" name="kampus" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $phn["kampus"]; ?>" />
                                    <label for="inputLastName">Kampus</label>
                                </div>
                            </div>
                        </div>
                        <!-- <label for="inputEmail" class="mb-2">Foto KTP</label>
                        <div class="mb-4">
                            <img src="../img/<?= $phn["foto"]; ?>" width="100px" alt="penghuni">
                        </div>
                        <div class="mb-3 custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div> -->
                        <div class="mb-4">
                            <img src="../img/<?= $phn["foto"]; ?>" width="100px" alt="penghuni">
                        </div>
                        <div class="input-group mb-3">

                            <input type="file" name="gambar" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <!-- <input class="form-control" name="gambar" id="inputEmail" type="file" placeholder="KTP"> -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="masuk" id="inputPassword" type="date" placeholder="Tanggal Masuk" value="<?= $phn['masuk']; ?>">
                                    <label for="inputPassword">Tanggal Masuk</label>
                                </div>
                            </div>
                            <!-- <?php
                            $result = mysqli_query($conn, "SELECT * FROM kamar k inner join status s on s.idstatus=k.idstatus WHERE k.idstatus = 2 ");

                            ?> -->
                            <div class="col-md-6">
                                <div class="mb-3 form-floating">
                                    <input class="form-control" name="kamar" readonly disabled id="inputPassword" type="text" placeholder="Tanggal Masuk" value="<?= $phn['nokamar']; ?>">
                                    <label for="inputPassword">Nomer Kamar</label>
                                </div>
                                <select class="form-select mt-2" name="kamar" aria-label="Default select example">
                                    <option selected>Nomer Kamar</option>
                                    <?php
                                    // $result = mysqli_query($conn, "SELECT * FROM kamar where idstatus = 1");
                                    $result = mysqli_query($conn, "SELECT * FROM kamar k inner join status s on s.idstatus=k.idstatus ");
                                    $result2 = mysqli_query($conn, "SELECT * FROM penghuni ");
                                    $row2 = mysqli_fetch_assoc($result2);
                                    while ($row = mysqli_fetch_assoc($result)) : 
                                        if ($phn['idkamar']) {
                                            # co
                                        }
                                    ?>
                                    
                                        <option aria-readonly="readonly" value="<?= $row['idkamar']; ?>" <?php if ($phn['idkamar'] == $row['idkamar']) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?= "Kamar Nomer " . $row['nokamar']; ?></option>

                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="justify-content-center row mb-3">

                            <div class="col-md-4 ">
                                <div class="mb-3">
                                    <select class="form-select" name="lama" aria-label="Default select example">
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM pembayaran where idpembayaran = $id");

                                        $row = mysqli_fetch_assoc($result) ?>

                                        <option value="1" <?php if ($row['lama'] == 1) {
                                                                echo "selected";
                                                            } ?>>1 Bulan</option>
                                        <option value="2" <?php if ($row['lama'] == 2) {
                                                                echo "selected";
                                                            } ?>>2 Bulan</option>
                                        <option value="3" <?php if ($row['lama'] == 3) {
                                                                echo "selected";
                                                            } ?>>3 Bulan</option>
                                        <option value="4" <?php if ($row['lama'] == 4) {
                                                                echo "selected";
                                                            } ?>>4 Bulan</option>
                                        <option value="5" <?php if ($row['lama'] == 5) {
                                                                echo "selected";
                                                            } ?>>5 Bulan</option>
                                        <option value="6" <?php if ($row['lama'] == 6) {
                                                                echo "selected";
                                                            } ?>>6 Bulan</option>
                                        <option value="7" <?php if ($row['lama'] == 7) {
                                                                echo "selected";
                                                            } ?>>7 Bulan</option>
                                        <option value="8" <?php if ($row['lama'] == 8) {
                                                                echo "selected";
                                                            } ?>>8 Bulan</option>
                                        <option value="9" <?php if ($row['lama'] == 9) {
                                                                echo "selected";
                                                            } ?>>9 Bulan</option>
                                        <option value="10" <?php if ($row['lama'] == 10) {
                                                                echo "selected";
                                                            } ?>>10 Bulan</option>
                                        <option value="11" <?php if ($row['lama'] == 11) {
                                                                echo "selected";
                                                            } ?>>11 Bulan</option>
                                        <option value="12" <?php if ($row['lama'] == 12) {
                                                                echo "selected";
                                                            } ?>>12 Bulan</option>


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><button class="btn btn-primary btn-block text-uppercase fw-bold" type="submit" name="submit">Update Penghuni</button></div>
                        </div>
                    </form>
                    <!-- Content Row 1 -->

                    <div class="row">
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'layout/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php
session_start();
include '../functions.php';
if (!isset($_SESSION["masuk"])) {
    header("location: masuk.php");
    exit;
}
$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
// var_dump($nama);
// die;
$resuly = "SELECT * FROM pembayaran p inner join penghuni h on h.idkamar = p.idkamar inner join kamar k on k.idkamar=h.idkamar inner join status s on s.idstatus=p.idstatus WHERE h.idkamar = $nama ";
// $resuly = "SELECT * FROM penghuni WHERE idkamar = $nama ";
$resuly2= "SELECT * FROM user_admin where email = '$email' ";
// $resuly = "SELECT * FROM penghuni p join pembayaran k on k.idkamar=p.idkamar where ";
$a = mysqli_query($conn, $resuly);
$a2 = mysqli_query($conn, $resuly2);
$r = mysqli_fetch_assoc($a);
$r2 = mysqli_fetch_assoc($a2);

if($r['idstatus'] == 4){
    header("location: belum.php");
    exit;
} else if($r['idstatus'] == 5){
    header("location: tenggat.php");
    exit;
}else if ( date("d-m-Y") === date('d-m-Y', strtotime('+'.$r['lama'].'month',strtotime($r['masuk']))) ) {
    $sql = "UPDATE pembayaran SET 
    idstatus = 5
    Where nama = '$nama'
    ";
    $resuly3 = mysqli_query($conn, $sql);
} 
$nama = $_SESSION['email'];
// var_dump($nama);
// die;
$resuly = "SELECT * FROM user_admin WHERE email = '$nama'";
// $resuly = "SELECT * FROM penghuni p join pembayaran k on k.idkamar=p.idkamar where ";
$a = mysqli_query($conn, $resuly);
$phn = mysqli_fetch_assoc($a);
if (isset($_POST["submit"])) {
    if (ubahLogin($_POST) > 0) {
        echo "<script>
        alert('Berhasil Upadate data!!');
        location.href = 'index.php';
        </script>";
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
                        <h1 class="h3 mb-0 text-gray-800 fw-bold">Profile User</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row 1 -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $phn['iduser']; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $phn['foto']; ?>">
                        <div class="row mb-5 pb-5">
                            <div class="col-md-12 mb-3">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="nama" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= $phn["nama"]; ?>" />
                                    <label for="inputFirstName">Nama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" readonly name="" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $phn["email"]; ?>" />
                                    <label for="inputLastName">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" readonly name="email" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $phn["level"]; ?>" />
                                    <label for="inputLastName">Level</label>
                                </div>
                            </div>
                            <label for="inputLastName">Foto Profile</label>
                            <div class="col-md-12 mt-3">
                                <img class="mb-2" src="../img/<?= $phn['foto']; ?>" alt="foto profile" width="100px">
                                <div class="input-group">
                                    
                                    <input class="form-control" name="gambar" id="inputLastName" type="file" placeholder="Enter your last name" >
                                </div>
                                
                            </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><button class="btn btn-primary btn-block text-uppercase fw-bold" type="submit" name="submit">Update Data</button></div>
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
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
// $resuly = "SELECT * FROM pembayaran p inner join penghuni h on h.idkamar = p.idkamar inner join kamar k on p.idkamar=k.idkamar inner join status s on s.idstatus=p.idstatus WHERE h.sandi = '$nama' ";
$resuly = "SELECT * FROM penghuni p INNER JOIN pembayaran b ON p.idkamar = b.idkamar INNER JOIN status s ON b.idstatus = s.idstatus INNER JOIN kamar k ON p.idkamar = k.idkamar WHERE p.idkamar = '$nama'";
// $resuly = "SELECT * FROM penghuni p inner join kamar k on p.idkamar=k.idkamar INNER JOIN status s ON p.idstatus=s.idstatus WHERE p.sandi = '$nama' ";
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
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 fw-bold">Dashboard</h1>
                        <a href="../admin/invoice_bayar.php?id=<?= $r['idpenghuni']; ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print Invoice</a>
                    </div>

                    <!-- Content Row 1 -->
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nomer Kamar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= "Nomer Kamar ". $r['nokamar'] ; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-door-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Password Wifi
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $r['passwordwifi']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wifi fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Status Pembayaran
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $r['status']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar "></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Lama Waktu Tinggal
                                            </div>

                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $r['lama']. " Bulan"; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-stopwatch-20 fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar "></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 5 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Kunci Kamar
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $r['sandi']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-key fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar "></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 6 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Tarif Pembayaran
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= "Rp " .$r['tarif']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar "></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 7 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Tanggal Masuk Sewa
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= date("d-m-Y", strtotime($r['masuk'])); ?>
                                           
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar "></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card 8 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Tanggal Akhir Sewa
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= date('d-m-Y', strtotime('+'.$r['lama'].'month',strtotime($r['masuk']))); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                            <!-- <i class="fas fa-calendar "></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->


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
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto"> -->
                    <!-- <div class="copyright text-start my-auto">
                        <span>Copyright &copy; Ahmad Fahmy XI-RPA  2022 - <?= date('Y'); ?></span>
                    </div> -->
                    <?php include 'layout/footer.php'; ?>
                <!-- </div>
            </footer> -->
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
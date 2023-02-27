<?php
session_start();
include '../functions.php';
if (!isset($_SESSION["admin"])) {
    header("location: ../index.php");
    exit;
}
// Ambil data yang berad di URL
$id = $_GET["id"];
// var_dump($id);
// die;
// Query dat mahasiswa
$phn = query("SELECT * FROM kamar WHERE idkamar = $id")[0];
$result = mysqli_query($conn, "SELECT * FROM kamar k JOIN status s ON s.idstatus = k.idstatus");
$row = mysqli_fetch_assoc($result);
$result2 = mysqli_query($conn, "SELECT * FROM status WHERE idstatus = 1 OR idstatus = 2");

//membuat insert 
if (isset($_POST["submit"])) {
    if ($phn['idkamar'] == $_POST['kamar']) {
        if (ubah_kamar($_POST) > 0) {
            echo "<script>
        alert('Berhasil Upadate data!!');
        location.href = 'kamar.php';
        </script>";
        } else {
            echo "<script>
            alert('Gagal Upadate data!!');
            location.href = 'kamar.php';
            </script>";
        }
    } else {
        if (ubah_kamar($_POST) > 0) {
            echo "<script>
        alert('Berhasil Upadate data!!');
        location.href = 'kamar.php';
        </script>";
        } else {
            echo "<script>
            alert('Gagal Upadate data!!');
            location.href = 'kamar.php';
            </script>";
        }
    }
}


// $result1 = mysqli_query($conn, "SELECT * FROM status ");

// $result2 = mysqli_query($conn, "");
?>
<?php include "../assets/head.php" ?>

<body class="sb-nav-fixed" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">RDC KOST </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form> -->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['email']; ?> <i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney"></i></div>
                            Halaman Utama
                        </a>
                        <!-- <a class="nav-link" href="tambah.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                            Tambah Anggota
                        </a> -->
                        <a class="nav-link" href="kamar.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-building-user"></i></div>
                            Data Kamar
                        </a>
                        <a class="nav-link" href="penghuni.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Penghuni
                        </a>
                        <a class="nav-link" href="tagihan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                            Data Tagihan
                        </a>
                        <a class="nav-link" href="lunas.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-1"></i></div>
                            Pembayaran Lunas
                        </a>

                        <!-- <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->
                        <div class="sb-sidenav-menu-heading"></div>
                        <!-- <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a> -->
                        <!-- <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> -->
                <?php include "account.php"; ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"></i> Ubah Data Kamar</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"> Halaman Mengubah Data Kamar</li>
                    </ol>
                    <div class="row">
                        <!-- <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div> -->
                        <div class="col-xl-3">
                            <div class=" mb-2">
                                <!-- <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Tambah Kamar
                                </div> -->
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Tambah Kamar
                                    </button> -->

                                    <!-- Modal -->
                                    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jumlah Kamar</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Akhir Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Penghuni Kost
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $phn['idkamar']; ?>">
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="nomerkamar" id="inputFirstName" type="number" placeholder="Enter your first name" value="<?= $phn["nokamar"]; ?>" />
                                            <label for="inputFirstName">Nomer Kamar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="deskripsi" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= $phn["deskripsi"]; ?>" />
                                            <label for="inputFirstName">Deskripsi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" name="tarif" id="inputLastName" type="number" placeholder="Enter your last name" value="<?= $phn["tarif"]; ?>" />
                                            <label for="inputLastName">Tarif Kamar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control" name="wifi" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $phn["passwordwifi"]; ?>" />
                                            <label for="inputLastName">Pasword Wifi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="justofy-content-center"> <select class="form-select text-center" name="status">

                                                <?php while ($r = mysqli_fetch_assoc($result2)) : ?>
                                                    <option value="<?= $r['idstatus']; ?>" <?php if ($phn['idstatus'] == $r['idstatus']) {
                                                                                                echo "selected";
                                                                                            } ?>><?= $r['status']; ?></option>
                                                <?php endwhile; ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid"><button class="btn btn-primary btn-block text-uppercase fw-bold" type="submit" name="submit">Update kamar</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted fs-6">Copyright &copy; Ahmad fahmy 2022- <?= date('Y'); ?></div>
                        <div class="text-muted fw-bold fs-6"><span id="jam"></span></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php include '../assets/scriptjs.php' ?>
    <script type="text/javascript">
        function tampilkanwaktu() {
            var waktu = new Date();
            var sd = waktu.getDate() + "";
            var st = waktu.getDay() + "";
            var sh = waktu.getHours() + "";
            var sm = waktu.getMinutes() + "";
            var ss = waktu.getSeconds() + "";
            document.getElementById("jam").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }
    </script>
</body>

</html>
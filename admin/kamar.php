<?php
session_start();
include "../functions.php";
if (!isset($_SESSION["admin"])) {
    header("location: ../index.php");
    exit;
}

//Tambah Kamar
if (isset($_POST['submit'])) {
    if (kamar($_POST) > 0) {
        echo "<script>
        alert('Kamar berhasil di input');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}

// $result = mysqli_query($conn, "SELECT * FROM penghuni ");
// $result2 = mysqli_query($conn, "SELECT * FROM kamar");
$result2 = mysqli_query($conn, "SELECT * FROM kamar k INNER JOIN status s ON s.idstatus = k.idstatus ORDER BY k.nokamar ASC");
// $result = mysqli_query($conn, "SELECT * FROM status");
// $result3 = mysqli_query($conn, "SELECT * FROM tagihan");
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard RDC KOST KANEEZ</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head> -->
<?php include "../assets/head.php"; ?>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">RDC KOST KANEEZ</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['email'] ; ?> <i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link active" href="kamar.php">
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
                <?php include 'account.php'; ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fa-solid fa-building-user"></i> Data Kamar</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="index.php">Halaman Utama</a> / Data Kamar</li>
                    </ol>
                    <div class="row">
                        <!-- <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-building-user"></i> </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="kamar.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-user"></i> </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="penghuni.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-face-smile"></i> <</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="lunas">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-face-frown"></i> </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="tagihan.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
                                <i class="fa-solid fa-folder-plus"></i>
                                Tambah kamar |
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Tambah Kamar
                                </button>
                                <!-- Akhir Button Trigger Modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kamar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">
                                                    

                                                    <div class="form-floating mb-3 ">
                                                        <input class="form-control" name="kamar" id="kamar" type="number" placeholder="Enter your first name" />
                                                        <label for="kamar">No. Kamar</label>
                                                    </div>
                                                    <div class="form-floating mb-3 ">
                                                        <textarea class="form-control" name="deskripsi" id="fasilitas" type="text" placeholder="Enter your first name"></textarea>
                                                         <label for="fasilitas">Deskripsi</label>
                                                        <!-- <select class="form-select" name="status" aria-label="Default select example">
                                                            <?php foreach($result as $rrr) : ?>
                                                            <option value="<?= $rrr['idstatus']; ?>"><?= $rrr['status']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select> -->
                                                    </div>
                                                    <div class="form-floating mb-3 ">
                                                        <input class="form-control" name="tarif" id="tarif" type="text" placeholder="Enter your first name" />
                                                        <label for="tarif">Tarif</label>
                                                    </div>
                                                    <div class="form-floating mb-3 ">
                                                        <input class="form-control" name="wifi" id="tarif" type="text" placeholder="Enter your first name" />
                                                        <label for="tarif">Password Wifi</label>
                                                    </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Tambah Kamar</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal -->
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kamar</th>
                                            <th>Tarif</th>
                                            <!-- <th>Kapasitas</th> -->
                                            <th>Fasilitas</th> 
                                            <th>Status</th>
                                            <!-- <th>Tanggal Masuk</th>
                                        <th>Ktp</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['nokamar']; ?></td>
                                                <td><?= "Rp ". $row['tarif']; ?></td>
                                                <td><?=  $row['deskripsi'] ; ?></td>
                                                <td><?=  $row['status'] ; ?></td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="editkamar1.php?id=<?= $row['idkamar']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a class="btn btn-danger btn-sm" href="delete_kamar.php?id=<?= $row['idkamar']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus kamar <?= $row['nokamar']; ?>');"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script> -->
    <?php include "../assets/scriptjs.php"; ?>
</body>

</html>
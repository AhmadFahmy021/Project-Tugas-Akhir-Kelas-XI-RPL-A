<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: ../login.php");
    exit;
}
include "../functions.php";

// $result = mysqli_query($conn, "SELECT * FROM sewa s INNER JOIN kamar k ON s.idkamar=k.idkamar INNER JOIN pembayaran h ON s.idpembayaran = h.idpembayaran INNER JOIN penghuni p ON s.idpenghuni = p.idpenghuni");
$result = mysqli_query($conn, "SELECT * FROM penghuni p INNER JOIN kamar k ON p.idkamar=k.idkamar INNER JOIN pembayaran h ON h.idkamar = p.idkamar");
// $row = mysqli_fetch_assoc($result);

$result2 = mysqli_query($conn, "SELECT * FROM kamar  where idstatus=2");
// $row2 = mysqli_query($conn, $result2);
if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
        alert('Berhasil menambahkan data');
        location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menambahkan data');
        location.href = 'index.php';
        </script>";
    }
}

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
<?php include "../assets/head.php" ?>

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
                        <a class="nav-link active" href="penghuni.php">
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
                        <div class="sb-sidenav-menu-heading"></div>
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
                    <h1 class="mt-4">Data Penghuni</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="index.php">Halman Utama</a> / Data penghuni</li>
                    </ol>
                    <!-- <div class="row">
                        <div class="col-xl-3 col-md-6">
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
                                <div class="card-body fw-bold"><i class="fa-solid fa-face-smile"></i> </div>
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
                            <div class="mb-2">

                                <div class="card-body">
                                    <!-- Button trigger modal -->


                                    <!-- Modal -->

                                    <!-- Akhir Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Penghuni Kost |
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Penghuni
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <a href="cetak.php" target="_blank" class="btn btn-success mb-3 d-sm-inline-block"><i class="fa-sharp fa-solid fa-download"></i> Cetak Data Penghuni</a>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Kamar</th>
                                        <th>Kampus</th>
                                        <th>No Hp</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Ktp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result) ) : 
                                                                         
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['namapenghuni']; ?></td>
                                            <td><?= $row['nokamar']; ?></td>
                                            <td><?= $row['kampus']; ?></td>
                                            <td><?= $row['telepon']; ?></td>
                                            <td><?= date('l, d-m-Y', strtotime($row['masuk'])); ?></td>
                                            <td><?= date('l, d-m-Y', strtotime('+'.$row['lama'].'month',strtotime($row['masuk']))); ?></td>
                                            <!-- <td><?= $row['lama'] ?></td> -->
                                            <td>
                                                <!-- Button trigger modal -->

                                                <img src=" ../img/<?= $row['foto'] ?>" width="50">


                                            </td>
                                            <td>
                                                <div class="d-grid">
                                                    <a class="btn btn-primary btn-sm mb-2" href="tambah.php?id=<?= $row["idpenghuni"]; ?> "><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row["idpenghuni"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $row['namapenghuni']; ?>');"><i class="fa-solid fa-trash-can"></i></a>
                                                </div>
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
    <!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penghuni</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mb-1">

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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11x</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mt-3 mb-md-0">
                                        <?php
                                                function getRandom($length){
       
                                                    $str = 'abcdefghijklmnopqrstuvwzyz';
                                                    $str1= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                    // $str2= '0123456789';
                                                    $shuffled = str_shuffle($str);
                                                    $shuffled1 = str_shuffle($str1);
                                                    // $shuffled2 = str_shuffle($str2);
                                                    $total = $shuffled.$shuffled1;
                                                    $shuffled3 = str_shuffle($total);
                                                    $result= substr($shuffled3, 0, $length);
                                            
                                                    return $result;
                                            
                                                }
                                            
                                                // $str =  getRandom(8);


                                        ?>
                                        <input class="form-control" name="sandi" readonly  id="inputPassword" type="text" placeholder="Tanggal Masuk" value="<?= getRandom(8); ?>" />
                                        <label for="inputPassword">Kunci Kamar</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select class="form-select" name="kamar" aria-label="Default select example">
                                            <option selected class="text-center "> -- Pilih Kamar -- </option>
                                            <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                                                <option value="<?= $row['idkamar']; ?>"><?= "Kamar Nomer " . $row['nokamar'], "  Tarif " . $row['tarif']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-0">
                                <div class="d-grid"><button class="btn btn-primary btn-block" type="submit" name="submit">Daftar Penghuni</button></div>
                            </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script> -->
    <?php include "../assets/scriptjs.php" ?>
</body>

</html>
<?php
// session_start();
// include '../functions.php';
// if (!isset($_SESSION["login"])) {
//     header("location: ../index.php");
//     exit;
// }

// //membuat insert 
// if (isset($_POST["submit"])) {
//     if (tambah($_POST) > 0) {
//         echo "<script>
//         alert('Berhasil menambahkan data');
//         location.href = 'index.php';
//         </script>";
//     } else {
//         echo "<script>
//         alert('Gagal menambahkan data');
//         location.href = 'index.php';
//         </script>";
//     }
// }
session_start();
include '../functions.php';
if (!isset($_SESSION["admin"])) {
    header("location: ../login.php");
    exit;
}
// Ambil data yang berad di URL
$id = $_GET["id"];
// Query dat mahasiswa
$phn = query("SELECT * FROM penghuni WHERE idpenghuni = $id")[0];

//membuat insert 
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
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
        header('location: penghuni.php');
        exit;
    }
}

// $result = mysqli_query($conn, "SELECT * FROM kamar");
$result = mysqli_query($conn, "SELECT * FROM kamar");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    

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
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
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
                        <a class="nav-link" href="tambah.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                            Tambah Anggota
                        </a>
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

                        
                        <div class="sb-sidenav-menu-heading"></div>
                        
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
                    <!-- <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card mx-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Tambah Anggota</h3>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div> -->
                    <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fa-solid fa-house-chimney"></i> Tambah Penghuni</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"> <a href="index.php">Halaman Utama</a> / Tambah Penghuni</li>
                    </ol>
                    <div class="row">
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
                                        <label for="inputEmail" class="mb-2">Foto KTP</label> 
                                        <div class="mb-4">
                                            <img src="../img/<?= $phn["foto"]; ?>" width="100px" alt="penghuni">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control" name="gambar" id="inputEmail" type="file" placeholder="KTP">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="masuk" id="inputPassword" type="date" placeholder="Tanggal Masuk" value="<?= $phn['masuk']; ?>">
                                                    <label for="inputPassword">Tanggal Masuk</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <select class="form-select" name="kamar" aria-label="Default select example">
                                                        <?php 
                                                        $sql = "SELECT * FROM"
                                                        ?>
                                                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                            <!-- <option value="<?= $row['idkamar']; ?>" <?php if($phn['idkamar'] == $row['nokamar']) { echo "selected";} ?>><?= "Kamar Nomer " . $row['nokamar']; ?></option> -->
                                                            <option value="<?= $row['idkamar']; ?>" <?php if($phn['idkamar'] == $row['idkamar']) { echo "selected";} ?>><?= "Kamar Nomer " . $row['nokamar']; ?></option>
                                                            
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button class="btn btn-primary btn-block text-uppercase fw-bold" type="submit" name="submit">Update Penghuni</button></div>
                                        </div>
                                    </form>
                        <div class="col-xl-3">
                            <div class=" mb-2">
                            </div>
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
    
    <!-- <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fa-solid fa-house-chimney"></i> Tambah Penghuni</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"> <a href="index.php">Halaman Utama</a> / Tambah Penghuni</li>
                    </ol>
                    <div class="row">
                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="row mb-2">
                                            
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input class="form-control" name="nama" id="inputLastName" type="text" placeholder="Enter your last name" autofocus />
                                                    <label for="inputLastName">Nama Lengkap</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-floating mt-2 col">
                                                    <textarea class="form-control" name="alamat" id="inputLastName" type="text" placeholder="Enter your last name" ></textarea>
                                                    <label for="inputLastName">Alamat Asal</label>
                                                </div>
                                            
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-floating mt-2 col">
                                                    <input class="form-control" name="kota" id="inputLastName" type="text" placeholder="Enter your last name" >
                                                    <label for="inputLastName">Kota Asal</label>
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="hp" id="inputFirstName" type="text" placeholder="Enter your first name" />
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
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="masuk" id="inputPassword" type="date" placeholder="Tanggal Masuk" />
                                                    <label for="inputPassword">Tanggal Masuk</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <select class="form-select" name="kamar" aria-label="Default select example">
                                                        <option selected>   -- Pilih Kamar -- </option>
                                                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                                                        <option value="<?= $row['idkamar']; ?>"><?= "Kamar Nomer ". $row['nokamar']; ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button class="btn btn-primary btn-block" type="submit" name="submit">Create Account</button></div>
                                        </div>
                                    </form>
                        <div class="col-xl-3">
                            <div class=" mb-2">
                            </div>
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
        </div> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script> -->
    <?php include "../assets/scriptjs.php" ?>
</body>

</html>
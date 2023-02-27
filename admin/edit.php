<?php
session_start();
include '../functions.php';
if (!isset($_SESSION["admin"])) {
    header("location: ../indexphp");
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
        echo "<script>
        alert('Gagal Upadate data!!');
        location.href = 'index.php';
        </script>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM kamar");
// $result2 = mysqli_query($conn, "");
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head> -->
<?php include "../assets/head.php" ?>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Update Data Anggota</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $phn['idpenghuni']; ?>">
                                        <input type="hidden" name="gambarLama" value="<?= $phn['foto']; ?>">
                                        <div class="row mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="nama" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= $phn["nama"]; ?>" />
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
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Ahmad Fahmy 2022</div>
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
    <script src="js/scripts.js"></script> -->
    <?php include "../assets/scriptjs.php" ?>
</body>

</html>
<?php
session_start();
include '../functions.php';
if (!isset($_SESSION['user'])) {
    header('location: ../index.php');
}
$result = mysqli_query($conn, "SELECT * FROM kamar ");

if (isset($_POST["submit"])) {

    $id = $_POST['nomer'];
    $kunci = $_POST['kunci'];

    // $sql = "SELECT * FROM penghuni WHERE sandi = '$kunci'";
    $sql = "SELECT * FROM penghuni WHERE idkamar = $id ";
    $result2 = mysqli_query($conn, $sql);
    $r = mysqli_fetch_assoc($result2);
    // var_dump($id);
    // var_dump($kunci);
    // var_dump($sql);
    // die;
    // if(mysqli_num_rows(($result2)) === 1 ){
    if($a = mysqli_num_rows(($result2)) > 0  && $kunci === $r['sandi']){
        $_SESSION['idpenghuni'] = $r['idpenghuni'];
        $_SESSION['nama'] = $id;
        $_SESSION['masuk'] = true;
    //     var_dump($a);
    // var_dump($kunci);
    // die;
        header('location: index.php');
        exit;
    }else{
        $error = true;
    }
    
    // var_dump($a);
    // var_dump($kunci);
    // die;
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
                    Memasukkan Kunci Kamar
                </div>
                <div class="card-body mb-3">
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            Gagal Masuk
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <div class=" mt-2">
                                    <!-- <input class="form-control" name="nama" id="inputLastName" type="text" placeholder="Enter your last name">
                                    <label for="inputLastName">Masukkan Nomer Kamar</label> -->
                                    <select name="nomer" class="form-select" aria-label="Default select example">
                                        <option value="0" selected class="text-center"> -- PILIH NOMER KAMAR -- </option>
                                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                            <option value="<?= $row['idkamar']; ?>"><?= "Kamar Nomer " . $row['nokamar']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-floating mt-2 col">
                                    <input class="form-control" name="kunci" id="inputLastName" type="password" placeholder="Enter your last name">
                                    <label for="inputLastName">Masukkan Kunci Kamar</label>
                                </div>

                            </div>
                        </div>
                        <!-- <div class="mt-4 mb-0">
                                <button>Submit</button>
                            </div> -->
                        <div class="mt-4 mb-0">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit" name="submit">Masuk</button>
                                <a href="daftar.php" class="btn btn-success mt-3 text-center">Daftar Penghuni</a>
                                <hr>
                                <!-- <a href="../logout.php" class="btn btn-danger mt-3 justify-content-end">Logout</a> -->
                            </div>
                        </div>
                        <a href="../logout.php" class="btn btn-danger col-md-4 mt-3 ">Logout</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
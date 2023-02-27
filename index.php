<?php
session_start();
include 'functions.php';
if (isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
} else if (isset($_SESSION["user"])) {
    header('Location: index.php');
    exit;
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $sandi = $_POST['sandi'];

    $query = "SELECT * FROM user_admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    

    if (mysqli_num_rows($result) > 0 && password_verify($sandi, $row['sandi'])) {
        // $level = $row['sandi'];
        $level = $row['level'];
        // var_dump($level1);
        // die;
        if ($level == "admin") {
            // var_dump($level);
            // die;
            $_SESSION['email'] = $email;
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['admin'] = true;
            header('location: admin/index.php');
        } else if ($level == "user") {
            // var_dump($level);
            // die;
            $_SESSION['email'] = $email;
            $_SESSION['user'] = true;
            header('location: user/masuk.php');
        } else {
            $error = true;
        }
    }
    $error = true;

}





// session_start();
// include 'functions.php';
// if (isset($_POST['login'])) {
//     $user = $_POST['email'];
//     $sandi = $_POST['sandi'];

//     $sql = "SELECT * FROM user_admin WHERE email = '$user'";
//     $result = mysqli_query($conn, $sql);
//     $r = mysqli_fetch_assoc($result);

//     if (mysqli_num_rows($result) === 1 && password_verify($sandi, $r['sandi'])) {
//         $levelNew  = $r['level'];
//         if ($levelNew === "admin") {
//             $_SESSION['username'] = $user;
//             $_SESSION['admin'] = true;
//             header('location: admin/index.php');
//         } else if ($levelNew === "user") {
//             $_SESSION['username'] = $user;
//             $_SESSION['user'] = true;
//             header('location: user/index.php');
//         } else {
//             $error = true;
//         }
//     }
// }



// session_start();
// include "functions.php";
// if (isset($_COOKIE['login']) && isset($_COOKIE['id'])) {
//     $id = $_COOKIE['user'];
//     $key = $_COOKIE['key'];

//     $result = mysqli_query($conn, "SELECT email FROM user_admin WHERE id_admin = '$id'");
//     $row = mysqli_fetch_assoc($result);
//     // $result2 = mysqli_query($conn, "SELECT * FROM user_admin");
//     // $row2 = mysqli_fetch_assoc($result2);
//     $_SESSION["user1"] = $row2["first_name"];

//     //cek cookie dan username
//     if ($key === hash('sha256',$row['email']) ) {
//         $_SESSION['login'] = true;
//     }
// }

// if (isset($_SESSION["admin"]) ) {
//     header("Location: index.php");
//     exit;
// }
// if (isset($_POST["login"])) {
//     $email = $_POST["email"];
//     $sandi = $_POST["sandi"];

//     $result = mysqli_query($conn, "SELECT * FROM user_admin where email = '$email'");
//     $result1 = mysqli_query($conn, "SELECT * FROM user_admin ");



//     //cek email
//     if ($cek = mysqli_num_rows($result) === 1) {

//     // if ($cek > 0){
//     //     $data = mysqli_fetch_assoc($result1);

//     //     if($data['role'] === 'admin'){
//     //         // $_SESSION["login"] = true;
//     //         // $_SESSION['role'] = "admin";

//     //         // header("location : ../admin/index.php");
//     //         echo "
//     //             <script>
//     //                 location.href = 'admin/index.php';
//     //             </script>
//     //         ";

//     //     } else if($data['role'] === 'user'){
//     //         // $_SESSION["login"] = true;
//     //         // $_SESSION['role'] = "user";

//     //         // header("location : ../user/index.php");
//     //         echo "
//     //             <script>
//     //                 location.href = 'admin/index.php';
//     //             </script>
//     //         ";
//     //     } 
//     // } 
//         //cek sandi 
//         $row = mysqli_fetch_assoc($result);
//        if (password_verify($sandi,$row['sandi'])) {

//         // set session
//         $_SESSION["admin"] = true;
//         // $row1 = mysqli_fetch_assoc($result1);
//         // if($row1['level'] == "admin"){
//         //     $_SESSION["admin"] = true;
//         //     header("location: admin/index.php");

//         // } else if($row1['level'] == "user") {
//         //     $_SESSION["user"] = true;
//         //     echo "
//         //         <script>
//         //             alert('Berhasil  Login');
//         //             location.href = 'user/indexx.php';
//         //         </script>
//         //     ";
//         // }

//         //Check Remember me
//         if (isset($_POST["remember"])) {
//             //Buat set cookie
//             setcookie('user', $row["id_admin"], time() + 3600);
//             setcookie('key', hash('sha256',$row["email"], time() + 3600 ));
//         }
//         // $row = mysqli_fetch_array($result);
//         // $role  = $row['role'];
//         // if($role === 'admin'){
//         //     header("location: admin/index.php");
//         //     exit();
//         //    } else {
//         //     header("location: user/index.php");
//         //     exit();
//         //    }

//         header("location: admin/index.php");
//         exit;

//        } 

//     }
//     $error = true;
// }

//Membuat session dan menghubungkan koneksi
// session_start();
// include 'functions.php';

//melakukan penangkapan data yang dikirim kan oleh user 
// if (isset($_POST['login'])) {
//     $email = $_POST["email"];
//     $sandi = $_POST["sandi"];

//     $sql = mysqli_query($conn, "SELECT * FROM user_admin where email = '$email'");
//     $row = mysqli_fetch_assoc($sql);
//     $row1 = mysqli_num_rows($sql);

//     if (password_verify($sandi,$row['sandi'] )) {
//         if ($row1 > 0) {

//             if ($row['role'] == "admin") {
//                 // $_SESSION['nama'] =  $data['nama_lengkap'];
// 		        $_SESSION['role'] = "admin";
//                 header("location: admin/index.php");
//             } else if ($data['role']=="user") {
//                 $_SESSION['role'] = "user";
//                 header("location: user/index.php");
//             } 
//         }
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login RDC Kost Kaneez</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <?php if (isset($error)) : ?>
                                            <!-- <p style="color: red; font-style: italic;">Username dan Password Salah</p> -->
                                            <div class="alert alert-danger" role="alert">
                                                Login Gagal | Login Failed
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="inputEmail" type="text" placeholder="Inputkan Email dan Username" autocomplete="OFF" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="sandi" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <!-- <div class="form-check mb-3">
                                                <input class="form-check-input" name="remember" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Me</label>
                                            </div> -->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <!-- <a class="small" href="password.php">Forgot Password?</a> -->
                                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
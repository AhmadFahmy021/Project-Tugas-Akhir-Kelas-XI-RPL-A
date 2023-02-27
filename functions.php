<?php 
$conn = mysqli_connect("localhost","root","","project");
// if ($con) {
//     echo "konkesi Berhasil";
// }
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function register($tambah){
    global $conn;

    $nama = $tambah["nama"];
    
    $email = stripslashes($tambah["email"]);
    $sandi = mysqli_real_escape_string($conn,$tambah["sandi"]);
    $sandi2 = mysqli_real_escape_string($conn,$tambah["sandi2"]);
    $gambar = 'user.png';
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }

    //Cek jika email telah terdaftar 
    $query = "SELECT email FROM user_admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Email telah terdaftar!!');
        </script>";
        return false;
    }

    //cek password dan confirmasi password telah sama

    if ($sandi2 !== $sandi) {
        echo "<script>
        alert('Konfirmasi pasword tidak sesuai !!!');
        </script>";
        return false;
    }

    //enkripsi password
    $sandi = password_hash($sandi, PASSWORD_DEFAULT);

    //tambahkan user ke database
    $query = "INSERT INTO user_admin (nama, email, sandi, foto) VALUES ('$nama','$email','$sandi', '$gambar')";
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
function upload(){

    $namafile = $_FILES["gambar"]["name"];
    $ukuranfile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    //cek file ada gambar atau tidak
    if ($error === 4) {
        echo "<script>
        alert('TIdak Ada gambar yang di Upload');
        </script>";
        return false;
    }

    //cek jenis gambar
    $ekstensireal = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.',$namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if ( !in_array($ekstensigambar, $ekstensireal) ) {
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar');
        </script>";
        return false;
    }

    //cek jika ukuran nya besar
    if ($ukuranfile > 3000000) {
        echo "<script>
        alert('Gambar Lebih dari 2 MB');
        </script>";
        return false;
    }

    //lolos pengecekan
    //generete nama baru

    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar; 
    move_uploaded_file($tmpName, '../img/'. $namafilebaru);

    return $namafilebaru;
}
function tambah($data){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kota = htmlspecialchars($data["kota"]);
    $hp = htmlspecialchars($data["hp"]);
    $kampus = htmlspecialchars($data["kampus"]);
    $masuk = htmlspecialchars($data["masuk"]);
    $kamar = htmlspecialchars($data["kamar"]);
    $batas = htmlspecialchars($data["batas"]);
    $sandi = $data["sandi"];
    $wa = $data["wa"];
    // $batas = $batas * 30;
     $gambar = upload();
    if (!$gambar) {
        return false;
    }
    // $gambar = htmlspecialchars($data['gambar']);

    if ($nama === "") {
        echo "
            <script>
                alert('Nama Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($alamat === "") {
        echo "
            <script>
                alert('Alamat Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($kota === "") {
        echo "
            <script>
                alert('Kota Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($hp === "") {
        echo "
            <script>
                alert('Telepon Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($kampus === "") {
        echo "
            <script>
                alert('Universitas Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($masuk === "") {
        echo "
            <script>
                alert('Masuk Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($kamar === "") {
        echo "
            <script>
                alert('Kamar Wajib Di Isi !!!');
            </script>
        ";
        return false;
    } elseif ($gambar === "") {
        echo "
            <script>
                alert('Gambar Wajib Di Isi !!!');
            </script>
        ";
        return false;
    }
    // $sandi1 = password_hash($sandi, PASSWORD_DEFAULT);
    $query = "INSERT INTO penghuni (namapenghuni, alamat, kota, telepon, kampus, foto, masuk, idkamar, sandi) 
    VALUES 
    ('$nama', '$alamat', '$kota', '$hp', '$kampus', '$gambar', '$masuk', '$kamar', '$sandi')
    ";
    mysqli_query($conn, $query);

    $sql = "UPDATE kamar SET
    idstatus = 1
    WHERE idkamar = $kamar
    ";
    mysqli_query($conn, $sql);


    // $sql1 = "INSERT INTO tagihan(nama, kamar, lama, telepon, masuk ) Values
    //          ( '$nama', '$kamar', '$batas', '$hp', '$masuk')
    // ";
    $sql2 = "INSERT INTO pembayaran (nama, telepon, masuk, idkamar, lama,idstatus) Values
             ( '$nama', '$hp','$masuk','$kamar', '$batas',   4)
    ";
    // mysqli_query($conn,$sql1);
    mysqli_query($conn,$sql2);

    
    // str_replace("target=_blank', href=' https://api.whatsapp.com/send?phone=$wa&text=Nama:%20$nama%20%0DAlamat:%20$alamat%20%0DKota:%20$kota'");
    // header("location: https://api.whatsapp.com/send?phone=$wa&text=Nama:%20$nama%20%0DAlamat:%20$alamat%20%0DKota:%20$kota");
    return mysqli_affected_rows($conn);
    // //Upload Gambar
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }

    // $query = "INSERT INTO penghuni (nama,alamat, kota,telepon,kampus,foto,masuk,idkamar) VALUES ('$nama','$alamat','$kota','$hp','$kampus','$gambar','$masuk','$kamar')";
    // // var_dump($query);
    // // exit;
    // mysqli_query($conn,$query);

    // return mysqli_affected_rows($conn);

    

}
function kamar($data){
    global $conn;

    
    $nokamar = $data['kamar'];
    $deskripsi= $data['deskripsi'];
    $tarif = $data['tarif'];
    $wifi = $data['wifi'];
    // $status = $data['status'];

    $query = "INSERT INTO kamar (nokamar,deskripsi,tarif,passwordwifi) VALUES ('$nokamar','$deskripsi','$tarif', '$wifi')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;


    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kota = htmlspecialchars($data["kota"]);
    $hp = htmlspecialchars($data["hp"]);
    $kampus = htmlspecialchars($data["kampus"]);
    $masuk = htmlspecialchars($data["masuk"]);
    $kamar = htmlspecialchars($data["kamar"]);
    $lama = htmlspecialchars($data["lama"]);
    $gambarLama = htmlspecialchars($data['gambarLama']);
    $email = htmlspecialchars($data['email']);

    //cek apakah user memilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // if ($nama === "") {
    //     echo "
    //         <script>
    //             alert('Nama Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($alamat === "") {
    //     echo "
    //         <script>
    //             alert('Alamat Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($kota === "") {
    //     echo "
    //         <script>
    //             alert('Kota Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($hp === "") {
    //     echo "
    //         <script>
    //             alert('Telepon Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($kampus === "") {
    //     echo "
    //         <script>
    //             alert('Universitas Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($masuk === "") {
    //     echo "
    //         <script>
    //             alert('Masuk Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } else
    
    // } elseif ($gambar === "") {
    //     echo "
    //         <script>
    //             alert('Gambar Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // }

    $query = "UPDATE penghuni SET
    namapenghuni = '$nama',
    alamat = '$alamat',
    kota = '$kota',
    telepon = '$hp',
    kampus = '$kampus',
    foto = '$gambar',
    masuk = '$masuk',
    idkamar = '$kamar'
    WHERE idpenghuni = $id     
    ";
    $query1 = "UPDATE pembayaran SET
    nama = '$nama',
    telepon = '$hp',
    masuk = '$masuk',
    lama = '$lama',
    idkamar = '$kamar'
    WHERE idpembayaran = $id     
    ";
    // $query3 = "UPDATE user_admin SET
    // nama = '$nama',
    // foto = '$gambar'
    // WHERE iduser = $id     
    // ";
    mysqli_query($conn, $query);
    mysqli_query($conn, $query1);
    // mysqli_query($conn, $query3);
    return mysqli_affected_rows($conn);


}
// function ubahUser($data){
//     global $conn;


//     $id = $data["id"];
//     $nama = htmlspecialchars($data["nama"]);
//     $alamat = htmlspecialchars($data["alamat"]);
//     $kota = htmlspecialchars($data["kota"]);
//     $hp = htmlspecialchars($data["hp"]);
//     $kampus = htmlspecialchars($data["kampus"]);
//     $masuk = htmlspecialchars($data["masuk"]);
//     $kamar = htmlspecialchars($data["kamar"]);
//     $lama = htmlspecialchars($data["lama"]);
//     $gambarLama = htmlspecialchars($data['gambarLama']);
//     $email = htmlspecialchars($data['email']);

//     //cek apakah user memilih gambar baru atau tidak
//     if ($_FILES['gambar']['error'] === 4) {
//         $gambar = $gambarLama;
//     } else {
//         $gambar = upload();
//     }

//     // if ($nama === "") {
//     //     echo "
//     //         <script>
//     //             alert('Nama Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // } elseif ($alamat === "") {
//     //     echo "
//     //         <script>
//     //             alert('Alamat Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // } elseif ($kota === "") {
//     //     echo "
//     //         <script>
//     //             alert('Kota Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // } elseif ($hp === "") {
//     //     echo "
//     //         <script>
//     //             alert('Telepon Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // } elseif ($kampus === "") {
//     //     echo "
//     //         <script>
//     //             alert('Universitas Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // } elseif ($masuk === "") {
//     //     echo "
//     //         <script>
//     //             alert('Masuk Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // } else
    
//     // } elseif ($gambar === "") {
//     //     echo "
//     //         <script>
//     //             alert('Gambar Wajib Di Isi !!!');
//     //         </script>
//     //     ";
//     //     return false;
//     // }

//     $query = "UPDATE penghuni SET
//     namapenghuni = '$nama',
//     alamat = '$alamat',
//     kota = '$kota',
//     telepon = '$hp',
//     kampus = '$kampus',
//     foto = '$gambar',
//     masuk = '$masuk',
//     idkamar = '$kamar'
//     WHERE idpenghuni = $id     
//     ";
//     $query1 = "UPDATE pembayaran SET
//     nama = '$nama',
//     telepon = '$hp',
//     masuk = '$masuk',
//     lama = '$lama',
//     idkamar = '$kamar'
//     WHERE idpembayaran = $id     
//     ";
//     $query3 = "UPDATE user_admin SET
//     nama = '$nama',
//     foto = '$gambar'
//     WHERE iduser = $id     
//     ";
//     mysqli_query($conn, $query);
//     mysqli_query($conn, $query1);
//     mysqli_query($conn, $query3);
//     return mysqli_affected_rows($conn);


// }
function ubahuser($data){
    global $conn;


    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kota = htmlspecialchars($data["kota"]);
    $hp = htmlspecialchars($data["hp"]);
    $kampus = htmlspecialchars($data["kampus"]);
    $masuk = htmlspecialchars($data["masuk"]);
    $kamar = htmlspecialchars($data["kamar"]);
    $lama = htmlspecialchars($data["lama"]);
    $gambarLama = htmlspecialchars($data['gambarLama']);
    // $email = htmlspecialchars($data['email']);

    //cek apakah user memilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // if ($nama === "") {
    //     echo "
    //         <script>
    //             alert('Nama Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($alamat === "") {
    //     echo "
    //         <script>
    //             alert('Alamat Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($kota === "") {
    //     echo "
    //         <script>
    //             alert('Kota Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($hp === "") {
    //     echo "
    //         <script>
    //             alert('Telepon Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($kampus === "") {
    //     echo "
    //         <script>
    //             alert('Universitas Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } elseif ($masuk === "") {
    //     echo "
    //         <script>
    //             alert('Masuk Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // } else
    
    // } elseif ($gambar === "") {
    //     echo "
    //         <script>
    //             alert('Gambar Wajib Di Isi !!!');
    //         </script>
    //     ";
    //     return false;
    // }
    $result = mysqli_query($conn, "SELECT * FROM penghuni WHERE idpenghuni = $id");
    $row = mysqli_fetch_assoc($result);
if($kamar == $row['idkamar']){
    $query = "UPDATE penghuni SET
    namapenghuni = '$nama',
    alamat = '$alamat',
    kota = '$kota',
    telepon = '$hp',
    kampus = '$kampus',
    foto = '$gambar',
    masuk = '$masuk'
    WHERE idpenghuni = $id     
    ";
    $query1 = "UPDATE pembayaran SET
    nama = '$nama',
    telepon = '$hp',
    masuk = '$masuk',
    lama = '$lama'
    WHERE idpembayaran = $id     
    ";
} else {
    $query = "UPDATE penghuni SET
    namapenghuni = '$nama',
    alamat = '$alamat',
    kota = '$kota',
    telepon = '$hp',
    kampus = '$kampus',
    idkamar = $kamar,
    foto = '$gambar',
    masuk = '$masuk'
    WHERE idpenghuni = $id     
    ";
    $query1 = "UPDATE pembayaran SET
    nama = '$nama',
    telepon = '$hp',
    masuk = '$masuk',
    idkamar = $kamar,
    lama = '$lama'
    WHERE idpembayaran = $id     
    ";
}
    // $query3 = "UPDATE user_admin SET
    // nama = '$nama',
    // foto = '$gambar'
    // WHERE iduser = $id     
    // ";
    mysqli_query($conn, $query);
    mysqli_query($conn, $query1);
    // mysqli_query($conn, $query3);
    return mysqli_affected_rows($conn);


}

function ubah_kamar($data){
    global $conn;

    $id = $data['id'];
    $nomer = htmlspecialchars($data["nomerkamar"]);
    $tarif = htmlspecialchars($data["tarif"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $status = htmlspecialchars($data["status"]);
    $wifi = htmlspecialchars($data["wifi"]);
    $result = mysqli_query($conn, "SELECT * FROM kamar WHERE idkamar = $id");
    $row = mysqli_fetch_assoc($result);
// if($status = $row['idstatus']){

//     $query = "UPDATE kamar SET
//     nokamar = $nomer,
//     tarif = $tarif,
//     deskripsi = '$deskripsi',
//     idstatus = $status
//     WHERE idkamar = $id    
//     ";
// }else{
//     $query = "UPDATE kamar SET
//     nokamar = $nomer,
//     tarif = $tarif,
//     deskripsi = '$deskripsi'
//     WHERE idkamar = $id    
//     ";

// }
    $query = "UPDATE kamar SET
    nokamar = $nomer,
    tarif = $tarif,
    deskripsi = '$deskripsi',
    idstatus = $status,
    passwordwifi = '$wifi'
    WHERE idkamar = $id    
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function ubahLogin($data){
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data["nama"]);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //cek apakah user memilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE user_admin SET
    nama = '$nama',
    foto = '$gambar'
    WHERE iduser = $id    
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

 function tagihan($data){
    global $conn;
    $bulan = $data["bulan"];
    $tahun = $data["tahun"];
    $id = $data["id"];
    $kamar = $data["kamar"];
    $tarif = $data["tarif"];

    $query = "INSERT INTO tagihan (bulan,tahun,idpenghuni,tagihan,statuss) VALUES ('$bulan','$tahun','$id','$kamar','$tarif','BL'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
 }

 function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM penghuni WHERE idpenghuni = $id");

    return mysqli_affected_rows($conn);
 }
 function hapus_kamar($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM kamar WHERE idkamar = $id");

    return mysqli_affected_rows($conn);
 }

?>
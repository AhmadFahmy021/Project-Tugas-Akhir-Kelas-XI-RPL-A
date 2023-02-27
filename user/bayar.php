<?php 
include '../functions.php';

$id = $_GET['id'];
mysqli_query($conn, "INSERT INTO sewa (idpenghuni) Values($id)");
mysqli_query($conn, "UPDATE penghuni SET idstatus = 3 Where idpenghuni = $id");
header('location: index.php');

?>
<?php
include 'koneksi2.php';

// menyimpan data id kedalam variabel
$id_pelanggan = $_GET['kode_destinasi'];

// query SQL untuk insert data
$query = "DELETE from pelanggan where kode_destinasi='$id_pelanggan'";
mysqli_query($conn, $query);

//mengalihkan ke halaman tampil.php
header("location:tampil.php");
?>
<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tlp = $_POST['tlp'];
// update data ke database
mysqli_query($koneksi,"update tb_member set nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', tlp='$tlp' where id='$id'");

// mengalihkan halaman kembali ke index.php
header("location:pelanggan.php?info=update");

?>
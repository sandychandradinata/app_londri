<?php 
$koneksi = mysqli_connect("localhost","root","sandyyusuf512","db_laundry");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
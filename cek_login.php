<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
// $data = mysqli_query($koneksi,"select * from user where username='$username' and password=md5('$password')");
$data = mysqli_query($koneksi,"select * from users where email='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

$data_user[] = $data->fetch_array(); 

if($cek === 0){
	header("location:index.php?pesan=gagal");
}else{
	$_SESSION['data_user'] = $data_user[0];
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:admin/index.php");
}
?>
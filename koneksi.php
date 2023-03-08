<?php 
// $koneksi = mysqli_connect("localhost","root","","ppiptrac_ppiptracker");
$koneksi = mysqli_connect("localhost","root","","pensiun_fund_tracker");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>
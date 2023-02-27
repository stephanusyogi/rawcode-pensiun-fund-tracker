<html>
<head>
	<title>PPIP TRacker</title>
</head>
<body>
	
	
	
 
	<!-- cek apakah sudah login -->
	<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../index.php?pesan=belum_login");
	}
	?>
 	<h2>Selamat datang, <?php echo $_SESSION['username']; ?>! anda telah login.</h2>
	<h4>Silahkan Update Data Gaji dan Saldo PPIP Anda</h4>
 
	
	

	<?php
		//mengambil data 
		include 'koneksi.php';
		$username = $_SESSION['username'];
		$result = $koneksi->query("select usia_daftar from user where username='$username'");
		if ($result->num_rows > 0) {
  		// output data of each row
  		while($row = $result->fetch_assoc()) {
    		//echo "1"."<br/>"."<br/>";
    		$usia[1]=$row["usia_daftar"];
  		}
		} else {
  		echo "0 results";
  		}

  		//$usia[0] = mysqli_query($koneksi,"select usia_daftar from user where username='$username'");

		//echo $usia[1];
	?>
 

	<!-- isi data gaji -->
	
	<form method="post" action="montecarlo.php">
		<table>
			<tr>
				<td>Update Gaji (data gaji tidak disimpan)</td>
				<td>:</td>
				<td><input type="text" name="gaji" placeholder="dalam rupiah tanpa koma"></td>
			</tr>
			<tr>
				<td>Saldo PPIP</td>
				<td>:</td>
				<td><input type="text" name="update_saldo" placeholder="dalam rupiah tanpa koma"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" name="run" value="run"></td>
			</tr>
		</table>			
	</form>
	<br/>
	<br/>


<a href="logout.php">LOGOUT</a>
 
</body>
</html>
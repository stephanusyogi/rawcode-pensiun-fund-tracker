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
	<h4>Silahkan Update Data Gaji dan PhDP Anda</h4>
 
	<?php
		//mengambil data 
		include 'koneksi.php';
	?>
 
	<form method="post" action="montecarlo1.php">
		<table>
			<tr>
				<td>Update Gaji (data gaji tidak disimpan)</td>
				<td>:</td>
				<td><input type="text" name="gaji" placeholder="dalam rupiah tanpa koma"></td>
			</tr>
			<tr>
				<td>PhDP</td>
				<td>:</td>
				<td><input type="text" name="phdp" placeholder="dalam rupiah tanpa koma"></td>
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
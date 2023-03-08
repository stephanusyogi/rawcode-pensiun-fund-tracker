
<html>
<head>
	<title>PPIP TRacker</title>
</head>
<style>
	table, thead, td, th {
		border:1px solid grey;
	}
	th{
		font-weight:bold;
	}
</style>
<body>

<?php
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../index.php?pesan=belum_login");
	}
	//mengambil data 
	include 'koneksi.php';
	$id_user = $_SESSION['data_user']['id_user'];
	$_SESSION['gaji'] = $_POST['gaji'];
	$_SESSION['phdp'] = $_POST['phdp'];

function umur_kini($tgl_lahir){
	// ubah ke format Ke Date Time
	$lahir = new DateTime($tgl_lahir);
	$hari_ini = new DateTime();

	$diff = $hari_ini->diff($lahir);

	// Display
	/*
	echo "Tanggal Lahir: ". date('d M Y', strtotime($tgl_lahir)) .'<br />';
	echo "Umur: ". $diff->y ." Tahun";
	echo " ". $diff->m ." Bulan";
	echo " ". $diff->d ." Hari";
	*/
	return array($diff->y,$diff->m,$diff->d);
} 

?>

<h2>Profil & Setting User: <?php echo $_SESSION['username']; ?>.</h2>
<hr>
<br>
<!-- Profil User -->
<table>
	<thead>
		<tr>
			<th colspan="2">Profil Peserta</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>ID User</td>
			<td><?= $_SESSION['data_user']['id_user'] ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><?= $_SESSION['data_user']['nama'] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?= $_SESSION['data_user']['email'] ?></td>
		</tr>
		<tr>
			<td>HP</td>
			<td><?= $_SESSION['data_user']['no_hp'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td><?= $_SESSION['data_user']['tgl_lahir'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Diangkat Pegawai</td>
			<td><?= $_SESSION['data_user']['tgl_diangkat_pegawai'] ?></td>
		</tr>
		<tr>
			<td>Usia Diangkat (Tahun)</td>
			<td><?= $_SESSION['data_user']['usia_diangkat_tahun'] ?></td>
		</tr>
		<tr>
			<td>Usia Diangkat (Bulan)</td>
			<td><?= $_SESSION['data_user']['usia_diangkat_bulan'] ?></td>
		</tr>
		<tr>
			<td>Usia Pensiun</td>
			<td><?= $_SESSION['data_user']['usia_pensiun'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Registrasi</td>
			<td><?= $_SESSION['data_user']['tgl_registrasi'] ?></td>
		</tr>
		<tr>
			<td>Layer PPMP (1=Ya)</td>
			<td><?= $_SESSION['data_user']['layer_ppmp'] ?></td>
		</tr>
		<tr>
			<td>Layer PPIP  (1=Ya)</td>
			<td><?= $_SESSION['data_user']['layer_ppip'] ?></td>
		</tr>
		<tr>
			<td>Layer Personal  (1=Ya)</td>
			<td><?= $_SESSION['data_user']['layer_personal'] ?></td>
		</tr>
		<tr>
			<td>Apakah sudah terdapat investasi yang disiapkan untuk pensiun ?</td>
			<td><?= $_SESSION['data_user']['terdapat_investasi_pensiun'] ?></td>
		</tr>
		<tr>
			<td>Jumlah Investasi Pasar Keuangan</td>
			<td><?= $_SESSION['data_user']['jumlah_investasi_keuangan'] ?></td>
		</tr>
		<tr>
			<td>Jumlah Investasi Properti (properti yang mendapatkan cashflow secara rutin)</td>
			<td><?= $_SESSION['data_user']['jumlah_investasi_properti'] ?></td>
		</tr>
		<tr>
			<td>Hasil neto sewa per tahun (telah dipotong biaya pengelolaan, biaya perawatan)</td>
			<td><?= $_SESSION['data_user']['sewa_properti'] ?></td>
		</tr>
		<tr>
			<td>Rata-rata kenaikan harga properti per tahun</td>
			<td><?= $_SESSION['data_user']['kenaikan_properti'] ?></td>
		</tr>
		<tr>
			<td>Rata-rata kenaikan sewa properti per tahun</td>
			<td><?= $_SESSION['data_user']['kenaikan_sewa'] ?></td>
		</tr>
		<tr>
			<td>Gaji</td>
			<td><?= $_SESSION['gaji'] ?></td>
		</tr>
		<tr>
			<td>PhDP</td>
			<td><?= $_SESSION['phdp'] ?></td>
		</tr>
		<tr>
			<td>Saldo PPIP</td>
			<td><?= $_SESSION['data_user']['saldo_ppip'] ?></td>
		</tr>
		<tr>
			<td>Rencana penambahan Saldo pada bulan ini ? (1=Ya)</td>
			<td><?= $_SESSION['data_user']['rencana_penambahan_saldo_bulan_ini'] ?></td>
		</tr>
		<tr>
			<td>Penambahan Saldo Tentative - Personal Keuangan</td>
			<td><?= $_SESSION['data_user']['penambahan_saldo_tentative_personal_keuangan'] ?></td>
		</tr>
		<tr>
			<td>Penambahan Saldo Tentative - Personal Properti</td>
			<td><?= $_SESSION['data_user']['penambahan_saldo_tentative_personal_properti'] ?></td>
		</tr>
	</tbody>
</table>
<br>
<!-- Asumsi -->
<?php 
	$nilai_asumsi_user = $koneksi->query("SELECT * FROM nilai_asumsi_user WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
?>
<table>
	<thead>
		<tr>
			<th colspan="2">Asumsi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($nilai_asumsi_user as $key) { ?>
			<tr>
				<td>Kenaikan Gaji per tahun</td>
				<td><?= $key['kenaikan_gaji'] ?></td>
			</tr>
			<tr>
				<td>Iuran PPIP (% dari gaji)</td>
				<td><?= $key['iuran_ppip'] ?></td>
			</tr>
			<tr>
				<td>Tambahan Iuran Mandiri PPIP</td>
				<td><?= $key['tambahan_iuran'] ?></td>
			</tr>
			<tr>
				<td>Dasar pembayaran Iuran Personal</td>
				<td><?= $key['dasar_pembayaran_iuran_personal'] ?></td>
			</tr>
			<tr>
				<td>Jumlah Pembayaran Iuran Personal</td>
				<td><?= $key['jumlah_pembayaran_iuran_personal'] ?></td>
			</tr>
			<tr>
				<td>Kenaikan Iuran Personal</td>
				<td><?= $key['kenaikan_iuran_personal'] ?></td>
			</tr>
			<tr>
				<td>Inflasi jangka panjang</td>
				<td><?= $key['inflasi_jangka_panjang'] ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<br>
<!-- Setting Portofolio PPIP -->
<?php 
	$setting_portofolio_ppip = $koneksi->query("SELECT * FROM setting_portofolio_ppip WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$id_setting_portofolio_dapenbi_ip = $setting_portofolio_ppip[0]['id_setting_portofolio_dapenbi_ip'];

	$nilai_setting_portofolio_dapenbi_ip = $koneksi->query("SELECT * FROM nilai_setting_portofolio_dapenbi_ip WHERE id='$id_setting_portofolio_dapenbi_ip'")->fetch_all(MYSQLI_ASSOC);
?>
<table>
	<thead>
		<tr>
			<th colspan="3">Setting Portofolio PPIP</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($nilai_setting_portofolio_dapenbi_ip as $key) { ?>
			<tr>
				<td>Pilihan Investasi</td>
				<td colspan="2"><?= $key['nama_portofolio'] ?></td>
			</tr>
			<tr>
				<th>Informasi mengenai portofolio PPIP yang dipilih</th>
				<th>Investasi</th>
				<th>Likuiditas</th>
			</tr>
			<tr>
				<td>Return Portofolio PPIP</td>
				<td><?= $key['return_portofolio_tranche_investasi'] ?></td>
				<td><?= $key['return_portofolio_tranche_likuiditas'] ?></td>
			</tr>
			<tr>
				<td>Risiko Pasar Portofolio PPIP</td>
				<td><?= $key['resiko_portofolio_tranche_investasi'] ?></td>
				<td><?= $key['resiko_portofolio_tranche_likuiditas'] ?></td>
			</tr>
			<tr>
				<td colspan="3">Komposisi Investasi</td>
			</tr>
			<tr>
				<td>Saham</td>
				<td><?= $key['tranche_investasi_saham'] ?></td>
				<td><?= $key['tranche_likuiditas_saham'] ?></td>
			</tr>
			<tr>
				<td>Pendapatan Tetap</td>
				<td><?= $key['tranche_investasi_pendapatan_tetap'] ?></td>
				<td><?= $key['tranche_likuiditas_pendapatan_tetap'] ?></td>
			</tr>
			<tr>
				<td>Deposito</td>
				<td><?= $key['tranche_investasi_deposito'] ?></td>
				<td><?= $key['tranche_likuiditas_deposito'] ?></td>
			</tr>
			<tr>
				<td colspan="3">Asumsi Return Investasi</td>
			</tr>
			<tr>
				<td>Saham</td>
				<td><?= $key['return_saham'] ?></td>
			</tr>
			<tr>
				<td>Pendapatan Tetap</td>
				<td><?= $key['return_pendapatan_tetap'] ?></td>
			</tr>
			<tr>
				<td>Deposito</td>
				<td><?= $key['return_deposito'] ?></td>
			</tr>
			<tr>
				<td colspan="3">Asumsi Resiko Pasar Investasi</td>
			</tr>
			<tr>
				<td>Saham</td>
				<td><?= $key['resiko_saham'] ?></td>
			</tr>
			<tr>
				<td>Pendapatan Tetap</td>
				<td><?= $key['resiko_pendapatan_tetap'] ?></td>
			</tr>
			<tr>
				<td>Deposito</td>
				<td><?= $key['resiko_deposito'] ?></td>
			</tr>	
		<?php } ?>
	</tbody>
</table>
<br>
<!-- Setting Portofolio Personal pada Pasar Keuangan -->
<?php 
	$setting_portofolio_personal = array(
		"Asumsi Return Investasi" => [],
		"Asumsi Resiko Pasar Investasi" => [],
		"Asumsi Korelasi Antar Aset" => [],
	);
	
	$personal_return_s = $koneksi->query("SELECT * FROM personal_return_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_return_pt = $koneksi->query("SELECT * FROM personal_return_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_return_d = $koneksi->query("SELECT * FROM personal_return_d  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_return_r_s = $koneksi->query("SELECT * FROM personal_return_r_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_return_r_pt = $koneksi->query("SELECT * FROM personal_return_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_return_r_pu = $koneksi->query("SELECT * FROM personal_return_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_return_r_c = $koneksi->query("SELECT * FROM personal_return_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);

	$setting_portofolio_personal["Asumsi Return Investasi"] = array(
		array("Saham" => $personal_return_s[0]),
		array("Pendapatan Tetap" => $personal_return_pt[0]),
		array("Deposito" => $personal_return_d[0]),
		array("Reksa Dana Saham" => $personal_return_r_s[0]),
		array("Reksa Dana Pendapatan Tetap" => $personal_return_r_pt[0]),
		array("Reksa Dana Pasar Uang" => $personal_return_r_pu[0]),
		array("Reksa Dana Campuran" => $personal_return_r_c[0]),
	);
	
	$personal_resiko_s = $koneksi->query("SELECT * FROM personal_resiko_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_resiko_pt = $koneksi->query("SELECT * FROM personal_resiko_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_resiko_d = $koneksi->query("SELECT * FROM personal_resiko_d  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_resiko_r_s = $koneksi->query("SELECT * FROM personal_resiko_r_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_resiko_r_pt = $koneksi->query("SELECT * FROM personal_resiko_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_resiko_r_pu = $koneksi->query("SELECT * FROM personal_resiko_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_resiko_r_c = $koneksi->query("SELECT * FROM personal_resiko_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);

	$setting_portofolio_personal["Asumsi Resiko Pasar Investasi"] = array(
		array("Saham" => $personal_resiko_s[0]),
		array("Pendapatan Tetap" => $personal_resiko_pt[0]),
		array("Deposito" => $personal_resiko_d[0]),
		array("Reksa Dana Saham" => $personal_resiko_r_s[0]),
		array("Reksa Dana Pendapatan Tetap" => $personal_resiko_r_pt[0]),
		array("Reksa Dana Pasar Uang" => $personal_resiko_r_pu[0]),
		array("Reksa Dana Campuran" => $personal_resiko_r_c[0]),
	);
	
	
	$personal_korelasi_s_pt = $koneksi->query("SELECT * FROM personal_korelasi_s_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_s_d = $koneksi->query("SELECT * FROM personal_korelasi_s_d  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_s_r_s = $koneksi->query("SELECT * FROM personal_korelasi_s_r_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_s_r_pt = $koneksi->query("SELECT * FROM personal_korelasi_s_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_s_r_pu = $koneksi->query("SELECT * FROM personal_korelasi_s_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_s_r_c = $koneksi->query("SELECT * FROM personal_korelasi_s_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	
	$personal_korelasi_pt_d = $koneksi->query("SELECT * FROM personal_korelasi_pt_d  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_pt_r_s = $koneksi->query("SELECT * FROM personal_korelasi_pt_r_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_pt_r_pt = $koneksi->query("SELECT * FROM personal_korelasi_pt_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_pt_r_pu = $koneksi->query("SELECT * FROM personal_korelasi_pt_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_pt_r_c = $koneksi->query("SELECT * FROM personal_korelasi_pt_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);

	
	$personal_korelasi_d_r_s = $koneksi->query("SELECT * FROM personal_korelasi_d_r_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_d_r_pt = $koneksi->query("SELECT * FROM personal_korelasi_d_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_d_r_pu = $koneksi->query("SELECT * FROM personal_korelasi_d_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_d_r_c = $koneksi->query("SELECT * FROM personal_korelasi_d_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	
	$personal_korelasi_r_s_r_pt = $koneksi->query("SELECT * FROM personal_korelasi_r_s_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_r_s_r_pu = $koneksi->query("SELECT * FROM personal_korelasi_r_s_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_r_s_r_c = $koneksi->query("SELECT * FROM personal_korelasi_r_s_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	
	$personal_korelasi_r_pt_r_pu = $koneksi->query("SELECT * FROM personal_korelasi_r_pt_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$personal_korelasi_r_pt_r_c = $koneksi->query("SELECT * FROM personal_korelasi_r_pt_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	
	$personal_korelasi_r_pu_r_c = $koneksi->query("SELECT * FROM personal_korelasi_r_pu_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);


	$setting_portofolio_personal["Asumsi Korelasi Antar Aset"] = array(
		array("Saham - Pendapatan Tetap" => $personal_korelasi_s_pt[0]),
		array("Saham - Deposito" => $personal_korelasi_s_d[0]),
		array("Saham - Reksa Dana Saham" => $personal_korelasi_s_r_s[0]),
		array("Saham - Reksa Dana Pendapatan Tetap" => $personal_korelasi_s_r_pt[0]),
		array("Saham - Reksa Dana Pasar Uang" => $personal_korelasi_s_r_pu[0]),
		array("Saham - Reksa Dana Campuran" => $personal_korelasi_s_r_c[0]),

		array("Pendapatan Tetap - Deposito" => $personal_korelasi_pt_d[0]),
		array("Pendapatan Tetap - Reksa Dana Saham" => $personal_korelasi_pt_r_s[0]),
		array("Pendapatan Tetap - Reksa Dana Pendapatan Tetap" => $personal_korelasi_pt_r_pt[0]),
		array("Pendapatan Tetap - Reksa Dana Pasar Uang" => $personal_korelasi_pt_r_pu[0]),
		array("Pendapatan Tetap - Reksa Dana Campuran" => $personal_korelasi_pt_r_c[0]),

		array("Deposito - Reksa Dana Saham" => $personal_korelasi_d_r_s[0]),
		array("Deposito - Reksa Dana Pendapatan Tetap" => $personal_korelasi_d_r_pt[0]),
		array("Deposito - Reksa Dana Pasar Uang" => $personal_korelasi_d_r_pu[0]),
		array("Deposito - Reksa Dana Campuran" => $personal_korelasi_d_r_c[0]),
		
		array("Reksa Dana Saham - Reksa Dana Pendapatan Tetap" => $personal_korelasi_r_s_r_pt[0]),
		array("Reksa Dana Saham - Reksa Dana Pasar Uang" => $personal_korelasi_r_s_r_pu[0]),
		array("Reksa Dana Saham - Reksa Dana Campuran" => $personal_korelasi_r_s_r_c[0]),
		
		array("Reksa Dana Pendapatan Tetap Saham - Reksa Dana Pasar Uang" => $personal_korelasi_r_pt_r_pu[0]),
		array("Reksa Dana Pendapatan Tetap Saham - Reksa Dana Campuran" => $personal_korelasi_r_pt_r_c[0]),

		array("Reksa Dana Pasar Uang - Reksa Dana Campuran" => $personal_korelasi_r_pu_r_c[0]),
	);
?>
<table>
	<thead>
		<tr>
			<th colspan="7">Setting Portofolio Personal pada Pasar Keuangan</th>
		</tr>
		<tr>
			<th>Capital Market Expectation</th>
			<th>Tranche Investasi 1</th>
			<th>Tranche Investasi 1 - Hitung</th>
			<th>Tranche Investasi 2</th>
			<th>Tranche Investasi 2 - Hitung</th>
			<th>Tranche Likuidtas</th>
			<th>Tranche Likuiditas - hitung</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="7">Asumsi Return Investasi  - Personal pada Pasar Keuangan</td>
		</tr>
		<?php 
		foreach ($setting_portofolio_personal["Asumsi Return Investasi"] as $key) { 
			foreach ($key as $child_key) { ?>
			<tr>
				<td><?= key($key) ?></td>
				<td><?= $child_key["tranche_investasi_1"] ?></td>
				<td><?= $child_key["tranche_investasi_1_hitung"] ?></td>
				<td><?= $child_key["tranche_investasi_2"] ?></td>
				<td><?= $child_key["tranche_investasi_2_hitung"] ?></td>
				<td><?= $child_key["tranche_likuiditas"] ?></td>
				<td><?= $child_key["tranche_likuiditas_hitung"] ?></td>
			</tr>
			<?php } } ?>
		<tr>
			<td colspan="6">Asumsi Risiko Pasar Investasi  - Personal pada Pasar Keuangan</td>
		</tr>
		<?php 
		foreach ($setting_portofolio_personal["Asumsi Resiko Pasar Investasi"] as $key) { 
			foreach ($key as $child_key) { ?>
			<tr>
				<td><?= key($key) ?></td>
				<td><?= $child_key["tranche_investasi_1"] ?></td>
				<td><?= $child_key["tranche_investasi_1_hitung"] ?></td>
				<td><?= $child_key["tranche_investasi_2"] ?></td>
				<td><?= $child_key["tranche_investasi_2_hitung"] ?></td>
				<td><?= $child_key["tranche_likuiditas"] ?></td>
				<td><?= $child_key["tranche_likuiditas_hitung"] ?></td>
			</tr>
			<?php } } ?>
		<tr>
			<td colspan="6">Asumsi korelasi antar aset  - Personal pada Pasar Keuangan</td>
		</tr>
		<?php 
		foreach ($setting_portofolio_personal["Asumsi Korelasi Antar Aset"] as $key) { 
			foreach ($key as $child_key) { ?>
			<tr>
				<td><?= key($key) ?></td>
				<td><?= $child_key["tranche_investasi_1"] ?></td>
				<td><?= $child_key["tranche_investasi_1_hitung"] ?></td>
				<td><?= $child_key["tranche_investasi_2"] ?></td>
				<td><?= $child_key["tranche_investasi_2_hitung"] ?></td>
				<td><?= $child_key["tranche_likuiditas"] ?></td>
				<td><?= $child_key["tranche_likuiditas_hitung"] ?></td>
			</tr>
			<?php } } ?>
	</tbody>
</table>
<br>
<!-- Komposisi Investasi Life Cycle Fund -->
<?php 
	$lifecycle_s = $koneksi->query("SELECT * FROM lifecycle_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_pt = $koneksi->query("SELECT * FROM lifecycle_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_d = $koneksi->query("SELECT * FROM lifecycle_d  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_r_s = $koneksi->query("SELECT * FROM lifecycle_r_s  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_r_pt = $koneksi->query("SELECT * FROM lifecycle_r_pt  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_r_pu = $koneksi->query("SELECT * FROM lifecycle_r_pu  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_r_c = $koneksi->query("SELECT * FROM lifecycle_r_c  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_return_portofolio_personal = $koneksi->query("SELECT * FROM lifecycle_return_portofolio_personal  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	$lifecycle_resiko_pasar_portofolio_personal	 = $koneksi->query("SELECT * FROM lifecycle_resiko_pasar_portofolio_personal  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
	
	$komposisi_investasi_lifecycle = array(
		array("Saham" => $lifecycle_s[0]),
		array("Pendapatan Tetap" => $lifecycle_pt[0]),
		array("Deposito" => $lifecycle_d[0]),
		array("Reksa Dana Saham" => $lifecycle_r_s[0]),
		array("Reksa Dana Pendapatan Tetap" => $lifecycle_r_pt[0]),
		array("Reksa Dana Pasar Uang" => $lifecycle_r_pu[0]),
		array("Reksa Dana Campuran" => $lifecycle_r_c[0]),
		array("Return Portofolio Personal" => $lifecycle_return_portofolio_personal[0]),
		array("Risiko Pasar Portofolio Personal" => $lifecycle_resiko_pasar_portofolio_personal[0]),
	);
?>
<table>
	<thead>
		<tr>
			<th>Komposisi Investasi Life Cycle Fund</th>
			<th>Tranche Investasi 1 (sebelum memasuki Tranche Investasi 2)</th>
			<th>Tranche Investasi 2 (5 tahun menjelang memasuki Tranche Likuiditas)</th>
			<th>Tranche Likuiditas (2 tahun menjelang Pensiun)</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($komposisi_investasi_lifecycle as $key) { 
				foreach ($key as $child_key) { ?>
				<tr>
					<td><?= key($key) ?></td>
					<td><?= $child_key["tranche_investasi_1"] ?></td>
					<td><?= $child_key["tranche_investasi_2"] ?></td>
					<td><?= $child_key["tranche_likuiditas"] ?></td>
				</tr>
		<?php } } ?>
	</tbody>
</table>
<br>
<!-- Setting Treatment pembayaran setelah Pensiun -->
<?php
$setting_treatment = $koneksi->query("SELECT * FROM setting_treatment_pemabayaran_setelah_pensiun  WHERE id_user='$id_user' AND flag=1")->fetch_all(MYSQLI_ASSOC);
?>
<br>
<table>
	<thead>
		<tr>
			<th colspan="2">Setting Treatment pembayaran setelah Pensiun</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>PPMP</td>
			<td><?= $setting_treatment[0]['ppmp']; ?></td>
		</tr>
		<tr>
			<td>PPIP</td>
			<td><?= $setting_treatment[0]['ppip']; ?></td>
		</tr>
		<tr>
			<td>Personal - Pasar Keuangan</td>
			<td><?= $setting_treatment[0]['personal_pasar_keuangan']; ?></td>
		</tr>
		<tr>
			<td>Harga Anuitas (jika terdapat pilihan beli anuitas)</td>
			<td><?= $setting_treatment[0]['harga_anuitas']; ?></td>
		</tr>
		<tr>
			<td>Personal - Properti</td>
			<td><?= $setting_treatment[0]['personal_properti']; ?></td>
		</tr>
		<tr>
			<td colspan="3">Jika Pembayaran menggunakan Bunga Deposito</td>
		</tr>
		<tr>
			<td>Bunga Deposito</td>
			<td><?= $setting_treatment[0]['bunga_deposito']; ?></td>
		</tr>
		<tr>
			<td>Pajak Deposito saat pembayaran bulanan menggunakan Bunga Deposito</td>
			<td><?= $setting_treatment[0]['pajak_deposito']; ?></td>
		</tr>
		<tr>
			<td colspan="2">*asumsi termasuk pajak penghasilan</td>
		</tr>
	</tbody>
</table>
<br>
<br>
<a href="logout.php">LOGOUT</a>
</body>
</html>

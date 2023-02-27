<html>
<head>
	<title>PPIP TRacker</title>
</head>
<body>


<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$gaji = $_POST['gaji'];
$saldo = $_POST['update_saldo'];


//selamat datang
echo "Selamat Datang ".$_SESSION['username'].". Enjoy PPIP Tracker..."."<br/>"."<br/>";


//menampilkan waktu akses
date_default_timezone_set("Asia/Jakarta");
echo "Timestamp "."<br/>".date("l, d F Y")."  ".date("h:i:s A")."<br/>"."<br/>";



//mengambil data gaji dan saldo
echo "gaji anda =".$gaji."<br/>";
echo "saldo anda =".$saldo."<br/>"."<br/>";


//kumpulan function
	//function mencari umur
	// Tanggal Lahir
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


	//membuat variabel usia s.d. pensiun
		//mengambil data Pensiun
			//data tanggal lahir
				//mengambil data
				$username = $_SESSION['username'];
				$result = $koneksi->query("select tgl_lahir from user where username='$username'");
				if ($result->num_rows > 0) {
  				
  				// output data of each row
  				while($row = $result->fetch_assoc()) {
    				$tgl_lahir=$row["tgl_lahir"];
  				}
				} else {
  					echo "0 results";
  				}

  				//test data
  				echo "<br/>"."tanggal lahir = ".$tgl_lahir."<br/>";

  			//data umur pensiun
  			//mengambil data
				$username = $_SESSION['username'];
				$result = $koneksi->query("select usia_pensiun from user where username='$username'");
				if ($result->num_rows > 0) {
  				
  				// output data of each row
  				while($row = $result->fetch_assoc()) {
    				$umurpensiun[1]=$row["usia_pensiun"];
  				}
				} else {
  					echo "0 results";
  				}

  				$umurpensiun[2]=0;
  				$umurpensiun[3]=0;

  				echo "usia pensiun =".$umurpensiun[1]."<br/>";

  		//menghitung umur kini
  			list($umurkini[1],$umurkini[2],$umurkini[3])=umur_kini($tgl_lahir);
  			
  			//keterangan
  				/*
  				$umurkini[1]=Tahun
  				$umurkini[2]=bulan
  				$umurkini[3]=tanggal
				*/

			//display
  				/*
  				for($i=1;$i<=3;$i++){
  					echo $umurkini[$i]."<br/>";
  				}
  				*/
  		// Menghitung sisa masa dinas
  			$sisa_dinas=$umurpensiun[1]-$umurkini[1];
  			echo "sisa masa dinas =".$sisa_dinas."<br/>";

  		
  		// Membuat tabel tahun
  			$tahunini= date('Y');
  			echo "tahun =";
  			//echo $tahunini."<br/>";
  			
  			$tabel_tahun[1]=$tahunini;
  			echo $tabel_tahun[1]." ";

  			for($i=2;$i<=$sisa_dinas;$i++){
  				$tabel_tahun[$i]=$tabel_tahun[$i-1 ]+1;
  				echo $tabel_tahun[$i]." ";
  			}

  			echo "<br/>";

  		// Membuat tabel usia
  			
  			echo "Usia =";
  			for ($i=1;$i<=$sisa_dinas;$i++){

  				$tabel_usia[$i]=$umurkini[1]+$i-1;
  				echo $tabel_usia[$i]."  ";
  			}
			echo "<br/>";

		// Membuat cluster
			echo "Cluster =";

			//Mengisi cluster
			if($sisa_dinas==1){

				$cluster[$sisa_dinas]=7;

			} else if($sisa_dinas==2){

				$cluster[$sisa_dinas]=7;
				$cluster[$sisa_dinas-1]=7;

			} else if($sisa_dinas<=5){

				$cluster[$sisa_dinas]=7;
				$cluster[$sisa_dinas-1]=7;

				for($i=$sisa_dinas-2;$i>=1;$i--){
					$cluster[$i]=6;
				}

			} else {

				$cluster[$sisa_dinas]=7;
				$cluster[$sisa_dinas-1]=7;

				for($i=$sisa_dinas-2;$i>$sisa_dinas-5;$i--){
					$cluster[$i]=6;
				}

				$j=5;
				$jml=1;

				for ($i=$sisa_dinas-5;$i>=1;$i--){	
					if($jml>5 and $j>1){

						$j--;
						$jml=1;

					}
					$cluster[$i]=$j;
					$jml++;
				}

			}
			
			echo "<br/>";

			//menampilkan cluster
			for ($i=1;$i<=$sisa_dinas;$i++){
				echo $cluster[$i]."  ";
			}

			echo "<br/>";

		// Membuat Tabel Sisa Masa Dinas
  			echo "Sisa Masa Dinas =";
  			for ($i=0;$i<$sisa_dinas;$i++){

  				$tabel_sisa[$i+1]=$sisa_dinas-$i;
  				echo $tabel_sisa[$i+1]."  ";
  			}
			echo "<br/>";

		// Membuat Tabel proyeksi Gaji
			// Baca besar asumsi kenaikan
				$result = $koneksi->query("select nilai_asumsi from asumsi where nama_asumsi='kenaikan_gaji'");
				if ($result->num_rows > 0) {
  				
  				// output data of each row
  				while($row = $result->fetch_assoc()) {
    				$kenaikan_gaji=$row["nilai_asumsi"];
  				}
				} else {
  					echo "0 results";
  				}

  				//test data
  				echo "<br/>"."kenaikan Gaji = ".$kenaikan_gaji."<br/>";


			echo "Proyeksi gaji =";
  			for ($i=1;$i<=$sisa_dinas;$i++){
  				
  				if($i==1){
  					$tabel_gaji[$i]=round($gaji,2);
  				} else{
  					$tabel_gaji[$i]=round($tabel_gaji[$i-1]*(1+$kenaikan_gaji),2);
  				}
  				 				
  				echo $tabel_gaji[$i]."  ";
  			}
			echo "<br/>";	
		//mengambil nilai iuran
			// baca jenis pensiun
				$username = $_SESSION['username'];
				$result = $koneksi->query("select jenis_mp from user where username='$username'");
				if ($result->num_rows > 0) {
  				
  				// output data of each row
  				while($row = $result->fetch_assoc()) {
    				$jenis_mp=$row["jenis_mp"];
  				}
				} else {
  					echo "0 results";
  				}

  				//test data
  				echo "<br/>"."Jenis MP = ".$jenis_mp."<br/>";

  			//baca asumsi iuran berdasarkan jenis MP
  				if($jenis_mp=='ppip murni'){
  					$result = $koneksi->query("select nilai_asumsi from asumsi where nama_asumsi='iuran_ppip_murni'"); //ambil iuran ppip murni
						if ($result->num_rows > 0) {
						
							// output data of each row
							while($row = $result->fetch_assoc()) {
								$iuran=$row["nilai_asumsi"];
							}
						} else {
								echo "0 results";
							}

  					//test data
  					echo "<br/>"."Besar Iuran = ".$iuran."<br/>";
  				} else{
  					$result = $koneksi->query("select nilai_asumsi from asumsi where nama_asumsi='iuran_ppip_hybrid'"); //ambil iuran ppip hybrid
						if ($result->num_rows > 0) {
						
							// output data of each row
							while($row = $result->fetch_assoc()) {
								$iuran=$row["nilai_asumsi"];
							}
						} else {
								echo "0 results";
							}

  					//test data
  					echo "<br/>"."Besar Iuran = ".$iuran."<br/>";
  				}

	//Menghitung MOntecarlo
  		$jml_iterasi_mc=10000;
		//Baca Return
			for($i=1;$i<=7;$i++){

				$username = $_SESSION['username'];
				$result = $koneksi->query("select return_cluster$i from user where username='$username'");
				if ($result->num_rows > 0) {
  				
  				// output data of each row
  				while($row = $result->fetch_assoc()) {
    				$return_cluster[$i]=$row["return_cluster$i"];
  				}
				} else {
  					echo "0 results";
  				}

  				//test data
  				echo "<br/>"."return_cluster $i = ".$return_cluster[$i]."<br/>";

			}

  		//Baca Risk
  			for($i=1;$i<=7;$i++){

				$result = $koneksi->query("select mvo_risk from mvo where mvo_return=$return_cluster[$i]");
				if ($result->num_rows > 0) {
  				
  				// output data of each row
  				while($row = $result->fetch_assoc()) {
    				$risk_cluster[$i]=$row["mvo_risk"];
  				}
				} else {
  					echo "0 results";
  				}

  				//test data
  				echo "<br/>"."risk cluster ".$i." = ".$risk_cluster[$i]."<br/>";

  			}

 		
  		//load data normal inverse
  		for($i=1;$i<=10001;$i++){
  			$result = $koneksi->query("select norm_inv from distribusi_normal where id_distribusi=$i");
				if ($result->num_rows > 0) {
						
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$norm_inv[$i]=$row["norm_inv"];
						}
				} else {
						echo "0 results";
					}
  			//echo $norm_inv[$i]."<br/>";
  		}
			
  		$awal_waktu=date_create(); //counting running time montecarlo
  		$bulan_ini=intval(date("m")); // definisi hari ini untuk hitung tambahan iuran di tahun ini
  		$hari_ini=intval(date("d"));

  		echo "bulan ini =".$bulan_ini." tanggal = ".$hari_ini."<br/>";
  		

  		// Menghitung NAB
  			
		for ($i=0;$i<=$sisa_dinas;$i++){

			for($j=1;$j<=$jml_iterasi_mc;$j++){

				if($i==0){

					$nab[$i][$j]=100; //NAB awal
					$return_mc[$i][$j]=0; //Return MOnte Carlo awal
					$saldo_mc[$i][$j]=0; //Saldo MOnte Carlo Dummy

							//echo "i=0 <br/>";
				}else if($i==1){ //---------------------------kondisi tahun ini
					
					//generate random variable
					$acak=mt_rand(0,10000);
					//echo $acak."  ";

  					//menghitung NAB
					$nab[$i][$j]=round($nab[$i-1][$j] * (1 + ($return_cluster[$cluster[$i]] / 100) + (($risk_cluster[$cluster[$i]] / 100) * $norm_inv[$acak+1]) ),2);

					//menghitung return
					$return_mc[$i][$j]=round(($nab[$i][$j] - $nab[$i-1][$j]) / $nab[$i-1][$j],2);

					//saldo awal real
					$saldo_mc[$i][$j]=$saldo; //Saldo MOnte Carlo real
							//echo "i=1 <br/>";
							//echo "Saldo awal ke ".$j." = ".$saldo_mc[$i][$j]."<br/>";
					//menghitung tambahan saldo tahun ini
					if($bulan_ini==12){ // jika bulan ini desember maka kalau belum tanggal gajian maka saldo ditambah 1x iuran dan nilai kenaikan investasi diabaikan
						if($hari_ini<25){
							$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tabel_gaji[$i] * $iuran;
						}
					} elseif ($bulan_ini>6) {
						// jika setelah bulan Juni sebelum bulan desember, hanya ada tambahan iuran dan nilai kenaikan investasi diabaikan
						if($hari_ini>=25){ //setelah tanggal gajian
							$tambahan_iuran=$tabel_gaji[$i] * $iuran * (12 - $bulan_ini); //tambahan iuran
							$tambahan_pengembangan=0;
							$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tambahan_iuran + $tambahan_pengembangan;
						} else{ //sebelum tanggal gajian (iuran ditambah 1)
							$tambahan_iuran=$tabel_gaji[$i] * $iuran * (12 - $bulan_ini - 1); //tambahan iuran
							$tambahan_pengembangan=0;
							$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tambahan_iuran + $tambahan_pengembangan;
						}
					} else{
						// jika setelah bulan Juni sebelum bulan desember, hanya ada tambahan iuran dan nilai kenaikan investasi diabaikan
						$zz=0;//counter iuran yang sudah dibayar
						if($hari_ini>=25){ //setelah tanggal gajian
							for($y=$bulan_ini;$y<=6;$y++){
								$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tabel_gaji[$i] * $iuran;
								$zz++;
							}


							$tambahan_iuran=$tabel_gaji[$i] * $iuran * (12 - $bulan_ini + $zz); //tambahan iuran yang sudah dikalibrasi selama setengah tahun
							$tambahan_pengembangan=$saldo_mc[$i][$j] * ($return_mc[$i][$j] / 2);
							$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tambahan_iuran + $tambahan_pengembangan;
									//echo "<br/> kalau ini muncul jadi sudah bener <br/>";
						} else{ //sebelum tanggal gajian (iuran ditambah 1)
							for($y=$bulan_ini-1;$y<=6;$y++){ //ditambah 1 iterasi karena belum gajian
								$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tabel_gaji[$i] * $iuran;
								$zz++;
							}


							$tambahan_iuran=$tabel_gaji[$i] * $iuran * (12 - $bulan_ini + $zz); //tambahan iuran yang sudah dikalibrasi selama setengah tahun
							$tambahan_pengembangan=$saldo_mc[$i][$j] * ($return_mc[$i][$j] / 2);
							$saldo_mc[$i][$j]=$saldo_mc[$i][$j] + $tambahan_iuran + $tambahan_pengembangan;
						}
					}

				} else { //------------------------------kondisi tahun-tahun mendatang        

					//generate random variable
					$acak=mt_rand(0,10000);
					//echo $acak."  ";

  					//menghitung NAB
					$nab[$i][$j]=round($nab[$i-1][$j] * (1 + ($return_cluster[$cluster[$i]] / 100)+(($risk_cluster[$cluster[$i]] / 100) * $norm_inv[$acak+1])),2);

					//menghitung return
					$return_mc[$i][$j]=round(($nab[$i][$j] - $nab[$i-1][$j]) / $nab[$i-1][$j],2);

					//saldo tahun selanjutnya
					$saldo_mc[$i][$j]=($saldo_mc[$i-1][$j] * (1+$return_mc[$i][$j])) + (($tabel_gaji[$i] * $iuran * 12) * (1 + $return_mc[$i][$j] / 2)); //Saldo MOnte Carlo real
					
				}

				$saldo_mc[$i][$j]=round($saldo_mc[$i][$j],2);
				//echo $saldo_mc[$i][$j]."  ";
			}

			//echo "<br/>";
		}

		// mencari percentile saldo
		echo "<br/> ========================= <br/>";
		
		for($i=1;$i<=$sisa_dinas;$i++){
			$k=0;
			for($j=1;$j<=$jml_iterasi_mc;$j++){
				$percentile_temp1[$k]=$saldo_mc[$i][$j];
				
				//echo "k=".$k." percentile =".$percentile_temp[$k];
				$k++;
			}
			sort($percentile_temp1);//setelah disort, array dimulai dari nol. sehingga perlu dikembalikan lagi urutan arraynya
			$m=0;
			for($n=1;$n<=$jml_iterasi_mc;$n++){ //jumlahnya sesuai $j
				$percentile_temp2[$n]=$percentile_temp1[$m]; // urutan yg bener ada di $percentile_temp2[$j]
				$m++;
						//echo $percentile_temp2[$n]." ";
			}
			
			$percentile_95[$i]=$percentile_temp2[round(0.95 * $jml_iterasi_mc)];
			$percentile_50[$i]=$percentile_temp2[round(0.5 * $jml_iterasi_mc)];
			$percentile_05[$i]=$percentile_temp2[round(0.05 * $jml_iterasi_mc)];

			echo "P95 = ".$percentile_95[$i]."; P50 = ".$percentile_50[$i]."; P05 = ".$percentile_05[$i]."<br/>";
		}
			
		$akhir_waktu=date_create();
		$diff  = date_diff( $awal_waktu, $akhir_waktu );

		echo "Selisih waktu: ";
		echo $diff->h . ' jam, ';
		echo $diff->i . ' menit, ';
		echo $diff->s . ' detik, ';

?>
<br/>
<a href="logout.php">LOGOUT</a>
 
</body>
</html>
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

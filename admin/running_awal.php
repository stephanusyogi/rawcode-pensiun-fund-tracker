<?php 
  
//A.1 Hitung Target Replacement Ratio
  //Input: Read data Kuesioner
    $nilai=0; //baca nilai di kuesioner
    $jumlah=0;
    for ($i=1;$i<=10;$i++){
       $jumlah = $jumlah + $nilai;
    }
   
  //Output: Create Data Target Replacement Ratio
//-------------------------------------------------

//B.1 Hitung usia diangkat
  //Input: Read tanggal Lahir dan tanggal diangkat
 $date1=date_create("1992-06-24"); //Read tanggal lahir
 $date2=date_create("2018-02-06"); //Read tanggal diangkat
 $diff=date_diff($date1,$date2);
 
 $tahun=$diff->format('%y');
 $bulan=$diff->format('%m');
 
  //Output: Create data usia diangkat tahun = $tahun dan bulan =$bulan
//----------------------------------------------------------------------


//C.1. Simulasi Basic - hitung usia (usia diisi dari januari 2023 s.d. desember 2100)
//input: Read tanggal lahir
$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
$date1=date_create("1992-06-24"); //Read tanggal lahir
$date2=date_create("2023-01-01"); //januari 2023
$diff=date_diff($date1,$date2);
 
for ($i=1;$i<=$jml;$i++){
  
  if($i==1){
    $tahun=$diff->format('%y');
    $bulan=$diff->format('%m');
    //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan di database usia
    $bulan = $bulan +1;
  } else {
    if($bulan >=12){
      $bulan = 1;
      $tahun = $tahun+1;
    }
    //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan di database usia 
    $bulan = $bulan +1;
  }
  
}
//-----------------------------------------------------    
//C.2. Simulasi Basic - hitung Masa Dinas (masa dinas diisi dari januari 2023 s.d. desember 2100)
//input: Read tanggal diangkat
$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
$date1=date_create("2018-02-06"); //Read tanggal diangkat
$date2=date_create("2023-01-01"); //januari 2023
$diff=date_diff($date1,$date2);
 
for ($i=1;$i<=$jml;$i++){
  
  if($i==1){
    $tahun=$diff->format('%y');
    $bulan=$diff->format('%m');
    //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan di database masa dinas
    $bulan = $bulan +1;
  } else {
    if($bulan >=12){
      $bulan = 1;
      $tahun = $tahun+1;
    }
    //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan di database masa dinas
    $bulan = $bulan +1;
  }
  
}

//-----------------------------------------------------    
//C.3. Simulasi Basic - sisa masa kerja (sisa masa kerja diisi dari januari 2023 s.d. desember 2100)
//input: Read usia pensiun dan usia
     $usia_pensiun=56; //read usia pensiun
    $tahun_pensiun=$usia_pensiun - 1;
    $bulan_pensiun=12;
    
    $jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
   
for ($i=1;$i<=$jml;$i++){
  
  if($i==1){
    $usia_tahun[$i]=24; //read usia tahun saat januari 2023
    $usia_bulan[$i]=2; //read usia bulan saat januari 2023
    
    $sisa_kerja_tahun[$i]=$tahun_pensiun - $usia_tahun[$i];
    $sisa_kerja_bulan[$i]=$bulan_pensiun - $usia_bulan[$i];
    
      //konversi bulan dari posisi dari 1-12 ke 0-11
      if($sisa_kerja_bulan[$i]==12){
      $sisa_kerja_tahun[$i]=$sisa_kerja_tahun[$i]+1;
      $sisa_kerja_bulan[$i]=0;
      }  
      //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan di database usia
    
      //menurunkan bulan
      if($sisa_kerja_bulan[$i]<=0){
        $sisa_kerja_tahun[$i]=$sisa_kerja_tahun[$i]-1;
        $sisa_kerja_bulan[$i]=11;
      } else{
        $sisa_kerja_bulan[$i]=$sisa_kerja_bulan[$i]-1;
      }
  
  } else {
    if($sisa_kerja_bulan[$i]<=0){
        $sisa_kerja_tahun[$i]=$sisa_kerja_tahun[$i]-1;
        $sisa_kerja_bulan[$i]=11;
    }
    //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan di database usia 
    $sisa_kerja_bulan[$i]=$sisa_kerja_bulan[$i]-1;
  }
  
}

//-----------------------------------------------------------------------------    
//C.4. Flag Pensiun/belum pensiun
//Input: Read sisa masa kerja tahun dan bulan
$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100

for($i=1;$i<=$jml;$i++){
  $sisa_kerja_tahun[$i]=10;//Read sisa masa kerja tahun
  $sisa_kerja_bulan[$i]=2;//Read sisa masa kerja bulan
  
  if($sisa_kerja_tahun[$i]<0){
   $flag_pensiun[$i]=1;//sudah pensiun
  } else {
    $flag_pensiun[$i]=0;//belum pensiun
  }
  //Output: Create $flag_pensiun[$i]
}

//--------------------------------------------------------
//D. Hitung Montecarlo PPIP
//Input: Read sisa masa kerja tahun saat awal tahun, portofolio investasi PPIP yang dipilih peserta, return dan risk portofolio ppip, tabel normal inverse;
$jml=78; // jumlah tahun dari 2023 s.d. 2100
$pilihan_ppip=1;//Read portofolio PPIP yang dipilih peserta

//loading tabel normal inverse
for ($i=1;$i<=10000;$i++){ //$i adalah primary key dari tabel normal inverse yang ada di database
    $tabel_norminv[$i]=1;//Read tabel normal inverse
}

//mulai perhitungan
for ($i=1;$i<=$jml;$i++){
  $sisa_kerja_tahun[$i]=10;//Read sisa masa kerja tahun setiap bulan januari
  $flag_pensiun[$i]=1;//Read flag pensiun setiap bulan januari
  
  //+++++++++++++++++++++++++++++++++
  //D.1., D.2., dan D.3. Hitung Montecarlo PPIP - hitung tranche, return, dan risk
  if($sisa_kerja_tahun[$i]>=2){
    $tranche_ppip[$i]="investasi";//untuk sisa masa kerja lebih dari atau sama dengan 2 tahun , masuk ke tranche investasi
    $return_ppip[$i]=1;//read return portofolio dari PPIP dengan $pilihan_ppip dan tranche investasi
    $risk_ppip[$i]=1;//read risk portofolio dari PPIP dengan $pilihan_ppip dan tranche investasi
  } else if ($sisa_kerja_tahun[$i]<2 && $flag_pensiun[$i] == 0 ){ //flag pensiun =0 menandakan belum pensiun
    $tranche_ppip[$i]="likuiditas";//untuk sisa masa kerja kurang dari 2 tahun , masuk ke tranche likuiditas
    $return_ppip[$i]=1;//read return portofolio dari PPIP dengan $pilihan_ppip dan tranche likuiditas
    $risk_ppip[$i]=1;//read risk portofolio dari PPIP dengan $pilihan_ppip dan tranche likuiditas
  } else {
    $tranche_ppip[$i]="null";//sudah pensiun
    $return_ppip[$i]="null";//sudah pensiun
    $risk_ppip[$i]="null";//sudah pensiun
  }
  //Output: Create $tranche_ppip[$i], $return_ppip[$i], $risk_ppip[$i]
  
  //+++++++++++++++++++++++++++++++++
  //D.4. Hitung Montecarlo PPIP - hitung NAB
  if($tranche_ppip[$i] != "null"){ //jika masih belum pensiun
    
     for($j=1;$j<=10000;$j++){      //monte carlo 10.000 iterasi
        if($j==1){ // untuk perhitungan awal (karena angka sebelumnya indeks dari NAB adalah 100)
            
            $acak= mt_rand(1,10000); //generate angka acak dari 1 s.d. 10.000. (angka acak sesuai dengan primary key dari tabel normal inverse dalam database)
            $nab_ppip[$i][$j]=round(100 * (1 + ($return_ppip[$i] / 100) + (($risk_ppip[$i] / 100) * $tabel_norminv[$acak]) ),2);
        } else{
          
            $acak= mt_rand(1,10000); //generate angka acak dari 1 s.d. 10.000. (angka acak sesuai dengan primary key dari tabel normal inverse dalam database)
            $nab_ppip[$i][$j]=round($nab_ppip[$i-1][$j] * (1 + ($return_ppip[$i] / 100) + (($risk_ppip[$i] / 100) * $tabel_norminv[$acak]) ),2);
        }
    }
       
    
  } else{ //jika sudah pensiun
    for($j=1;$j<=10000;$j++){ //monte carlo 10.000 iterasi
         $nab_ppip[$i][$j]=0;
     }
  }
  
  //+++++++++++++++++++++++++++++++++
  //D.5., D.6., dan D.7. Hitung Montecarlo PPIP - hitung percentile 95, 50, dan 5 dari NAB
  //Input: NAB yang telah dihitung sebelumnya
  
  if($tranche_ppip[$i] != "null"){ //jika masih belum pensiun
      $k=0;
      for ($j=1;$j<=10000;$j++){
        $percentile_temp1[$k]=$nab_ppip[$i][$j]; //loading sementara isi dari NAB untuk kemudian di shorting
        $k++;
      }
      
      sort($percentile_temp1); //shorting array
      
      $k=0;
      for ($j=1;$j<=10000;$j++){
        $percentile_temp2[$j]=$percentile_temp1[$k]; //mengembalikan lagi ke urutan array yang telah disortir
        $k++;
      }
      
      	$percentile_95_nab_ppip[$i]=$percentile_temp2[round(0.95 * 10000)]; //mengambil nilai percentile 95
	$percentile_50_nab_ppip[$i]=$percentile_temp2[round(0.5 * 10000)]; //mengambil nilai percentile 50
	$percentile_05_nab_ppip[$i]=$percentile_temp2[round(0.05 * 10000)]; //mengambil nilai percentile 5
    
      
  } else {
	$percentile_95_nab_ppip[$i]=0; // nilai percentile 95 saat sudah pensiun
	$percentile_50_nab_ppip[$i]=0; // nilai percentile 50 saat sudah pensiun
	$percentile_05_nab_ppip[$i]=0; // nilai percentile 5 saat sudah pensiun
  }
  //Output: Create $percentile_95_nab_ppip[$i], $percentile_50_nab_ppip[$i], dan $percentile_05_nab_ppip[$i]
}

//--------------------------------------------------------
//D.8., D.9., dan D.10. Hitung Montecarlo PPIP - hitung return dari Percentile NAB
//termasuk dengan convert monthly di D.11., D.12., dan D.13. Hitung Montecarlo PPIP - hitung return dari Percentile NAB - convert monthly
$jml=78; // jumlah tahun dari 2023 s.d. 2100
for ($i=1;$i<=$jml;$i++){
	if ($tranche_ppip[$i] != "null"){ //jika masih belum pensiun
		if ($i==1){
			
			//tahunan
			$percentile_95_return_ppip[$i]=($percentile_95_nab_ppip[$i]/100)-1;
			$percentile_50_return_ppip[$i]=($percentile_50_nab_ppip[$i]/100)-1;
			$percentile_05_return_ppip[$i]=($percentile_05_nab_ppip[$i]/100)-1;
			
			//convert monthly
			$percentile_95_return_monthly_ppip[$i]=((1+$percentile_95_return_ppip[$i])^(1/12))-1;
			$percentile_50_return_monthly_ppip[$i]=((1+$percentile_50_return_ppip[$i])^(1/12))-1;
			$percentile_05_return_monthly_ppip[$i]=((1+$percentile_05_return_ppip[$i])^(1/12))-1;
		} else {
			
			//tahunan
			$percentile_95_return_ppip[$i]=($percentile_95_nab_ppip[$i]/$percentile_95_nab_ppip[$i-1])-1;
			$percentile_50_return_ppip[$i]=($percentile_50_nab_ppip[$i]/$percentile_50_nab_ppip[$i-1])-1;
			$percentile_05_return_ppip[$i]=($percentile_05_nab_ppip[$i]/$percentile_05_nab_ppip[$i-1])-1;
			
			//convert monthly
			$percentile_95_return_monthly_ppip[$i]=((1+$percentile_95_return_ppip[$i])^(1/12))-1;
			$percentile_50_return_monthly_ppip[$i]=((1+$percentile_50_return_ppip[$i])^(1/12))-1;
			$percentile_05_return_monthly_ppip[$i]=((1+$percentile_05_return_ppip[$i])^(1/12))-1;
		}
	} else {
			$percentile_95_return_ppip[$i]=0;
			$percentile_50_return_ppip[$i]=0;
			$percentile_05_return_ppip[$i]=0;
		
			$percentile_95_return_monthly_ppip[$i]=0;
			$percentile_50_return_monthly_ppip[$i]=0;
			$percentile_05_return_monthly_ppip[$i]=0;	
	}
	//Output: Create $percentile_95_return_ppip[$i], $percentile_50_return_ppip[$i], $percentile_05_return_ppip[$i], $percentile_95_return_monthly_ppip[$i], $percentile_50_return_monthly_ppip[$i], dan $percentile_05_return_monthly_ppip[$i]
}


//----------------------------------------------------------------------------------
//E. Hitung Montecarlo Personal Keuangan
//Input: Read sisa masa kerja tahun saat awal tahun, portofolio investasi Personal yang dipilih peserta, return dan risk portofolio Personal, tabel normal inverse;
$jml=78; // jumlah tahun dari 2023 s.d. 2100
$pilihan_personal=1;//Read portofolio Personal yang dipilih peserta

//loading tabel normal inverse
for ($i=1;$i<=10000;$i++){ //$i adalah primary key dari tabel normal inverse yang ada di database
    $tabel_norminv[$i]=1;//Read tabel normal inverse
}

//mulai perhitungan
for ($i=1;$i<=$jml;$i++){
  $sisa_kerja_tahun[$i]=10;//Read sisa masa kerja tahun setiap bulan januari
  $flag_pensiun[$i]=1;//Read flag pensiun setiap bulan januari
  
  //+++++++++++++++++++++++++++++++++
  //E.1., E.2., dan E.3. Hitung Montecarlo Personal - hitung tranche, return, dan risk
  if($sisa_kerja_tahun[$i]>=7){
    $tranche_personal[$i]="tranche 1";//untuk sisa masa kerja lebih dari atau sama dengan 7 tahun , masuk ke tranche 1
    $return_personal[$i]=1;//read return portofolio personal dengan $pilihan_personal dan tranche 1
    $risk_personal[$i]=1;//read risk portofolio personal dengan $pilihan_personal dan tranche 1
  } else if($sisa_kerja_tahun[$i]>=2){
    $tranche_personal[$i]="tranche 2";//untuk sisa masa kerja kurang dari 7 tahun sampai dengan 2 tahun , masuk ke tranche 2
    $return_personal[$i]=1;//read return portofolio personal dengan $pilihan_personal dan tranche 2
    $risk_personal[$i]=1;//read risk portofolio personal dengan $pilihan_personal dan tranche 2
  } else if ($sisa_kerja_tahun[$i]<2 && $flag_pensiun[$i] == 0 ){ //flag pensiun =0 menandakan belum pensiun
    $tranche_personal[$i]="tranche 3";//untuk sisa masa kerja kurang dari 2 tahun , masuk ke tranche 3
    $return_personal[$i]=1;//read return portofolio personal dengan $pilihan_personal dan tranche 3
    $risk_personal[$i]=1;//read risk portofolio personal dengan $pilihan_personal dan tranche 3
  } else {
    $tranche_personal[$i]="null";//sudah pensiun
    $return_personal[$i]="null";//sudah pensiun
    $risk_personal[$i]="null";//sudah pensiun
  }
  //Output: Create $tranche_personal[$i], $return_personal[$i], $risk_personal[$i]
  
  //+++++++++++++++++++++++++++++++++
  //E.4. Hitung Montecarlo personal - hitung NAB
  if($tranche_personal[$i] != "null"){ //jika masih belum pensiun
    
     for($j=1;$j<=10000;$j++){      //monte carlo 10.000 iterasi
        if($j==1){ // untuk perhitungan awal (karena angka sebelumnya indeks dari NAB adalah 100)
            
            $acak= mt_rand(1,10000); //generate angka acak dari 1 s.d. 10.000. (angka acak sesuai dengan primary key dari tabel normal inverse dalam database)
            $nab_personal[$i][$j]=round(100 * (1 + ($return_personal[$i] / 100) + (($risk_personal[$i] / 100) * $tabel_norminv[$acak]) ),2);
        } else{
          
            $acak= mt_rand(1,10000); //generate angka acak dari 1 s.d. 10.000. (angka acak sesuai dengan primary key dari tabel normal inverse dalam database)
            $nab_personal[$i][$j]=round($nab_personal[$i-1][$j] * (1 + ($return_personal[$i] / 100) + (($risk_personal[$i] / 100) * $tabel_norminv[$acak]) ),2);
        }
    }
       
    
  } else{ //jika sudah pensiun
    for($j=1;$j<=10000;$j++){ //monte carlo 10.000 iterasi
         $nab_personal[$i][$j]=0;
     }
  }
  
  //+++++++++++++++++++++++++++++++++
  //E.5., E.6., dan E.7. Hitung Montecarlo PERSONAL - hitung percentile 95, 50, dan 5 dari NAB
  //Input: NAB yang telah dihitung sebelumnya
  
  if($tranche_personal[$i] != "null"){ //jika masih belum pensiun
      $k=0;
      for ($j=1;$j<=10000;$j++){
        $percentile_temp1[$k]=$nab_personal[$i][$j]; //loading sementara isi dari NAB untuk kemudian di shorting
        $k++;
      }
      
      sort($percentile_temp1); //shorting array
      
      $k=0;
      for ($j=1;$j<=10000;$j++){
        $percentile_temp2[$j]=$percentile_temp1[$k]; //mengembalikan lagi ke urutan array yang telah disortir
        $k++;
      }
      
      	$percentile_95_nab_personal[$i]=$percentile_temp2[round(0.95 * 10000)]; //mengambil nilai percentile 95
	$percentile_50_nab_personal[$i]=$percentile_temp2[round(0.5 * 10000)]; //mengambil nilai percentile 50
	$percentile_05_nab_personal[$i]=$percentile_temp2[round(0.05 * 10000)]; //mengambil nilai percentile 5
    
      
  } else {
	$percentile_95_nab_personal[$i]=0; // nilai percentile 95 saat sudah pensiun
	$percentile_50_nab_personal[$i]=0; // nilai percentile 50 saat sudah pensiun
	$percentile_05_nab_personal[$i]=0; // nilai percentile 5 saat sudah pensiun
  }
  //Output: Create $percentile_95_nab_personal[$i], $percentile_50_nab_personal[$i], dan $percentile_05_nab_personal[$i]
}

//--------------------------------------------------------
//E.8., E.9., dan E.10. Hitung Montecarlo PERSONAL - hitung return dari Percentile NAB
//termasuk dengan convert monthly di E.11., E.12., dan E.13. Hitung Montecarlo PERSONAL - hitung return dari Percentile NAB - convert monthly
$jml=78; // jumlah tahun dari 2023 s.d. 2100
for ($i=1;$i<=$jml;$i++){
	if ($tranche_personal[$i] != "null"){ //jika masih belum pensiun
		if ($i==1){
			
			//tahunan
			$percentile_95_return_personal[$i]=($percentile_95_nab_personal[$i]/100)-1;
			$percentile_50_return_personal[$i]=($percentile_50_nab_personal[$i]/100)-1;
			$percentile_05_return_personal[$i]=($percentile_05_nab_personal[$i]/100)-1;
			
			//convert monthly
			$percentile_95_return_monthly_personal[$i]=((1+$percentile_95_return_personal[$i])^(1/12))-1;
			$percentile_50_return_monthly_personal[$i]=((1+$percentile_50_return_personal[$i])^(1/12))-1;
			$percentile_05_return_monthly_personal[$i]=((1+$percentile_05_return_personal[$i])^(1/12))-1;
		} else {
			
			//tahunan
			$percentile_95_return_personal[$i]=($percentile_95_nab_personal[$i]/$percentile_95_nab_personal[$i-1])-1;
			$percentile_50_return_personal[$i]=($percentile_50_nab_personal[$i]/$percentile_50_nab_personal[$i-1])-1;
			$percentile_05_return_personal[$i]=($percentile_05_nab_personal[$i]/$percentile_05_nab_personal[$i-1])-1;
			
			//convert monthly
			$percentile_95_return_monthly_personal[$i]=((1+$percentile_95_return_personal[$i])^(1/12))-1;
			$percentile_50_return_monthly_personal[$i]=((1+$percentile_50_return_personal[$i])^(1/12))-1;
			$percentile_05_return_monthly_personal[$i]=((1+$percentile_05_return_personal[$i])^(1/12))-1;
		}
	} else {
			$percentile_95_return_personal[$i]=0;
			$percentile_50_return_personal[$i]=0;
			$percentile_05_return_personal[$i]=0;
		
			$percentile_95_return_monthly_personal[$i]=0;
			$percentile_50_return_monthly_personal[$i]=0;
			$percentile_05_return_monthly_personal[$i]=0;	
	}
	//Output: Create $percentile_95_return_personal[$i], $percentile_50_return_personal[$i], $percentile_05_return_personal[$i], $percentile_95_return_monthly_personal[$i], $percentile_50_return_monthly_personal[$i], dan $percentile_05_return_monthly_personal[$i]
}


//---------------------------------------------------------
//F. Perhitungan Simulasi
//F.1. Simulasi Gaji dan PhDP
//Input: Read inputan user tentang gaji dan PhDP, tanggal input

$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
$bulan=4;//Read bulan input
$tahun=2023;// Read tahun input
$kode_input=($tahun*100)+$bulan; //untuk koding input

$gaji_input=10000000; //Read gaji yang diinput
$phdp_input=5000000; //Read phdp yang diinput

$gaji_naik=0.075;//Read kenaikan gaji di profile user
$phdp_naik=0.05;//Read kenaikan phdp di profile user


$j=2023; //tahun awal di database
$k=1;
$kode=($j*100)+$k; //untuk perbandingan kode input
for ($i=1;$i<=$jml;$i++){
	if($kode<$kode_input){
		if($k==12){
			$gaji[$i]=0;
			$phdp[$i]=0;
			
			$j=$j+1;
			$k=1;
			
			$kode=($j*100)+$k;
		} else{
			$gaji[$i]=0;
			$phdp[$i]=0;
			
			$k=$k+1;
			
			$kode=($j*100)+$k;
		}
	} else if ($kode==$kode_input){
		if($k==12){
			$gaji[$i]=$gaji_input;
			$phdp[$i]=$phdp_input;
			
			$j=$j+1;
			$k=1;
			
			$kode=($j*100)+$k;
		} else{
			$gaji[$i]=$gaji_input;
			$phdp[$i]=$phdp_input;
			
			$k=$k+1;
			
			$kode=($j*100)+$k;
		}
	} else {
		if($k==12){
			$gaji[$i]=$gaji[$i-1]*(1+$gaji_naik);
			$phdp[$i]=$phdp[$i-1]*(1+$phdp_naik);
			
			$j=$j+1;
			$k=1;
			
			$kode=($j*100)+$k;
		} else{
			$gaji[$i]=$gaji[$i-1];
			$phdp[$i]=$phdp[$i-1];
			
			$k=$k+1;
			
			$kode=($j*100)+$k;
		}
	}
//jangan lupa menghapus $gaji dan $phdp dengan update data 

}









?>

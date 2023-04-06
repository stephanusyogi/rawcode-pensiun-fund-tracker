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
    
    $masa_dinas_tahun[$i]=$tahun;
    $masa_dinas_bulan[$i]=$bulan;
    //Output: Create $masa_dinas_tahun[$i] dan $masa_dinas_bulan[$i] ke masing-masing tahun dan bulan di database masa dinas
    $bulan = $bulan +1;
  } else {
    if($bulan >=12){
      $bulan = 1;
      $tahun = $tahun+1;
    }
    $masa_dinas_tahun[$i]=$tahun;
    $masa_dinas_bulan[$i]=$bulan;
    //Output: Create $masa_dinas_tahun[$i] dan $masa_dinas_bulan[$i] ke masing-masing tahun dan bulan di database masa dinas
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
$z=1; //untuk konversi $flag_pensiun[$i] dari bulanan ke tahunan
for ($i=1;$i<=$jml;$i++){
  $sisa_kerja_tahun[$i]=10;//Read sisa masa kerja tahun setiap bulan januari
  $flag_pensiun[$z]=1;//Read flag pensiun setiap bulan januari
  $z=$z+12;
  
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

/*
$saldo_ppip_input=0; //numpang untuk mengisi saldo ppip, Read saldo ppip yang diinput
$saldo_personal_keuangan_input=0;//numpang untuk mengisi saldo personal keuangan, Read saldo keuangan keuangan yang diinput
$saldo_personal_properti_input=0;//numpang untuk mengisi saldo personal properti, Read saldo properti keuangan yang diinput
*/

//counter letak saldo ppip dan personal
$counter_saldo_ppip=0;
$counter_saldo_personal_keuangan=0;
$counter_saldo_personal_properti=0;



$gaji_naik=0.075;//Read kenaikan gaji di admin
$phdp_naik=0.05;//Read kenaikan phdp di admin

$j=2023; //tahun awal di database
$k=1;
$kode=($j*100)+$k; //untuk perbandingan kode input
for ($i=1;$i<=$jml;$i++){
	if($kode<$kode_input){
		if($k==12){
			$gaji[$i]=0;
			$phdp[$i]=0;
			
			/*
			$saldo_ppip_sementara=0; //numpang untuk mengisi saldo ppip
			$saldo_personal_keuangan[$i]=0;//numpang untuk mengisi saldo personal keuangan
			$saldo_personal_properti[$i]=0;//numpang untuk mengisi saldo personal properti
			*/
			
			$j=$j+1;
			$k=1;
			
			$kode=($j*100)+$k;
		} else{
			$gaji[$i]=0;
			$phdp[$i]=0;
			
			/*
			$saldo_ppip[$i]=0; //numpang untuk mengisi saldo ppip
			$saldo_personal_keuangan[$i]=0;//numpang untuk mengisi saldo personal keuangan
			$saldo_personal_properti[$i]=0;//numpang untuk mengisi saldo personal properti
			*/
			
			$k=$k+1;
			
			$kode=($j*100)+$k;
		}
	} else if ($kode==$kode_input){
		if($k==12){
			$gaji[$i]=$gaji_input;
			$phdp[$i]=$phdp_input;
			
			/*
			$saldo_ppip[$i]=$saldo_ppip_input; //numpang untuk mengisi saldo ppip
			$saldo_personal_keuangan[$i]=$saldo_personal_keuangan_input;//numpang untuk mengisi saldo personal keuangan
			$saldo_personal_properti[$i]=$saldo_personal_properti_input;//numpang untuk mengisi saldo personal properti
			*/
			
			$counter_saldo_ppip=$i; //numpang kode counter, untuk menandai mulai isi saldo di bulan ke berapa
			$counter_saldo_personal_keuangan=$i;//numpang kode counter, untuk menandai mulai isi saldo di bulan ke berapa
			$counter_saldo_personal_properti=$i;//numpang kode counter, untuk menandai mulai isi saldo di bulan ke berapa
			
			$j=$j+1;
			$k=1;
			
			$kode=($j*100)+$k;
		} else{
			$gaji[$i]=$gaji_input;
			$phdp[$i]=$phdp_input;
			
			/*
			$saldo_ppip[$i]=$saldo_ppip_input; //numpang untuk mengisi saldo ppip
			$saldo_personal_keuangan[$i]=$saldo_personal_keuangan_input;//numpang untuk mengisi saldo personal keuangan
			$saldo_personal_properti[$i]=$saldo_personal_properti_input;//numpang untuk mengisi saldo personal properti
			*/
			
			$k=$k+1;
			
			$kode=($j*100)+$k;
		}
	} else {
		if($k==12){
			$gaji[$i]=$gaji[$i-1]*(1+$gaji_naik);
			$phdp[$i]=$phdp[$i-1]*(1+$phdp_naik);
			
			/*
			$saldo_ppip[$i]=0; //numpang untuk mengisi saldo ppip
			$saldo_personal_keuangan[$i]=0;//numpang untuk mengisi saldo personal keuangan
			$saldo_personal_properti[$i]=0;//numpang untuk mengisi saldo personal properti
			*/
			
			$j=$j+1;
			$k=1;
			
			$kode=($j*100)+$k;
		} else{
			$gaji[$i]=$gaji[$i-1];
			$phdp[$i]=$phdp[$i-1];
			
			/*
			$saldo_ppip[$i]=0; //numpang untuk mengisi saldo ppip
			$saldo_personal_keuangan[$i]=0;//numpang untuk mengisi saldo personal keuangan
			$saldo_personal_properti[$i]=0;//numpang untuk mengisi saldo personal properti
			*/
			
			$k=$k+1;
			
			$kode=($j*100)+$k;
		}
	}
//jangan lupa menghapus $gaji[$i] dan $phdp[$i] dengan update data 

}

//---------------------------------------------------------
//F.2. Simulasi PPMP
//Input: variabel $phdp[$i] yang ada di memory, Read masa dinas tahun dan bulan, dan flag pensiun

$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
$date1=date_create("2018-02-06"); //Read tanggal diangkat
$date2=date_create("2015-01-01"); //tanggal cutoff pensiun hybrid. yang diangkat setelah 1 januari 2015 ppip murni, kalau sebelumnya hybrid ppmp dan ppip
$diff=date_diff($date1,$date2);

$hari=$diff->format('%R%a');

for ($i=1;$i<=$jml;$i++){
	if ($hari>0){ //hybrid ppmp ppip
		
		$status_mp=1;//untuk hybrid ppmp ppip
		
		if ($flag_pensiun[$i]==0){ //belum pensiun
			$masa_dinas_sementara=$masa_dinas_tahun[$i]+($masa_dinas_bulan[$i] / 12);
			$masa_dinas=min($masa_dinas_sementara,32); //maksimum masa dinas yang bisa diabsorb oleh ppmp adalah 32 tahun
			$jumlah_ppmp[$i]=0.025*$masa_dinas*$phdp[$i]; //rumus besar MP dalam PPMP
			$rr_ppmp[$i]=$jumlah_ppmp[$i] / $gaji[$i]; //rumus mencari replacement ratio dalam ppmp
			
			//Output: create $jumlah_ppmp[$i] dan $rr_ppmp[$i]
		
		} else { //sudah pensiun
			$jumlah_ppmp[$i]="null";
			$rr_ppmp[$i]="null";
			
			//Output: create $jumlah_ppmp[$i] dan $rr_ppmp[$i]
		}
		
	} else { //ppip murni
		$status_mp=2;//untuk ppip murni
		
		$jumlah_ppmp[$i]="null";
		$rr_ppmp[$i]="null";		
		
		//Output: create $jumlah_ppmp[$i] dan $rr_ppmp[$i]
	}
	
}

//---------------------------------------------------------
//F.3. Simulasi PPIP
//Input: variabel $gaji{$i] yang ada di memory serta flag pensiun, status mp yang sudah dihitung sebelumnya, Read tambahan iuran ppip, Read Saldo PPIP, Read pilihan pembayaran PPIP di profil user

//F.3.1. Simulasi PPIP - Hitung iuran

//menentukan besar iuran
if ($status_mp==1){ //hybrid ppmp ppip
	$persentase_iuran_ppip=0.09; //iuran ppip sebesar 9% untuk hybrid ppmp ppip
} else {
	$persentase_iuran_ppip=0.2; //iuran ppip sebesar 20% untuk ppip murni
}


//hitung iuran
$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
$persentase_tambahan_iuran_ppip=0.1;// Read tambahan iuran ppip di profil user

$saldo_ppip_input=0; // Read saldo ppip yang diinput (saldo diasumsikan diinput di awal bulan)

//nilai default pilihan pembayaran PPIP
//Input: Read pilihan pembayaran PPIP, Read kupon SBN/SBSN dan beserta pajak dari profil user, Read Harga anuitas dari profil user
//pembayaran PPIP jika 1=anuitas; 2=kupon SBN/SBSN

$pembayaran_ppip=1;//Read pilihan pembayaran PPIP (pembayaran PPIP jika 1=anuitas; 2=kupon SBN/SBSN)
if($pembayaran_ppip==1){
	$harga_anuitas_ppip =136;//Read harga anuitas masing-masing user
	
	$kupon_sbn_ppip =0.06125;//default
	$pajak_sbn_ppip =0.01;//default
} else {
	$harga_anuitas_ppip =136;//default
	
	$kupon_sbn_ppip =0.06125;//Read kupon SBN/SBSN dari profil user
	$pajak_sbn_ppip =0.01;//Read pajak SBN/SBSN dari profil user
}


$j=1; //counter hasil investasi percentile monthly (konversi dari tahunan ke bulanan)
for ($i=1;$i<=$jml;$i++){
	
	$iuran[$i]=$gaji[$i]*$persentase_iuran_ppip; //hitung besar iuran
	
	//+++++++++++++++++++++++++++++++++++++
	//F.3.2., F.3.3., dan F.3.4. Simulasi PPIP - tentukan hasil investasi percentile 95, 50, dan 05
	$percentile_95_return_ppip_bulanan[$i]=$percentile_95_return_monthly_ppip[$j]; //menentukan percentile secara bulanan dari yang sebelumnya tahunan di monte carlo PPIP
	$percentile_50_return_ppip_bulanan[$i]=$percentile_50_return_monthly_ppip[$j]; //menentukan percentile secara bulanan dari yang sebelumnya tahunan di monte carlo PPIP
	$percentile_05_return_ppip_bulanan[$i]=$percentile_05_return_monthly_ppip[$j]; //menentukan percentile secara bulanan dari yang sebelumnya tahunan di monte carlo PPIP
	
	if (fmod($i,12)==0){ //jika sudah bulan desember maka selanjutnya tahunnya bergeser
		$j=$j+1;
	}
	
	//+++++++++++++++++++++++++++++++++++++
	//F.3.5. Simulasi PPIP - tambahan iuran mandiri ppip
	$tambahan_iuran_ppip[$i]=$persentase_tambahan_iuran_ppip * $gaji[$i];
	
	
	//+++++++++++++++++++++++++++++++++++++
	//F.3.6., F.3.7., F.3.8., F.3.9., F.3.10., F.3.11., F.3.12., F.3.13., dan F.3.14. Simulasi PPIP - hitung percentile 95,50,05 untuk saldo awal, hasil pengembangan, dan saldo akhir
	if($i==$counter_saldo_ppip){ //tahun pertama ada saldonya
		
		//percentile 95
		$saldo_ppip_awal_p95[$i]=$saldo_ppip_input;
		$pengembangan_ppip_p95[$i]= ($saldo_ppip_awal_p95[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] )* $percentile_95_return_ppip_bulanan[$i];
		$saldo_ppip_akhir_p95[$i] = $saldo_ppip_awal_p95[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] + $pengembangan_ppip_p95[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 50
		$saldo_ppip_awal_p50[$i]=$saldo_ppip_input;
		$pengembangan_ppip_p50[$i]= ($saldo_ppip_awal_p50[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] )* $percentile_50_return_ppip_bulanan[$i];
		$saldo_ppip_akhir_p50[$i] = $saldo_ppip_awal_p50[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] + $pengembangan_ppip_p50[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 05
		$saldo_ppip_awal_p05[$i]=$saldo_ppip_input;
		$pengembangan_ppip_p05[$i]= ($saldo_ppip_awal_p05[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] )* $percentile_05_return_ppip_bulanan[$i];
		$saldo_ppip_akhir_p05[$i] = $saldo_ppip_awal_p05[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] + $pengembangan_ppip_p05[$i]; //saldo merupakan saldo akhir bulan
		
	} else if ($i>$counter_saldo_ppip) {
		//percentile 95
		$saldo_ppip_awal_p95[$i]=$saldo_ppip_akhir_p95[$i-1];
		$pengembangan_ppip_p95[$i]= ($saldo_ppip_awal_p95[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] )* $percentile_95_return_ppip_bulanan[$i];
		$saldo_ppip_akhir_p95[$i] = $saldo_ppip_awal_p95[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] + $pengembangan_ppip_p95[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 50
		$saldo_ppip_awal_p50[$i]=$saldo_ppip_akhir_p50[$i-1];
		$pengembangan_ppip_p50[$i]= ($saldo_ppip_awal_p50[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] )* $percentile_50_return_ppip_bulanan[$i];
		$saldo_ppip_akhir_p50[$i] = $saldo_ppip_awal_p50[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] + $pengembangan_ppip_p50[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 05
		$saldo_ppip_awal_p05[$i]=$saldo_ppip_akhir_p05[$i-1];
		$pengembangan_ppip_p05[$i]= ($saldo_ppip_awal_p05[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] )* $percentile_05_return_ppip_bulanan[$i];
		$saldo_ppip_akhir_p05[$i] = $saldo_ppip_awal_p05[$i] + $tambahan_iuran_ppip[$i] + $iuran[$i] + $pengembangan_ppip_p05[$i]; //saldo merupakan saldo akhir bulan
		
	} else{
		//percentile 95
		$saldo_ppip_awal_p95[$i]=0;
		$pengembangan_ppip_p95[$i]= 0;
		$saldo_ppip_akhir_p95[$i] = 0;
		 
		//percentile 50
		$saldo_ppip_awal_p50[$i]=0;
		$pengembangan_ppip_p50[$i]= 0;
		$saldo_ppip_akhir_p50[$i] = 0;
		 
		//percentile 05
		$saldo_ppip_awal_p05[$i]=0;
		$pengembangan_ppip_p05[$i]= 0;
		$saldo_ppip_akhir_p05[$i] = 0;
		 
	}
	
	//++++++++++++++++++++++++++++++++++++++++
	//F.3.15., F.3.16., dan F.3.17. Simulasi PPIP - Hitung anuitas bulanan untuk percentile 95, 50, dan 05 (hitung MP Bulanan bila dihitung menggunakan anuitas seumur hidup)
	
	
	$anuitas_ppip_p95[$i]=$saldo_ppip_akhir_p95[$i] / $harga_anuitas_ppip;
	$anuitas_ppip_p50[$i]=$saldo_ppip_akhir_p50[$i] / $harga_anuitas_ppip;
	$anuitas_ppip_p05[$i]=$saldo_ppip_akhir_p05[$i] / $harga_anuitas_ppip;
	
	
	//++++++++++++++++++++++++++++++++++++++++
	//F.3.18., F.3.19., dan F.3.20. Simulasi PPIP - Hitung kupon SBN/SBSN bulanan untuk percentile 95, 50, dan 05 (hitung MP Bulanan bila dihitung menggunakan kupon SBN/SBSN)
	
	
	$kupon_sbn_ppip_p95[$i]=( $saldo_ppip_akhir_p95[$i] * $kupon_sbn_ppip *(1-$pajak_sbn_ppip))/12; //pembayaran bulanan dari kupon SBN/SBSN percentile 95
	$kupon_sbn_ppip_p50[$i]=( $saldo_ppip_akhir_p50[$i] * $kupon_sbn_ppip *(1-$pajak_sbn_ppip))/12; //pembayaran bulanan dari kupon SBN/SBSN percentile 50
	$kupon_sbn_ppip_p05[$i]=( $saldo_ppip_akhir_p05[$i] * $kupon_sbn_ppip *(1-$pajak_sbn_ppip))/12; //pembayaran bulanan dari kupon SBN/SBSN percentile 05
	
	//++++++++++++++++++++++++++++++++++++++++
	//F.3.21., F.3.22., F.3.23., F.3.24., F.3.25., dan F.3.26., Hitung RR untuk anuitas dan kupon SBN/SBSN pada percentile 95, 50, dan 05
	
	if ($gaji[$i]>0){
		
		//untuk anuitas
		$rr_ppip_anuitas_p95[$i] = $anuitas_ppip_p95[$i] / $gaji[$i];
		$rr_ppip_anuitas_p50[$i] = $anuitas_ppip_p50[$i] / $gaji[$i];
		$rr_ppip_anuitas_p05[$i] = $anuitas_ppip_p05[$i] / $gaji[$i];
		
		//untuk kupon SBN/SBSN
		$rr_ppip_kupon_sbn_p95[$i] = $kupon_sbn_ppip_p95[$i] / $gaji[$i];
		$rr_ppip_kupon_sbn_p50[$i] = $kupon_sbn_ppip_p50[$i] / $gaji[$i];
		$rr_ppip_kupon_sbn_p05[$i] = $kupon_sbn_ppip_p05[$i] / $gaji[$i];
		
	} else{
		//untuk anuitas
		$rr_ppip_anuitas_p95[$i] = 0;
		$rr_ppip_anuitas_p50[$i] = 0;
		$rr_ppip_anuitas_p05[$i] = 0;
		
		//untuk kupon SBN/SBSN
		$rr_ppip_kupon_sbn_p95[$i] = 0;
		$rr_ppip_kupon_sbn_p50[$i] = 0;
		$rr_ppip_kupon_sbn_p05[$i] = 0;
	}
		
	//Output: Create $iuran[$i], $tambahan_iuran_ppip[$i], $percentile_95_return_ppip_bulanan[$i], $percentile_50_return_ppip_bulanan[$i], $percentile_05_return_ppip_bulanan[$i]
	//output: Create $saldo_ppip_awal_p95[$i], $pengembangan_ppip_p95[$i], $saldo_ppip_akhir_p95[$i], $saldo_ppip_awal_p50[$i], $pengembangan_ppip_p50[$i], $saldo_ppip_akhir_p50[$i], $saldo_ppip_awal_p05[$i], $pengembangan_ppip_p05[$i], $saldo_ppip_akhir_p05[$i]
	//Output: Create $anuitas_ppip_p95[$i], $anuitas_ppip_p50[$i], $anuitas_ppip_p05[$i], $kupon_sbn_ppip_p95[$i], $kupon_sbn_ppip_p50[$i], $kupon_sbn_ppip_p05[$i]
	//Output: Create $rr_ppip_anuitas_p95[$i], $rr_ppip_anuitas_p50[$i], $rr_ppip_anuitas_p05[$i], $rr_ppip_kupon_sbn_p95[$i], $rr_ppip_kupon_sbn_p50[$i], $rr_ppip_kupon_sbn_p05[$i]
	
}


//----------------------------------------------
//F.4. Simulasi Personal Properti
//F.4.1. dan F.4.2. Simulasi Properti - Hitung harga dan sewa properti
//Input: Read harga properti, sewa tahunan, kenaikan harga properti, dan kenaikan harga sewa di profil user

$saldo_personal_properti_input=0;// Read harga properti keuangan yang diinput di profil user
$sewa_personal_properti_input=0;// Read harga properti keuangan yang diinput di profil user

$naik_harga_properti=0.1; // Read kenaikan harga properti keuangan yang diinput di profil user
$naik_sewa_properti=0.1; // Read kenaikan sewa properti keuangan yang diinput di profil user


$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100


for ($i=1;$i<=$jml;$i++){
	if($i==$counter_saldo_personal_properti){ //tahun pertama ada saldonya
		
		$harga_properti[$i]=$saldo_personal_properti_input;
		$sewa_properti[$i]=$sewa_personal_properti_input;
		
	} else if ($i>$counter_saldo_personal_properti) {
		
		if (fmod($i,12)==1){ //jika sudah bulan januari maka harga rumah dan sewa naik
			
			$harga_properti[$i]=$harga_properti[$i-1]*(1+$naik_harga_properti);
			$sewa_properti[$i]=$sewa_properti[$i-1]*(1+$naik_sewa_properti);
			
		} else {
			
			$harga_properti[$i]=$harga_properti[$i-1];
			$sewa_properti[$i]=$sewa_properti[$i-1];
			
		}
		
	} else {
		
		$harga_properti[$i]=0;
		$sewa_properti[$i]=0;
			
	}

	//+++++++++++++++++++++++++++++++++++
	//F.4.3. Simulasi Properti - Hitung RR Properti
	if ($gaji[$i]>0){
		$rr_personal_properti[$i]=($sewa_properti[$i] / 12) / $gaji[$i];
	} else {
		$rr_personal_properti[$i]=0;
	}
}


//---------------------------------------------------------
//F.5. Simulasi PERSONAL_KEUANGAN
//Input: variabel $gaji{$i] yang ada di memory serta flag pensiun, Read tambahan iuran personal_keuangan, Read Saldo PERSONAL_KEUANGAN

//F.5.1. Simulasi PERSONAL_KEUANGAN - Hitung iuran

$persentase_iuran_personal_keuangan=0.05; //Read besar iuran personal keuangan di profil user
$saldo_personal_keuangan_input=0; // Read saldo personal_keuangan yang diinput (saldo diasumsikan diinput di awal bulan)

$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100

//nilai default pilihan pembayaran personal keuangan
//Input: Read pilihan pembayaran personal keuangan, Read kupon SBN/SBSN dan beserta pajak dari profil user, Read Harga anuitas dari profil user
//pembayaran personal_keuangan jika 1=anuitas; 2=kupon SBN/SBSN

$pembayaran_personal_keuangan=1;//Read pilihan pembayaran personal_keuangan (pembayaran personal_keuangan jika 1=anuitas; 2=kupon SBN/SBSN)
if($pembayaran_personal_keuangan==1){
	$harga_anuitas_personal_keuangan =136;//Read harga anuitas masing-masing user
	
	$kupon_sbn_personal_keuangan =0.06125;//default
	$pajak_sbn_personal_keuangan =0.01;//default
} else {
	$harga_anuitas_personal_keuangan =136;//default
	
	$kupon_sbn_personal_keuangan =0.06125;//Read kupon SBN/SBSN dari profil user
	$pajak_sbn_personal_keuangan =0.01;//Read pajak SBN/SBSN dari profil user
}

$j=1; //counter hasil investasi percentile monthly (konversi dari tahunan ke bulanan)
for ($i=1;$i<=$jml;$i++){
	
	$iuran_personal_keuangan[$i]=$gaji[$i]*$persentase_iuran_personal_keuangan; //hitung besar iuran
	
	//+++++++++++++++++++++++++++++++++++++
	//F.5.2., F.5.3., dan F.5.4. Simulasi PERSONAL_KEUANGAN - tentukan hasil investasi percentile 95, 50, dan 05
	$percentile_95_return_personal_bulanan[$i]=$percentile_95_return_monthly_personal[$j]; //menentukan percentile secara bulanan dari yang sebelumnya tahunan di monte carlo PERSONAL_KEUANGAN
	$percentile_50_return_personal_bulanan[$i]=$percentile_50_return_monthly_personal[$j]; //menentukan percentile secara bulanan dari yang sebelumnya tahunan di monte carlo PERSONAL_KEUANGAN
	$percentile_05_return_personal_bulanan[$i]=$percentile_05_return_monthly_personal[$j]; //menentukan percentile secara bulanan dari yang sebelumnya tahunan di monte carlo PERSONAL_KEUANGAN
	
	if (fmod($i,12)==0){ //jika sudah bulan desember maka selanjutnya tahunnya bergeser
		$j=$j+1;
	}
	
		
	//+++++++++++++++++++++++++++++++++++++
	//F.5.5., F.5.6., F.5.7., F.5.8., F.5.9., F.5.10., F.5.11., F.5.12., dan F.5.13. Simulasi PERSONAL_KEUANGAN - hitung percentile 95,50,05 untuk saldo awal, hasil pengembangan, dan saldo akhir
	if($i==$counter_saldo_personal_keuangan){ //tahun pertama ada saldonya
		
		//percentile 95
		$saldo_personal_keuangan_awal_p95[$i]=$saldo_personal_keuangan_input;
		$pengembangan_personal_keuangan_p95[$i]= ($saldo_personal_keuangan_awal_p95[$i] + $iuran_personal_keuangan[$i] )* $percentile_95_return_personal_keuangan_bulanan[$i];
		$saldo_personal_keuangan_akhir_p95[$i] = $saldo_personal_keuangan_awal_p95[$i] + $iuran_personal_keuangan[$i] + $pengembangan_personal_keuangan_p95[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 50
		$saldo_personal_keuangan_awal_p50[$i]=$saldo_personal_keuangan_input;
		$pengembangan_personal_keuangan_p50[$i]= ($saldo_personal_keuangan_awal_p50[$i] + $iuran_personal_keuangan[$i] )* $percentile_50_return_personal_keuangan_bulanan[$i];
		$saldo_personal_keuangan_akhir_p50[$i] = $saldo_personal_keuangan_awal_p50[$i] + $iuran_personal_keuangan[$i] + $pengembangan_personal_keuangan_p50[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 05
		$saldo_personal_keuangan_awal_p05[$i]=$saldo_personal_keuangan_input;
		$pengembangan_personal_keuangan_p05[$i]= ($saldo_personal_keuangan_awal_p05[$i] + $iuran_personal_keuangan[$i] )* $percentile_05_return_personal_keuangan_bulanan[$i];
		$saldo_personal_keuangan_akhir_p05[$i] = $saldo_personal_keuangan_awal_p05[$i] + $iuran_personal_keuangan[$i] + $pengembangan_personal_keuangan_p05[$i]; //saldo merupakan saldo akhir bulan
		
	} else if ($i>$counter_saldo_personal_keuangan) {
		//percentile 95
		$saldo_personal_keuangan_awal_p95[$i]=$saldo_personal_keuangan_akhir_p95[$i-1];
		$pengembangan_personal_keuangan_p95[$i]= ($saldo_personal_keuangan_awal_p95[$i] + $iuran_personal_keuangan[$i] )* $percentile_95_return_personal_keuangan_bulanan[$i];
		$saldo_personal_keuangan_akhir_p95[$i] = $saldo_personal_keuangan_awal_p95[$i] + $iuran_personal_keuangan[$i] + $pengembangan_personal_keuangan_p95[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 50
		$saldo_personal_keuangan_awal_p50[$i]=$saldo_personal_keuangan_akhir_p50[$i-1];
		$pengembangan_personal_keuangan_p50[$i]= ($saldo_personal_keuangan_awal_p50[$i] + $iuran_personal_keuangan[$i] )* $percentile_50_return_personal_keuangan_bulanan[$i];
		$saldo_personal_keuangan_akhir_p50[$i] = $saldo_personal_keuangan_awal_p50[$i] + $iuran_personal_keuangan[$i] + $pengembangan_personal_keuangan_p50[$i]; //saldo merupakan saldo akhir bulan
		
		//percentile 05
		$saldo_personal_keuangan_awal_p05[$i]=$saldo_personal_keuangan_akhir_p05[$i-1];
		$pengembangan_personal_keuangan_p05[$i]= ($saldo_personal_keuangan_awal_p05[$i] + $iuran_personal_keuangan[$i] )* $percentile_05_return_personal_keuangan_bulanan[$i];
		$saldo_personal_keuangan_akhir_p05[$i] = $saldo_personal_keuangan_awal_p05[$i] + $iuran_personal_keuangan[$i] + $pengembangan_personal_keuangan_p05[$i]; //saldo merupakan saldo akhir bulan
		
	} else{
		//percentile 95
		$saldo_personal_keuangan_awal_p95[$i]=0;
		$pengembangan_personal_keuangan_p95[$i]= 0;
		$saldo_personal_keuangan_akhir_p95[$i] = 0;
		 
		//percentile 50
		$saldo_personal_keuangan_awal_p50[$i]=0;
		$pengembangan_personal_keuangan_p50[$i]= 0;
		$saldo_personal_keuangan_akhir_p50[$i] = 0;
		 
		//percentile 05
		$saldo_personal_keuangan_awal_p05[$i]=0;
		$pengembangan_personal_keuangan_p05[$i]= 0;
		$saldo_personal_keuangan_akhir_p05[$i] = 0;
		 
	}
	
	//++++++++++++++++++++++++++++++++++++++++
	//F.5.14., F.5.15., dan F.5.16. Simulasi PERSONAL_KEUANGAN - Hitung anuitas bulanan untuk percentile 95, 50, dan 05 (hitung MP Bulanan bila dihitung menggunakan anuitas seumur hidup)
		
	$anuitas_personal_keuangan_p95[$i]=$saldo_personal_keuangan_akhir_p95[$i] / $harga_anuitas_personal_keuangan;
	$anuitas_personal_keuangan_p50[$i]=$saldo_personal_keuangan_akhir_p50[$i] / $harga_anuitas_personal_keuangan;
	$anuitas_personal_keuangan_p05[$i]=$saldo_personal_keuangan_akhir_p05[$i] / $harga_anuitas_personal_keuangan;
	
	
	//++++++++++++++++++++++++++++++++++++++++
	//F.5.17., F.5.18., dan F.5.19. Simulasi PERSONAL_KEUANGAN - Hitung kupon SBN/SBSN bulanan untuk percentile 95, 50, dan 05 (hitung MP Bulanan bila dihitung menggunakan kupon SBN/SBSN)
		
	$kupon_sbn_personal_keuangan_p95[$i]=( $saldo_personal_keuangan_akhir_p95[$i] * $kupon_sbn_personal_keuangan *(1-$pajak_sbn_personal_keuangan))/12; //pembayaran bulanan dari kupon SBN/SBSN percentile 95
	$kupon_sbn_personal_keuangan_p50[$i]=( $saldo_personal_keuangan_akhir_p50[$i] * $kupon_sbn_personal_keuangan *(1-$pajak_sbn_personal_keuangan))/12; //pembayaran bulanan dari kupon SBN/SBSN percentile 50
	$kupon_sbn_personal_keuangan_p05[$i]=( $saldo_personal_keuangan_akhir_p05[$i] * $kupon_sbn_personal_keuangan *(1-$pajak_sbn_personal_keuangan))/12; //pembayaran bulanan dari kupon SBN/SBSN percentile 05
	
	//++++++++++++++++++++++++++++++++++++++++
	//F.5.20., F.5.21., F.5.22., F.5.23., F.5.24., dan F.5.25., Hitung RR untuk anuitas dan kupon SBN/SBSN pada percentile 95, 50, dan 05
	
	if ($gaji[$i]>0){
		
		//untuk anuitas
		$rr_personal_keuangan_anuitas_p95[$i] = $anuitas_personal_keuangan_p95[$i] / $gaji[$i];
		$rr_personal_keuangan_anuitas_p50[$i] = $anuitas_personal_keuangan_p50[$i] / $gaji[$i];
		$rr_personal_keuangan_anuitas_p05[$i] = $anuitas_personal_keuangan_p05[$i] / $gaji[$i];
		
		//untuk kupon SBN/SBSN
		$rr_personal_keuangan_kupon_sbn_p95[$i] = $kupon_sbn_personal_keuangan_p95[$i] / $gaji[$i];
		$rr_personal_keuangan_kupon_sbn_p50[$i] = $kupon_sbn_personal_keuangan_p50[$i] / $gaji[$i];
		$rr_personal_keuangan_kupon_sbn_p05[$i] = $kupon_sbn_personal_keuangan_p05[$i] / $gaji[$i];
		
	} else{
		//untuk anuitas
		$rr_personal_keuangan_anuitas_p95[$i] = 0;
		$rr_personal_keuangan_anuitas_p50[$i] = 0;
		$rr_personal_keuangan_anuitas_p05[$i] = 0;
		
		//untuk kupon SBN/SBSN
		$rr_personal_keuangan_kupon_sbn_p95[$i] = 0;
		$rr_personal_keuangan_kupon_sbn_p50[$i] = 0;
		$rr_personal_keuangan_kupon_sbn_p05[$i] = 0;
	}
		
	//Output: Create $iuran_personal_keuangan[$i], $percentile_95_return_personal_keuangan_bulanan[$i], $percentile_50_return_personal_keuangan_bulanan[$i], $percentile_05_return_personal_keuangan_bulanan[$i]
	//output: Create $saldo_personal_keuangan_awal_p95[$i], $pengembangan_personal_keuangan_p95[$i], $saldo_personal_keuangan_akhir_p95[$i], $saldo_personal_keuangan_awal_p50[$i], $pengembangan_personal_keuangan_p50[$i], $saldo_personal_keuangan_akhir_p50[$i], $saldo_personal_keuangan_awal_p05[$i], $pengembangan_personal_keuangan_p05[$i], $saldo_personal_keuangan_akhir_p05[$i]
	//Output: Create $anuitas_personal_keuangan_p95[$i], $anuitas_personal_keuangan_p50[$i], $anuitas_personal_keuangan_p05[$i], $kupon_sbn_personal_keuangan_p95[$i], $kupon_sbn_personal_keuangan_p50[$i], $kupon_sbn_personal_keuangan_p05[$i]
	//Output: Create $rr_personal_keuangan_anuitas_p95[$i], $rr_personal_keuangan_anuitas_p50[$i], $rr_personal_keuangan_anuitas_p05[$i], $rr_personal_keuangan_kupon_sbn_p95[$i], $rr_personal_keuangan_kupon_sbn_p50[$i], $rr_personal_keuangan_kupon_sbn_p05[$i]
	
}

//----------------------------------------------------------------------------
//G.1. Hitung indikator dashboard - lokasi pensiun
//Input: Read flag pensiun

$jml=936; // jumlah bulan dari januari 2023 s.d. desember 2100
$counter_pensiun=0; //counter posisi pensiun

for ($i=1;$i<=$jml;$i++){
	if ($i==1){
		if ($flag_pensiun[$i]==1){
			$counter_pensiun=$i;// pada saat bulan ini sudah pensiun. jadi saldo yang ditampilkan adalah saldo awal
		}
	} else {
		if ($flag_pensiun[$i]==1 && $flag_pensiun[$i-1]==0){
			$counter_pensiun=$i; // pada saat bulan ini sudah pensiun. jadi saldo yang ditampilkan adalah saldo akhir untuk bulan sebelumnya.
		}
	}
	//$flag_pensiun[$i]=1;//sudah pensiun
}

//----------------------------------------------------------------------------
//G.2. Hitung indikator dashboard - posisi saat pensiun

//++++++++++++++++++++++++++++++++
//G.2.1. RR pada dashboard

//pembayaran PPIP jika 1=anuitas; 2=kupon SBN/SBSN
if($pembayaran_ppip==1){

	$dashboard_rr_ppip_min=$rr_ppip_anuitas_p05[$counter_pensiun - 1];
	$dashboard_rr_ppip_med=$rr_ppip_anuitas_p50[$counter_pensiun - 1];
	$dashboard_rr_ppip_max=$rr_ppip_anuitas_p95[$counter_pensiun - 1];
		
} else {
	
	$dashboard_rr_ppip_min=$rr_ppip_kupon_sbn_p05[$counter_pensiun - 1];
	$dashboard_rr_ppip_med=$rr_ppip_kupon_sbn_p50[$counter_pensiun - 1];
	$dashboard_rr_ppip_max=$rr_ppip_kupon_sbn_p95[$counter_pensiun - 1];
}

//pembayaran personal keuangan jika 1=anuitas; 2=kupon SBN/SBSN
if($pembayaran_personal_keuangan==1){

	$dashboard_rr_personal_keuangan_min=$rr_personal_keuangan_anuitas_p05[$counter_pensiun - 1];
	$dashboard_rr_personal_keuangan_med=$rr_personal_keuangan_anuitas_p50[$counter_pensiun - 1];
	$dashboard_rr_personal_keuangan_max=$rr_personal_keuangan_anuitas_p95[$counter_pensiun - 1];
		
} else {
	
	$dashboard_rr_personal_keuangan_min=$rr_personal_keuangan_kupon_sbn_p05[$counter_pensiun - 1];
	$dashboard_rr_personal_keuangan_med=$rr_personal_keuangan_kupon_sbn_p50[$counter_pensiun - 1];
	$dashboard_rr_personal_keuangan_max=$rr_personal_keuangan_kupon_sbn_p95[$counter_pensiun - 1];
}

$dashboard_rr_personal_properti=$rr_personal_properti[$counter_pensiun - 1];

//total rr
//$status_mp=1 untuk hybrid ppmp ppip dan $status_mp=2 untuk ppip murni
if ($status_mp==1){
	$dashboard_rr_ppmp=$rr_ppmp[$counter_pensiun - 1];
	
	$dashboard_rr_total_min=$dashboard_rr_ppmp +  $dashboard_rr_ppip_min + $dashboard_rr_personal_keuangan_min + $dashboard_rr_personal_properti;
	$dashboard_rr_total_med=$dashboard_rr_ppmp +  $dashboard_rr_ppip_med + $dashboard_rr_personal_keuangan_med + $dashboard_rr_personal_properti;
	$dashboard_rr_total_max=$dashboard_rr_ppmp +  $dashboard_rr_ppip_max + $dashboard_rr_personal_keuangan_max + $dashboard_rr_personal_properti;

} else {
	$dashboard_rr_total_min=$dashboard_rr_ppip_min + $dashboard_rr_personal_keuangan_min + $dashboard_rr_personal_properti;
	$dashboard_rr_total_med=$dashboard_rr_ppip_med + $dashboard_rr_personal_keuangan_med + $dashboard_rr_personal_properti;
	$dashboard_rr_total_max=$dashboard_rr_ppip_max + $dashboard_rr_personal_keuangan_max + $dashboard_rr_personal_properti;
}

//++++++++++++++++++++++++++++++++
//G.2.2. Penghasilan Bulanan pada dashboard

//pembayaran PPIP jika 1=anuitas; 2=kupon SBN/SBSN
if($pembayaran_ppip==1){

	$dashboard_penghasilan_bulanan_ppip_min=$anuitas_ppip_p05[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_ppip_med=$anuitas_ppip_p50[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_ppip_max=$anuitas_ppip_p95[$counter_pensiun - 1];
		
} else {
	
	$dashboard_penghasilan_bulanan_ppip_min=$kupon_sbn_ppip_p05[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_ppip_med=$kupon_sbn_ppip_p50[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_ppip_max=$kupon_sbn_ppip_p95[$counter_pensiun - 1];
}

//pembayaran personal keuangan jika 1=anuitas; 2=kupon SBN/SBSN
if($pembayaran_personal_keuangan==1){

	$dashboard_penghasilan_bulanan_personal_keuangan_min=$anuitas_personal_keuangan_p05[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_personal_keuangan_med=$anuitas_personal_keuangan_p50[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_personal_keuangan_max=$anuitas_personal_keuangan_p95[$counter_pensiun - 1];
		
} else {
	
	$dashboard_penghasilan_bulanan_personal_keuangan_min=$kupon_sbn_personal_keuangan_p05[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_personal_keuangan_med=$kupon_sbn_personal_keuangan_p50[$counter_pensiun - 1];
	$dashboard_penghasilan_bulanan_personal_keuangan_max=$kupon_sbn_personal_keuangan_p95[$counter_pensiun - 1];
}

$dashboard_penghasilan_bulanan_personal_properti=$sewa_properti[$counter_pensiun - 1] / 12;

//total penghasilan bulanan
//$status_mp=1 untuk hybrid ppmp ppip dan $status_mp=2 untuk ppip murni
if ($status_mp==1){
	$dashboard_penghasilan_bulanan_ppmp=$jumlah_ppmp[$counter_pensiun - 1];
	
	$dashboard_penghasilan_bulanan_total_min=$dashboard_penghasilan_bulanan_ppmp +  $dashboard_penghasilan_bulanan_ppip_min + $dashboard_penghasilan_bulanan_personal_keuangan_min + $dashboard_penghasilan_bulanan_personal_properti;
	$dashboard_penghasilan_bulanan_total_med=$dashboard_penghasilan_bulanan_ppmp +  $dashboard_penghasilan_bulanan_ppip_med + $dashboard_penghasilan_bulanan_personal_keuangan_med + $dashboard_penghasilan_bulanan_personal_properti;
	$dashboard_penghasilan_bulanan_total_max=$dashboard_penghasilan_bulanan_ppmp +  $dashboard_penghasilan_bulanan_ppip_max + $dashboard_penghasilan_bulanan_personal_keuangan_max + $dashboard_penghasilan_bulanan_personal_properti;

} else {
	$dashboard_penghasilan_bulanan_total_min=$dashboard_penghasilan_bulanan_ppip_min + $dashboard_penghasilan_bulanan_personal_keuangan_min + $dashboard_penghasilan_bulanan_personal_properti;
	$dashboard_penghasilan_bulanan_total_med=$dashboard_penghasilan_bulanan_ppip_med + $dashboard_penghasilan_bulanan_personal_keuangan_med + $dashboard_penghasilan_bulanan_personal_properti;
	$dashboard_penghasilan_bulanan_total_max=$dashboard_penghasilan_bulanan_ppip_max + $dashboard_penghasilan_bulanan_personal_keuangan_max + $dashboard_penghasilan_bulanan_personal_properti;
}

//++++++++++++++++++++++++++++++++
//G.2.3. present value Penghasilan Bulanan pada dashboard
//Input: Read sisa masa kerja saat membuka
$tahun_ini=2023;//Read current date untuk tahun
$bulan_ini=4;////Read current date untuk bulan
#inflasi=0.04;//Read asumsi inflasi yang di admin

$tahun=$sisa_kerja_tahun[$i];//Read sisa masa kerja tahun untuk current date
$bulan= $sisa_kerja_bulan[$i];//Read sisa masa kerja bulan untuk current date

$dashboard_penghasilan_bulanan_ppip_min_pv=$dashboard_penghasilan_bulanan_ppip_min / ((1+$inflasi)^($tahun+($bulan/12)));
$dashboard_penghasilan_bulanan_ppip_med_pv=$dashboard_penghasilan_bulanan_ppip_med / ((1+$inflasi)^($tahun+($bulan/12)));
$dashboard_penghasilan_bulanan_ppip_max_pv=$dashboard_penghasilan_bulanan_ppip_max / ((1+$inflasi)^($tahun+($bulan/12)));

$dashboard_penghasilan_bulanan_personal_keuangan_min_pv=$dashboard_penghasilan_bulanan_personal_keuangan_min / ((1+$inflasi)^($tahun+($bulan/12)));
$dashboard_penghasilan_bulanan_personal_keuangan_med_pv=$dashboard_penghasilan_bulanan_personal_keuangan_min / ((1+$inflasi)^($tahun+($bulan/12)));
$dashboard_penghasilan_bulanan_personal_keuangan_max_pv=$dashboard_penghasilan_bulanan_personal_keuangan_min / ((1+$inflasi)^($tahun+($bulan/12)));

$dashboard_penghasilan_bulanan_personal_properti_pv=$dashboard_penghasilan_bulanan_personal_properti / ((1+$inflasi)^($tahun+($bulan/12)));

//total penghasilan bulanan
//$status_mp=1 untuk hybrid ppmp ppip dan $status_mp=2 untuk ppip murni
if ($status_mp==1){
	$dashboard_penghasilan_bulanan_ppmp_pv=$dashboard_penghasilan_bulanan_ppmp / ((1+$inflasi)^($tahun+($bulan/12)));
	
	$dashboard_penghasilan_bulanan_total_min_pv=$dashboard_penghasilan_bulanan_ppmp_pv +  $dashboard_penghasilan_bulanan_ppip_min_pv + $dashboard_penghasilan_bulanan_personal_keuangan_min_pv + $dashboard_penghasilan_bulanan_personal_properti_pv;
	$dashboard_penghasilan_bulanan_total_med_pv=$dashboard_penghasilan_bulanan_ppmp_pv +  $dashboard_penghasilan_bulanan_ppip_med_pv + $dashboard_penghasilan_bulanan_personal_keuangan_med_pv + $dashboard_penghasilan_bulanan_personal_properti_pv;
	$dashboard_penghasilan_bulanan_total_max_pv=$dashboard_penghasilan_bulanan_ppmp_pv +  $dashboard_penghasilan_bulanan_ppip_max_pv + $dashboard_penghasilan_bulanan_personal_keuangan_max_pv + $dashboard_penghasilan_bulanan_personal_properti_pv;

} else {
	$dashboard_penghasilan_bulanan_total_min_pv=$dashboard_penghasilan_bulanan_ppip_min_pv + $dashboard_penghasilan_bulanan_personal_keuangan_min_pv + $dashboard_penghasilan_bulanan_personal_properti_pv;
	$dashboard_penghasilan_bulanan_total_med_pv=$dashboard_penghasilan_bulanan_ppip_med_pv + $dashboard_penghasilan_bulanan_personal_keuangan_med_pv + $dashboard_penghasilan_bulanan_personal_properti_pv;
	$dashboard_penghasilan_bulanan_total_max_pv=$dashboard_penghasilan_bulanan_ppip_max_pv + $dashboard_penghasilan_bulanan_personal_keuangan_max_pv + $dashboard_penghasilan_bulanan_personal_properti_pv;

}




?>

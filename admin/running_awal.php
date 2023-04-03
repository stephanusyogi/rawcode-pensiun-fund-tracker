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
$pilihan_ppip=1;//Read portofolio PPIP yang dipilih

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
  if($sisa_kerja_tahun[$i]>2){
    $tranche_ppip[$i]="investasi";//untuk sebelum 2 tahun sisa masa kerja, masuk ke tranche investasi
    $return_ppip[$i]=1;//read return portofolio dari PPIP dengan $pilihan_ppip dan tranche investasi
    $risk_ppip[$i]=1;//read risk portofolio dari PPIP dengan $pilihan_ppip dan tranche investasi
  } else if ($sisa_kerja_tahun[$i]<=2 && $flag_pensiun[$i] == 0 ){
    $tranche_ppip[$i]="likuiditas";//untuk setelah 2 tahun sisa masa kerja, masuk ke tranche likuiditas
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
            $nab[$i][$j]=round(100 * (1 + ($return_ppip[$i] / 100) + (($risk_ppip[$i] / 100) * $tabel_norminv[$acak]) ),2);
        } else{
          
            $acak= mt_rand(1,10000); //generate angka acak dari 1 s.d. 10.000. (angka acak sesuai dengan primary key dari tabel normal inverse dalam database)
            $nab[$i][$j]=round($nab[$i-1][$j] * (1 + ($return_ppip[$i] / 100) + (($risk_ppip[$i] / 100) * $tabel_norminv[$acak]) ),2);
        }
    }
       
     }
  } else{ //jika sudah pensiun
    for($j=1;$j<=10000;$j++){ //monte carlo 10.000 iterasi
         $nab[$i][$j]=0;
     }
  }
}








?>

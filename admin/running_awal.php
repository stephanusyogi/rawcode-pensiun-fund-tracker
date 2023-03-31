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
$jml=924; // jumlah bulan dari januari 2023 s.d. desember 2100
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
$jml=924; // jumlah bulan dari januari 2023 s.d. desember 2100
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
    
    $jml=924; // jumlah bulan dari januari 2023 s.d. desember 2100
   
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
    
    
    
    
    
    
    
//C.3.1. cek sisa masa dinas
    //
?>
    
    
    
    
    

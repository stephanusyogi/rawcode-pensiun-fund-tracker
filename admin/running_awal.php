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


//C.1. Simulasi Basic - hitung usia (usia diisi dari januari 2023 s.d. desember 2100
//input: Read tanggal lahir
$jml=924; // jumlah bulan dari januari 2023 s.d. desember 2100
$date1=date_create("1992-06-24"); //Read tanggal lahir
$date2=date_create("2023-01-01"); //januari 2023
$diff=date_diff($date1,$date2);
 
 $tahun=$diff->format('%y');
 $bulan=$diff->format('%m');

for ($i=1;$i<=$jml;$i++){
  
  
  //Output: Create $tahun dan $bulan ke masing-masing tahun dan bulan
  if($bulan = 12){
    $bulan = $bulan +1;
    
    {
   
}



?>

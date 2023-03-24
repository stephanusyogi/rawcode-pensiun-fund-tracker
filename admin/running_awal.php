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



?>

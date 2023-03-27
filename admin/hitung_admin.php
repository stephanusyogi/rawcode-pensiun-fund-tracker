<?php 
  
//A.1. Hitung Return Portofolio PPIP
//Input: Read Return, Risk, Korelasi, Komposisi tranche investasi, komposisi tranche likuiditas masing-masing portofolio
$jml_port_ppip=4; //Read jumlah portofolio ppipyang diinput oleh admin

for($i=1;$i<=$jml_port_ppip;$i++){
  //$i mencerminkan id dari portofolio ppip 
  
  $return_saham_ppip[$i]=0.13; //Read return saham
  $return_fi_ppip[$i]=0.13; //Read return pendapatan tetap
  $return_depo_ppip[$i]=0.13; //Read return deposito
  
  $risk_saham_ppip[$i]=0.13; //Read risk saham
  $risk_fi_ppip[$i]=0.13; //Read risk pendapatan tetap
  $risk_depo_ppip[$i]=0.13; //Read risk deposito
  
  $korel_saham_fi_ppip[$i]=0.13; //Read korelasi saham - pendapatan tetap
  $korel_saham_depo_ppip[$i]=0.13; //Read korelasi saham - deposito
  $korel_fi_depo_ppip[$i]=0.13; //Read korelasi pendapatan tetap - deposito
  
  $komposisi_inv_saham_ppip[$i]=0.13; //Read komposisi saham tranche investasi
  $komposisi_inv_fi_ppip[$i]=0.13; //Read komposisi pendapatan tetap tranche investasi
  $komposisi_inv_depo_ppip[$i]=0.13; //Read komposisi deposito tranche investasi
  
  $komposisi_likuid_saham_ppip[$i]=0.13; //Read komposisi saham tranche likuiditas
  $komposisi_likuid_fi_ppip[$i]=0.13; //Read komposisi pendapatan tetap tranche likuiditas
  $komposisi_likuid_depo_ppip[$i]=0.13; //Read komposisi deposito tranche likuiditas
  
  $return_ppip_inv[$i]= $komposisi_inv_saham_ppip[$i]*$return_saham_ppip[$i] + $komposisi_inv_fi_ppip[$i]*$return_fi_ppip[$i] + $komposisi_inv_depo_ppip[$i]*$return_depo_ppip[$i]; // perhitungan return portofolio tranche investasi
  $return_ppip_likuid[$i]= $komposisi_likuid_saham_ppip[$i]*$return_saham_ppip[$i] + $komposisi_likuid_fi_ppip[$i]*$return_fi_ppip[$i] + $komposisi_likuid_depo_ppip[$i]*$return_depo_ppip[$i]; // perhitungan return portofolio tranche likuiditas
  
  $risk_ppip_inv_step1[$i]=$komposisi_inv_saham_ppip[$i]*$komposisi_inv_saham_ppip[$i]*$risk_saham_ppip[$i]*$risk_saham_ppip[$i] + $komposisi_inv_fi_ppip[$i]*$komposisi_inv_fi_ppip[$i]*$risk_fi_ppip[$i]*$risk_fi_ppip[$i] + $komposisi_inv_depo_ppip[$i]*$komposisi_inv_depo_ppip[$i]*$risk_depo_ppip[$i]*$risk_depo_ppip[$i];
  $risk_ppip_inv_step2[$i]=2*$komposisi_inv_saham_ppip[$i]*$komposisi_inv_fi_ppip[$i]*$risk_saham_ppip[$i]*$risk_fi_ppip[$i]*$korel_saham_fi_ppip[$i]+ 2*$komposisi_inv_saham_ppip[$i]*$komposisi_inv_depo_ppip[$i]*$risk_saham_ppip[$i]*$risk_depo_ppip[$i]*$korel_saham_depo_ppip[$i]+2*$komposisi_inv_fi_ppip[$i]*$komposisi_inv_depo_ppip[$i]*$risk_fi_ppip[$i]*$risk_depo_ppip[$i]*$korel_fi_depo_ppip[$i];
  $risk_ppip_inv[$i]=$risk_ppip_inv_step1[$i]+$risk_ppip_inv_step2[$i];
  
  $risk_ppip_likuid_step1[$i]=$komposisi_likuid_saham_ppip[$i]*$komposisi_likuid_saham_ppip[$i]*$risk_saham_ppip[$i]*$risk_saham_ppip[$i] + $komposisi_likuid_fi_ppip[$i]*$komposisi_likuid_fi_ppip[$i]*$risk_fi_ppip[$i]*$risk_fi_ppip[$i] + $komposisi_likuid_depo_ppip[$i]*$komposisi_likuid_depo_ppip[$i]*$risk_depo_ppip[$i]*$risk_depo_ppip[$i];
  $risk_ppip_likuid_step2[$i]=2*$komposisi_likuid_saham_ppip[$i]*$komposisi_likuid_fi_ppip[$i]*$risk_saham_ppip[$i]*$risk_fi_ppip[$i]*$korel_saham_fi_ppip[$i]+ 2*$komposisi_likuid_saham_ppip[$i]*$komposisi_likuid_depo_ppip[$i]*$risk_saham_ppip[$i]*$risk_depo_ppip[$i]*$korel_saham_depo_ppip[$i]+2*$komposisi_likuid_fi_ppip[$i]*$komposisi_likuid_depo_ppip[$i]*$risk_fi_ppip[$i]*$risk_depo_ppip[$i]*$korel_fi_depo_ppip[$i];
  $risk_ppip_likuid[$i]=sqrt($risk_ppip_likuid_step1[$i]+$risk_ppip_likuid_step2[$i]);
  
}

//-----------------------------------------------------------------------------------------------------------------------------------------
//A.2. Hitung Return Portofolio Personal Keuangan
//Input: Read Return, Risk, Korelasi, Komposisi tranche investasi, komposisi tranche likuiditas masing-masing portofolio
$jml_port_personal=6; //Read jumlah portofolio ppipyang diinput oleh admin

for($i=1;$i<=$jml_port_personal;$i++){
  //$i mencerminkan id dari portofolio personal
  
  //==============================================
  //untuk tranche 1
   
  $return_saham_personal_tranche1[$i]=0.13; //Read return saham
  $return_fi_personal_tranche1[$i]=0.13; //Read return pendapatan tetap
  $return_depo_personal_tranche1[$i]=0.13; //Read return deposito
  $return_rdsaham_personal_tranche1[$i]=0.13; //Read return reksadana saham
  $return_rdfi_personal_tranche1[$i]=0.13; //Read return reksadana pendapatan tetap
  $return_rdpu_personal_tranche1[$i]=0.13; //Read return reksadana pasar uang
  $return_rdcampuran_personal_tranche1[$i]=0.13; //Read return reksadana campuran
  
  $risk_saham_personal_tranche1[$i]=0.13; //Read risk saham
  $risk_fi_personal_tranche1[$i]=0.13; //Read risk pendapatan tetap
  $risk_depo_personal_tranche1[$i]=0.13; //Read risk deposito
  $risk_rdsaham_personal_tranche1[$i]=0.13; //Read risk reksadana saham
  $risk_rdfi_personal_tranche1[$i]=0.13; //Read risk reksadanapendapatan tetap
  $risk_rdpu_personal_tranche1[$i]=0.13; //Read risk reksadana pasar uang
  $risk_rdcampuran_personal_tranche1[$i]=0.13; //Read risk reksadana campuran
  
  $korel_saham_fi_personal_tranche1[$i]=0.13; //Read korelasi saham - pendapatan tetap
  $korel_saham_depo_personal_tranche1[$i]=0.13; //Read korelasi saham - deposito
  $korel_saham_rdsaham_personal_tranche1[$i]=0.13; //Read korelasi saham - rdsaham
  $korel_saham_rdfi_personal_tranche1[$i]=0.13; //Read korelasi saham - rdfi
  $korel_saham_rdpu_personal_tranche1[$i]=0.13; //Read korelasi saham - rdpu
  $korel_saham_rdcampuran_personal_tranche1[$i]=0.13; //Read korelasi saham - rdsaham
  
  $korel_fi_depo_personal_tranche1[$i]=0.13; //Read korelasi fi - deposito
  $korel_fi_rdsaham_personal_tranche1[$i]=0.13; //Read korelasi fi - rdsaham
  $korel_fi_rdfi_personal_tranche1[$i]=0.13; //Read korelasi fi - rdfi
  $korel_fi_rdpu_personal_tranche1[$i]=0.13; //Read korelasi fi - rdpu
  $korel_fi_rdcampuran_personal_tranche1[$i]=0.13; //Read korelasi fi - rdsaham
  
  $korel_depo_rdsaham_personal_tranche1[$i]=0.13; //Read korelasi depo - rdsaham
  $korel_depo_rdfi_personal_tranche1[$i]=0.13; //Read korelasi depo - rdfi
  $korel_depo_rdpu_personal_tranche1[$i]=0.13; //Read korelasi depo - rdpu
  $korel_depo_rdcampuran_personal_tranche1[$i]=0.13; //Read korelasi depo - rdsaham
  
  $korel_rdsaham_rdfi_personal_tranche1[$i]=0.13; //Read korelasi rdsaham - rdfi
  $korel_rdsaham_rdpu_personal_tranche1[$i]=0.13; //Read korelasi rdsaham - rdpu
  $korel_rdsaham_rdcampuran_personal_tranche1[$i]=0.13; //Read korelasi rdsaham - rdsaham

  $korel_rdfi_rdpu_personal_tranche1[$i]=0.13; //Read korelasi rdfi - rdpu
  $korel_rdfi_rdcampuran_personal_tranche1[$i]=0.13; //Read korelasi rdfi - rdsaham
  
  $korel_rdpu_rdcampuran_personal_tranche1[$i]=0.13; //Read korelasi rdpu - rdsaham
    
  $komposisi_tranche1_saham_personal[$i]=0.13; //Read komposisi saham tranche 1
  $komposisi_tranche1_fi_personal[$i]=0.13; //Read komposisi pendapatan tetap tranche 1
  $komposisi_tranche1_depo_personal[$i]=0.13; //Read komposisi deposito tranche 1
  $komposisi_tranche1_rdsaham_personal[$i]=0.13; //Read komposisi reksadana saham tranche 1
  $komposisi_tranche1_rdfi_personal[$i]=0.13; //Read komposisi reksadana pendapatan tetap tranche 1
  $komposisi_tranche1_rdpu_personal[$i]=0.13; //Read komposisi reksadana pasar uang tranche 1
  $komposisi_tranche1_rdcampuran_personal[$i]=0.13; //Read komposisi reksadana campuran tranche 1
  
  $return_personal_tranche1[$i]= $komposisi_tranche1_saham_personal[$i]*$return_saham_personal_tranche1[$i] + $komposisi_tranche1_fi_personal[$i]*$return_fi_personal_tranche1[$i] + $komposisi_tranche1_depo_personal[$i]*$return_depo_personal_tranche1[$i]+ $komposisi_tranche1_rdsaham_personal[$i]*$return_rdsaham_personal_tranche1[$i]+ $komposisi_tranche1_rdfi_personal[$i]*$return_rdfi_personal_tranche1[$i]+ $komposisi_tranche1_rdpu_personal[$i]*$return_rdpu_personal_tranche1[$i]+ $komposisi_tranche1_rdcampuran_personal[$i]*$return_rdcampuran_personal_tranche1[$i]; // perhitungan return portofolio tranche 1
  
  $risk_personal_tranche1_step1[$i]= $komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i] + $komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i] + $komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]+ $komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]+ $komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]+ $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]+ $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 2
  $risk_personal_tranche1_step2[$i]= 2*$komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $korel_saham_fi_personal_tranche1[$i] + 2*$komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $korel_saham_depo_personal_tranche1[$i] + 2*$komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $korel_saham_rdsaham_personal_tranche1[$i] + 2*$komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $korel_saham_rdfi_personal_tranche1[$i] + 2*$komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $korel_saham_rdpu_personal_tranche1[$i] + 2*$komposisi_tranche1_saham_personal[$i]*$risk_saham_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $korel_saham_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 2
  $risk_personal_tranche1_step3[$i]= 2*$komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $korel_fi_depo_personal_tranche1[$i] + 2*$komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $korel_fi_rdsaham_personal_tranche1[$i] + 2*$komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $korel_fi_rdfi_personal_tranche1[$i] + 2*$komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $korel_fi_rdpu_personal_tranche1[$i] + 2*$komposisi_tranche1_fi_personal[$i]*$risk_fi_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $korel_fi_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 3
  $risk_personal_tranche1_step4[$i]= 2*$komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $korel_depo_rdsaham_personal_tranche1[$i] + 2*$komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $korel_depo_rdfi_personal_tranche1[$i] + 2*$komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $korel_depo_rdpu_personal_tranche1[$i] + 2*$komposisi_tranche1_depo_personal[$i]*$risk_depo_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $korel_depo_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 4
  $risk_personal_tranche1_step5[$i]= 2*$komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $korel_rdsaham_rdfi_personal_tranche1[$i] + 2*$komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $korel_rdsaham_rdpu_personal_tranche1[$i] + 2*$komposisi_tranche1_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $korel_rdsaham_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 5
  $risk_personal_tranche1_step6[$i]= 2*$komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $korel_rdfi_rdpu_personal_tranche1[$i] + 2*$komposisi_tranche1_rdfi_personal[$i]*$risk_rdfi_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $korel_rdfi_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 6
  $risk_personal_tranche1_step7[$i]= 2*$komposisi_tranche1_rdpu_personal[$i]*$risk_rdpu_personal_tranche1[$i]* $komposisi_tranche1_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche1[$i]* $korel_rdpu_rdcampuran_personal_tranche1[$i]; // perhitungan risk portofolio tranche 1 step 7
  
  
  //===============================================
  //untuk tranche 2
  
  
  $komposisi_tranche2_saham_personal[$i]=0.13; //Read komposisi saham tranche 2
  $komposisi_tranche2_fi_personal[$i]=0.13; //Read komposisi pendapatan tetap tranche 2
  $komposisi_tranche2_depo_personal[$i]=0.13; //Read komposisi deposito tranche 2
  $komposisi_tranche2_rdsaham_personal[$i]=0.13; //Read komposisi reksadana saham tranche 2
  $komposisi_tranche2_rdfi_personal[$i]=0.13; //Read komposisi reksadana pendapatan tetap tranche 2
  $komposisi_tranche2_rdpu_personal[$i]=0.13; //Read komposisi reksadana pasar uang tranche 2
  $komposisi_tranche2_rdcampuran_personal[$i]=0.13; //Read komposisi reksadana campuran tranche 2

  $komposisi_tranche3_saham_personal[$i]=0.13; //Read komposisi saham tranche 3
  $komposisi_tranche3_fi_personal[$i]=0.13; //Read komposisi pendapatan tetap tranche 3
  $komposisi_tranche3_depo_personal[$i]=0.13; //Read komposisi deposito tranche 3
  $komposisi_tranche3_rdsaham_personal[$i]=0.13; //Read komposisi reksadana saham tranche 3
  $komposisi_tranche3_rdfi_personal[$i]=0.13; //Read komposisi reksadana pendapatan tetap tranche 3
  $komposisi_tranche3_rdpu_personal[$i]=0.13; //Read komposisi reksadana pasar uang tranche 3
  $komposisi_tranche3_rdcampuran_personal[$i]=0.13; //Read komposisi reksadana campuran tranche 3

  
  $return_personal_tranche3[$i]= $komposisi_tranche3_saham_personal[$i]*$return_saham_personal_tranche3[$i] + $komposisi_tranche3_fi_personal[$i]*$return_fi_personal_tranche3[$i] + $komposisi_tranche3_depo_personal[$i]*$return_depo_personal_tranche3[$i]+ $komposisi_tranche3_rdsaham_personal[$i]*$return_rdsaham_personal_tranche3[$i]+ $komposisi_tranche3_rdfi_personal[$i]*$return_rdfi_personal_tranche3[$i]+ $komposisi_tranche3_rdpu_personal[$i]*$return_rdpu_personal_tranche3[$i]+ $komposisi_tranche3_rdcampuran_personal[$i]*$return_rdcampuran_personal_tranche3[$i]; // perhitungan return portofolio tranche 1
  
  $risk_personal_tranche3_step1[$i]= $komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i] + $komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i] + $komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]+ $komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]+ $komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]+ $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]+ $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 2
  $risk_personal_tranche3_step2[$i]= 2*$komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $korel_saham_fi_personal_tranche3[$i] + 2*$komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $korel_saham_depo_personal_tranche3[$i] + 2*$komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $korel_saham_rdsaham_personal_tranche3[$i] + 2*$komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $korel_saham_rdfi_personal_tranche3[$i] + 2*$komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $korel_saham_rdpu_personal_tranche3[$i] + 2*$komposisi_tranche3_saham_personal[$i]*$risk_saham_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $korel_saham_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 2
  $risk_personal_tranche3_step3[$i]= 2*$komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $korel_fi_depo_personal_tranche3[$i] + 2*$komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $korel_fi_rdsaham_personal_tranche3[$i] + 2*$komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $korel_fi_rdfi_personal_tranche3[$i] + 2*$komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $korel_fi_rdpu_personal_tranche3[$i] + 2*$komposisi_tranche3_fi_personal[$i]*$risk_fi_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $korel_fi_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 3
  $risk_personal_tranche3_step4[$i]= 2*$komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $korel_depo_rdsaham_personal_tranche3[$i] + 2*$komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $korel_depo_rdfi_personal_tranche3[$i] + 2*$komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $korel_depo_rdpu_personal_tranche3[$i] + 2*$komposisi_tranche3_depo_personal[$i]*$risk_depo_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $korel_depo_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 4
  $risk_personal_tranche3_step5[$i]= 2*$komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $korel_rdsaham_rdfi_personal_tranche3[$i] + 2*$komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $korel_rdsaham_rdpu_personal_tranche3[$i] + 2*$komposisi_tranche3_rdsaham_personal[$i]*$risk_rdsaham_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $korel_rdsaham_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 5
  $risk_personal_tranche3_step6[$i]= 2*$komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $korel_rdfi_rdpu_personal_tranche3[$i] + 2*$komposisi_tranche3_rdfi_personal[$i]*$risk_rdfi_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $korel_rdfi_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 6
  $risk_personal_tranche3_step7[$i]= 2*$komposisi_tranche3_rdpu_personal[$i]*$risk_rdpu_personal_tranche3[$i]* $komposisi_tranche3_rdcampuran_personal[$i]*$risk_rdcampuran_personal_tranche3[$i]* $korel_rdpu_rdcampuran_personal_tranche3[$i]; // perhitungan risk portofolio tranche 1 step 7
  $risk_personal_tranche3[$i]=sqrt($risk_personal_tranche3_step1[$i]+$risk_personal_tranche3_step2[$i]+$risk_personal_tranche3_step3[$i]+$risk_personal_tranche3_step4[$i]+$risk_personal_tranche3_step5[$i]+$risk_personal_tranche3_step6[$i]+$risk_personal_tranche3_step7[$i]);// perhitungan risk all
  



}




?>


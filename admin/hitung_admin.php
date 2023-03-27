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

//--------------------------------------------------------------------------------------------------------------
//A.2. Hitung Return Portofolio Personal Keuangan
//Input: Read Return, Risk, Korelasi, Komposisi tranche investasi, komposisi tranche likuiditas masing-masing portofolio
$jml_port_personal=6; //Read jumlah portofolio ppipyang diinput oleh admin

for($i=1;$i<=$jml_port_personal;$i++){
  //$i mencerminkan id dari portofolio personal
   
  $return_saham_personal[$i]=0.13; //Read return saham
  $return_fi_personal[$i]=0.13; //Read return pendapatan tetap
  $return_depo_personal[$i]=0.13; //Read return deposito
  $return_rdsaham_personal[$i]=0.13; //Read return reksadana saham
  $return_rdfi_personal[$i]=0.13; //Read return reksadana pendapatan tetap
  $return_rdpu_personal[$i]=0.13; //Read return reksadana pasar uang
  $return_rdcampuran_personal[$i]=0.13; //Read return reksadana campuran
  
  $risk_saham_personal[$i]=0.13; //Read risk saham
  $risk_fi_personal[$i]=0.13; //Read risk pendapatan tetap
  $risk_depo_personal[$i]=0.13; //Read risk deposito
  
  $korel_saham_fi_personal[$i]=0.13; //Read korelasi saham - pendapatan tetap
  $korel_saham_depo_personal[$i]=0.13; //Read korelasi saham - deposito
  $korel_fi_depo_personal[$i]=0.13; //Read korelasi pendapatan tetap - deposito
  
  $komposisi_inv_saham_personal[$i]=0.13; //Read komposisi saham tranche investasi
  $komposisi_inv_fi_personal[$i]=0.13; //Read komposisi pendapatan tetap tranche investasi
  $komposisi_inv_depo_personal[$i]=0.13; //Read komposisi deposito tranche investasi
  
  $komposisi_likuid_saham_personal[$i]=0.13; //Read komposisi saham tranche likuiditas
  $komposisi_likuid_fi_personal[$i]=0.13; //Read komposisi pendapatan tetap tranche likuiditas
  $komposisi_likuid_depo_personal[$i]=0.13; //Read komposisi deposito tranche likuiditas
  
  $return_personal_inv[$i]= $komposisi_inv_saham_personal[$i]*$return_saham_personal[$i] + $komposisi_inv_fi_personal[$i]*$return_fi_personal[$i] + $komposisi_inv_depo_personal[$i]*$return_depo_personal[$i]; // perhitungan return portofolio tranche investasi
  $return_personal_likuid[$i]= $komposisi_likuid_saham_personal[$i]*$return_saham_personal[$i] + $komposisi_likuid_fi_personal[$i]*$return_fi_personal[$i] + $komposisi_likuid_depo_personal[$i]*$return_depo_personal[$i]; // perhitungan return portofolio tranche likuiditas
  
  $risk_personal_inv_step1[$i]=$komposisi_inv_saham_personal[$i]*$komposisi_inv_saham_personal[$i]*$risk_saham_personal[$i]*$risk_saham_personal[$i] + $komposisi_inv_fi_personal[$i]*$komposisi_inv_fi_personal[$i]*$risk_fi_personal[$i]*$risk_fi_personal[$i] + $komposisi_inv_depo_personal[$i]*$komposisi_inv_depo_personal[$i]*$risk_depo_personal[$i]*$risk_depo_personal[$i];
  $risk_personal_inv_step2[$i]=2*$komposisi_inv_saham_personal[$i]*$komposisi_inv_fi_personal[$i]*$risk_saham_personal[$i]*$risk_fi_personal[$i]*$korel_saham_fi_personal[$i]+ 2*$komposisi_inv_saham_personal[$i]*$komposisi_inv_depo_personal[$i]*$risk_saham_personal[$i]*$risk_depo_personal[$i]*$korel_saham_depo_personal[$i]+2*$komposisi_inv_fi_personal[$i]*$komposisi_inv_depo_personal[$i]*$risk_fi_personal[$i]*$risk_depo_personal[$i]*$korel_fi_depo_personal[$i];
  $risk_personal_inv[$i]=$risk_personal_inv_step1[$i]+$risk_personal_inv_step2[$i];
  
  $risk_personal_likuid_step1[$i]=$komposisi_likuid_saham_personal[$i]*$komposisi_likuid_saham_personal[$i]*$risk_saham_personal[$i]*$risk_saham_personal[$i] + $komposisi_likuid_fi_personal[$i]*$komposisi_likuid_fi_personal[$i]*$risk_fi_personal[$i]*$risk_fi_personal[$i] + $komposisi_likuid_depo_personal[$i]*$komposisi_likuid_depo_personal[$i]*$risk_depo_personal[$i]*$risk_depo_personal[$i];
  $risk_personal_likuid_step2[$i]=2*$komposisi_likuid_saham_personal[$i]*$komposisi_likuid_fi_personal[$i]*$risk_saham_personal[$i]*$risk_fi_personal[$i]*$korel_saham_fi_personal[$i]+ 2*$komposisi_likuid_saham_personal[$i]*$komposisi_likuid_depo_personal[$i]*$risk_saham_personal[$i]*$risk_depo_personal[$i]*$korel_saham_depo_personal[$i]+2*$komposisi_likuid_fi_personal[$i]*$komposisi_likuid_depo_personal[$i]*$risk_fi_personal[$i]*$risk_depo_personal[$i]*$korel_fi_depo_personal[$i];
  $risk_personal_likuid[$i]=sqrt($risk_personal_likuid_step1[$i]+$risk_personal_likuid_step2[$i]);


}




?>


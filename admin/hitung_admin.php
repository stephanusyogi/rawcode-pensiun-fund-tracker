<?php 
  
//A.1. Hitung Return Portofolio PPIP
//Input: Read Return, Risk, Korelasi, Komposisi tranche investasi, komposisi tranche likuiditas masing-masing portofolio
$jml_port_ppip=4; //Read jumlah portofolio yang diinput oleh admin

for($i=1;$i<=$jml_port_ppip;$i++){
  //$i mencerminkan id dari portofolio
  
  $return_saham_ppip[$i]=0.13; //Read return saham
  $return_fi_ppip[$i]=0.13; //Read return pendapatan tetap
  $return_depo_ppip[$i]=0.13; //Read return deposito
  
  $risk_saham_ppip[$i]=0.13; //Read risk saham
  $risk_fi_ppip[$i]=0.13; //Read risk pendapatan tetap
  $risk_depo_ppip[$i]=0.13; //Read risk deposito
  
  $komposisi_inv_saham_ppip[$i]=0.13; //Read komposisi saham tranche investasi
  $komposisi_inv_fi_ppip[$i]=0.13; //Read komposisi pendapatan tetap tranche investasi
  $komposisi_inv_depo_ppip[$i]=0.13; //Read komposisi deposito tranche investasi
  
  $komposisi_likuid_saham_ppip[$i]=0.13; //Read komposisi saham tranche likuiditas
  $komposisi_likuid_fi_ppip[$i]=0.13; //Read komposisi pendapatan tetap tranche likuiditas
  $komposisi_likuid_depo_ppip[$i]=0.13; //Read komposisi deposito tranche likuiditas
  
  $return_ppip_inv[$i]= $komposisi_inv_saham_ppip[$i]*$return_saham_ppip[$i] + $komposisi_inv_fi_ppip[$i]*$return_fi_ppip[$i] + $komposisi_inv_depo_ppip[$i]*$return_depo_ppip[$i]; // perhitungan return portofolio tranche investasi
  $return_ppip_likuid[$i]= $komposisi_likuid_saham_ppip[$i]*$return_saham_ppip[$i] + $komposisi_likuid_fi_ppip[$i]*$return_fi_ppip[$i] + $komposisi_likuid_depo_ppip[$i]*$return_depo_ppip[$i]; // perhitungan return portofolio tranche likuiditas
  
  $risk_ppip_inv_step1[$i]=$komposisi_inv_saham_ppip[$i]*$komposisi_inv_saham_ppip[$i]*$risk_saham_ppip[$i]*$risk_saham_ppip[$i] + $komposisi_inv_fi_ppip[$i]*$komposisi_inv_fi_ppip[$i]*$risk_fi_ppip[$i]*$risk_fi_ppip[$i] + $komposisi_inv_depo_ppip[$i]*$komposisi_inv_depo_ppip[$i]*$risk_depo_ppip[$i]*$risk_depo_ppip[$i];
  $risk_ppip_inv_step2[$i]=
  
}



?>


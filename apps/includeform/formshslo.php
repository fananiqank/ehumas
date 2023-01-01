<?php 
foreach($db->select("tx_slo","*,case when slo_tujuan=1 then 'Baru' else 'Perpanjangan' end as tujuan","ijin_id = '$_GET[id]'") as $slo){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Tujuan Negara Kunjungan</b></label>
    <div class="col-4">: 
        <?=$slo[tujuan]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>Pembebanan Biaya</b></label>
    <div class="col-4">: 
        <?=number_format($slo[slo_biaya1])." - ".number_format($slo[slo_biaya2])?>
    </div>
  
</div>
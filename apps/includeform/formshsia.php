<?php 
foreach($db->select("tx_sia","*,case when sia_tujuan=1 then 'Baru' else 'Perpanjangan' end as tujuan","ijin_id = '$_GET[id]'") as $sia){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Tujuan Negara Kunjungan</b></label>
    <div class="col-4">: 
        <?=$sia[tujuan]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>Pembebanan Biaya</b></label>
    <div class="col-4">: 
        <?=number_format($sia[sia_biaya1])." - ".number_format($sia[sia_biaya2])?>
    </div>
  
</div>
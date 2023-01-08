<?php 
foreach($db->select("tx_sio","*,case when sio_tujuan=1 then 'Baru' else 'Perpanjangan' end as tujuan","ijin_id = '$_GET[id]'") as $sio){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Tujuan</b></label>
    <div class="col-4">: 
        <?=$sio[tujuan]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>Pembebanan Biaya</b></label>
    <div class="col-4">: 
        <?=$sio[sio_biaya1]." - ".$sio[sio_biaya2]?>
    </div>
  
</div>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Jenis SIO</b></label>
    <div class="col-4">: 
        <?=$sio[sio_jenis]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>Kepemilikan</b></label>
    <div class="col-4">: 
        <?php if($sio[sio_milik] == 1) {echo "Perusahaan"; }else{echo "Milik Pribadi";} ?>
    </div>
  
</div>
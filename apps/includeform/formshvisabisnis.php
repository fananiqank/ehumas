<?php 
foreach($db->select("tx_bvisa","*,case when bvisa_jenis=1 then '211a/211B Single-Entry' else 'Multiple-Entry (VKUBP)' end as jenisvisa","ijin_id = '$_GET[id]'") as $bvisa){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Jenis Visa</b></label>
    <div class="col-4">: 
        <?=$bvisa[jenisvisa]?>
    </div>
   <label class="col-sm-2" style="font-size: 13px;"><b>Alamat Kedutaan RI</b></label>
    <div class="col-4">: 
        <?=$bvisa[bvisa_alamat]?>
    </div>


</div>
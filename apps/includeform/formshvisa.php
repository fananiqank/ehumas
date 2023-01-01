<?php 
foreach($db->select("tx_visa","*,case when visa_jenis=1 then '211a/211B Single-Entry' else 'Multiple-Entry (VKUBP)' end as jenisvisa","ijin_id = '$_GET[id]'") as $visa){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Jenis Visa</b></label>
    <div class="col-4">: 
        <?=$visa[jenisvisa]?>
    </div>
  
</div>
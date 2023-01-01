<?php 
foreach($db->select("tx_visatka","*,case when tka_status=1 then 'Permanen' else 'Sementara' end as jenisvisa","ijin_id = '$_GET[id]'") as $bvisa){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Status TKA</b></label>
    <div class="col-4">: 
        <?=$bvisa[jenisvisa]?>
    </div>
   <label class="col-sm-2" style="font-size: 13px;"><b>Lama Tinggal</b></label>
    <div class="col-4">: 
        <?=$bvisa[tka_lamatinggal]?>
    </div>


</div>
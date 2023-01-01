<?php 
foreach($db->select("tx_paspor","*","ijin_id = '$_GET[id]'") as $ptka){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Lama Tinggal</b></label>
    <div class="col-4">: 
        <?=$ptka[paspor_lamatinggal]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>Negara</b></label>
    <div class="col-4">: 
        <?=$ptka[paspor_negara]?>
    </div>
</div>

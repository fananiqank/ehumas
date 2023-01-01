<?php 
foreach($db->select("tx_ptka","*","ijin_id = '$_GET[id]'") as $ptka){}
?>
<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>No. HP</b></label>
    <div class="col-4">: 
        <?=$ptka[ptka_hp]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>Email</b></label>
    <div class="col-4">: 
        <?=$ptka[ptka_email]?>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2" style="font-size: 13px;"><b>Nama TKA</b></label>
    <div class="col-4">: 
        <?=$ptka[ptka_name]?>
    </div>
    <label class="col-sm-2" style="font-size: 13px;"><b>No Paspor TKA</b></label>
    <div class="col-4">: 
        <?=$ptka[ptka_paspor]?>
    </div>
</div>

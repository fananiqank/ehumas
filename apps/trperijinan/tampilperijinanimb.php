
<div class="form-group row form-inline">
    <label class="col-sm-3 control-label" for="w1-username">Nama Bangunan</label>
    <div class="col-sm-9">
        <select class="select2 form-control block headmas" id="asset_id2" name="asset_id2" onchange="inasset(this.value)" required>
            <?php include "tampilasset.php"; ?>
        </select>
        <input type="hidden" class="form-control input-sm headmas" name="asset_id" id="asset_id" style="min-width: 100%;" required>
        <input type="hidden" class="form-control input-sm headmas" name="imb_name" id="imb_name" style="min-width: 100%;" required>
    </div>
</div>
<div class="form-group row form-inline">
<label class="col-sm-3 control-label" for="w1-username">Lokasi Bangunan</label>
    <div class="col-sm-9">
        <input type="text" class="form-control input-sm headmas" name="imb_lokasi" id="imb_lokasi" style="min-width: 100%;" required>
    </div>
</div>
<div class="form-group row form-inline">
 
    <label class="col-sm-3 control-label" for="w1-username">Type Bangunan</label>
    <div class="col-sm-7">
        <select class="select2 form-control block headmas" id="imb_type" name="imb_type" required>
            <option value="1">Baru</option>
            <option value="2">Lama</option>
            <option value="3">Penambahan</option>
            <option value="4">Perbaikan</option>
            <option value="5">Renovasi</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Rencana Tanggal Pekerjaan</label>
    <div class="col-sm-4">
         <input type="date" class="form-control input-sm" id="imb_tglpekerjaan" name="imb_tglpekerjaan" value="<?=$mtc[ijin_tglawal]?>" style="width: 100%" required>
    </div>
    
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Alasan Kebutuhan</label>
    <div class="col-sm-9">
        <textarea id="ijin_keterangan" name="ijin_keterangan" style="width: 100%" value="<?=$mtc[ijin_keterangan]?>" required></textarea>    
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">No. Cost Center</label>
    <div class="col-sm-9">
        <input type="text" class="form-control input-sm headmas" name="ijin_costcenter" id="ijin_costcenter" style="min-width: 100%;" required>
    </div>
</div>
<script src="app-assets/js/scripts/forms/select/form-select2.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#tampilforminc').load("apps/forminclude.php?id="+<?php echo $_GET[id];?>); 
    });
    function inasset(val){
        expval = val.split('_');
        id = expval[0];
        nama = expval[1]+' - '+expval[3];;
        lokasi = expval[2];

        $('#asset_id').val(id);
        $('#imb_name').val(nama);
        $('#imb_lokasi').val(lokasi);
    }
</script>
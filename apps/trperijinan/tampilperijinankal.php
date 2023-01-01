
<div class="form-group row form-inline">
    <label class="col-sm-3 control-label" for="w1-username">Nama Alat</label>
    <div class="col-sm-9">
        <input type="text" class="form-control input-sm headmas" name="kalbar_name" id="kalbar_name" style="min-width: 100%;" required>
    </div>
</div>
<div class="form-group row form-inline">
<label class="col-sm-3 control-label" for="w1-username">Type Alat</label>
    <div class="col-sm-9">
        <input type="text" class="form-control input-sm headmas" name="kalbar_type" id="kalbar_type" style="min-width: 100%;" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Lokasi Alat</label>
    <div class="col-sm-7">
        
        <input type="text" class="form-control input-sm headmas" name="kalbar_lokasi" id="kalbar_lokasi" style="min-width: 100%;" required>
        </select>
    </div>
</div>
<div class="form-group row form-inline">
 
    <label class="col-sm-3 control-label" for="w1-username">Jenis Perijinan</label>
    <div class="col-sm-7">
        <select class="select2 form-control block headmas" id="kalbar_jenisijin" name="kalbar_jenisijin" required>
            <option value="1">Baru</option>
            <option value="2">Perpanjangan</option>
            <option value="3">Perbaikan</option>
        </select>
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
</script>
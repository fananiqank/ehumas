<?php if($_GET['id'] > 0) {?>
<div class="form-group row form-inline">
    <label class="col-sm-3 control-label" for="w1-username">Nama</label>
    <div class="col-sm-9">
        <input type="text" class="form-control input-sm headmas" name="ijin_name" id="ijin_name" style="min-width: 100%;" required>
    </div>
    
</div>
<div class="form-group row form-inline">
<label class="col-sm-3 control-label" for="w1-username">Dept.</label>
    <div class="col-sm-9">
        <select class="select2 form-control block headmas" id="dep_id" name="dep_id" required>
            <?php include "tampildep.php"; ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Jabatan</label>
    <div class="col-sm-7">
        <!-- <input type="text" class="form-control input-sm headmas" name="ijin_jabatan" id="ijin_jabatan" style="min-width: 100%;" required> -->
        <select class="select2 form-control block headmas" id="id_jabatan" name="id_jabatan" required>
            <?php include "tampiljabatan.php"; ?>
        </select>
    </div>
</div>
<div class="form-group row form-inline">
 
    <label class="col-sm-3 control-label" for="w1-username">NIK/Paspor</label>
    <div class="col-sm-7">
        <input type="text" class="form-control input-sm headmas" name="ijin_nik" id="ijin_nik" style="min-width: 100%;" required>
    </div>
</div>

<?php if($_GET[type] == 1) {
      if($_GET[id] <> 11){
 ?>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Rencana Tanggal Ijin</label>
    <div class="col-sm-4">
         <input type="date" class="form-control input-sm" id="ijin_tglawal" name="ijin_tglawal" value="<?=$mtc[ijin_tglawal]?>" style="width: 100%" required>
    </div>
    <div class="col-sm-1" align="center">-</div>
    <div class="col-sm-4">
         <input type="date" class="form-control input-sm" id="ijin_tglakhir" name="ijin_tglakhir" value="<?=$mtc[ijin_tglakhir]?>" style="width: 100%" required>
    </div>
</div>
<?php } }?>
<p id="tampilforminc">

</p>
<?php if($_GET[id] <> 11){ ?>
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
<?php } ?>
<script src="app-assets/js/scripts/forms/select/form-select2.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
    $('#tampilforminc').load("apps/forminclude.php?id="+<?php echo $_GET[id];?>); 
});
</script>

<?php } ?>
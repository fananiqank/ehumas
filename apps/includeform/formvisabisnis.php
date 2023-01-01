<div class="form-group row form-inline">
<label class="col-sm-3 control-label" for="w1-username">Jenis Visa</label>
    <div class="col-sm-5">
        <select class="select2 form-control block headmas" id="bvisa_jenis" name="bvisa_jenis" required>
            <?php include "tampiljenisvisa.php"; ?>
        </select>
    </div>
</div>
<?php if($_GET[id] == 1){ ?>
<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Alamat kantor kedutaan RI</label>
    <div class="col-sm-9">
        <textarea id="bvisa_alamat" name="bvisa_alamat" style="width: 100%" value="<?=$mtc[bvisa_alamat]?>" required></textarea>    
    </div>
</div>
<?php } ?>
<script src="app-assets/js/scripts/forms/select/form-select2.js"></script>
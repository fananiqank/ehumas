<div class="form-group row form-inline">
<label class="col-sm-3 control-label" for="w1-username">Status TKA</label>
    <div class="col-sm-5">
        <select class="select2 form-control block headmas" id="tka_status" name="tka_status" required>
            <?php include "tampiltka.php"; ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label" for="w1-username">Lama Tinggal</label>
    <div class="col-sm-9">
        <input type="text" id="tka_lamatinggal" name="tka_lamatinggal" style="width: 100%" value="<?=$mtc[tka_lamatinggal]?>">  
    </div>
</div>
<script src="app-assets/js/scripts/forms/select/form-select2.js"></script>
<?php 
	if($_GET['reload'] == 1) {
		session_start();
		require_once "../../webclass.php";
		$db = new kelas();
	}
?>
<form class="form-user" id="form" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Jenis Asset</label>
        <div class="col-sm-8">
            <select class="select2 form-control block frhead" id="assetjenis_id" name="assetjenis_id" required>
                 <?php include "tampil_asset.php"; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Nama Asset</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm frhead" name="asset_name" id="asset_name" required>
            <input type="hidden" class="form-control input-sm frhead" name="asset_id" id="asset_id">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">No Sert.</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm frhead" name="asset_no" id="asset_no" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Lokasi</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm frhead" name="asset_lokasi" id="asset_lokasi" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Ukuran</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm frhead" name="asset_ukuran" id="asset_ukuran" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Type</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm frhead" name="asset_type" id="asset_type" required>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Keterangan</label>
        <div class="col-sm-8">
            <textarea type="text" class="form-control input-sm frhead" name="asset_keterangan" id="asset_keterangan"></textarea>
        </div>
    </div>
   
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username"></label>
        <div class="col-sm-3">
             <div id='ck'>
                <!-- <div id="prosesloading"></div> -->
                <!-- <a class="btn btn-primary" role="button" tabindex="6" id="simpan"><i class="fa fa-save">  Simpan</i></a> -->
                <button type="submit" class="btn btn-info" id="simpan">Simpan</button>
            </div>
        </div> 
        <div class="col-sm-3">
                <!-- <a class="btn btn-primary" role="button" tabindex="6" id="simpan"><i class="fa fa-save">  Simpan</i></a> -->
                <a href="javascript:void(0)" class="btn btn-info" onclick="reset()">Reset</a>
        </div> 
    </div>
</form>

<div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailarmada">
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
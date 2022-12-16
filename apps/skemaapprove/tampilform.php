<?php 
	if($_GET['reload'] == 1) {
		session_start();
		require_once "../../webclass.php";
		$db = new kelas();
	}
?>
<form class="form-user" id="form" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Nama Skema</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm frhead" name="skema_name" id="skema_name" required>
            <input type="hidden" class="form-control input-sm frhead" name="skema_id" id="skema_id">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Approve</label>
        <div class="col-sm-8" >
            <table class="table" id="employee_table">
                <tr>
                    <td >1</td>
                    <td >
                    <select class="select2" id="app1" name="app1">
                        <option value='0'>Pilih Approval</option>
                        <?php foreach($db->select("m_jabatan","*","hak_approve = 1") as $peg){
                            echo "<option value='".$peg[id_jabatan]."'>".$peg[nama_jabatan]."</option>";
                        } ?>
                    </select>
                </td></tr>
                <tr>
                    <td >2</td>
                    <td >
                    <select class="select2" id="app2" name="app2">
                        <option value='0'>Pilih Approval</option>
                        <?php foreach($db->select("m_pegawai","*","hak_approve = 1") as $peg){
                            echo "<option value='".$peg[id_pegawai]."'>".$peg[nama_pegawai]."</option>";
                        } ?>
                    </select>
                </td></tr>
                <tr>
                    <td >3</td>
                    <td >
                    <select class="select2" id="app3" name="app3">
                        <option value='0'>Pilih Approval</option>
                        <?php foreach($db->select("m_pegawai","*","hak_approve = 1") as $peg){
                            echo "<option value='".$peg[id_pegawai]."'>".$peg[nama_pegawai]."</option>";
                        } ?>
                    </select>
                </td></tr>
                
            </table>
            <!-- <input class="btn btn-warning btn-sm" type="button" onclick="add_row();" value="Add New Row"> -->
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label" for="w1-username">Status </label>
        <div class="col-sm-8">
            <select class="select2 form-control block frhead" id="ijin_status" name="ijin_status" required>
                 <?php include "tampilstatus.php"; ?>
            </select>
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
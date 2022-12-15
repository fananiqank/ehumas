<form class="form-user" id="form" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
<section class="card">
<header class="card-header">
    <div class="card-actions">
        <a href="#" class="fa fa-caret-down"></a>
    </div>
    <h2 class="card-title">Input Perijinan</h2>
    <p class="card-subtitle">
        <a href="index.php?x=trijinvisa" style="float:right;" class="btn btn-info btn-sm">Back to List</a>
    </p>
</header>
<div class="card-body">
  
<div class="row">
    <div class="col-md-6">
        <div class="form-group row form-inline">
         
            <label class="col-sm-3 control-label" for="w1-username">Jenis Perijinan</label>
            <div class="col-sm-9">
                <select class="select2 form-control block headmas" id="ijinjenis_id" name="ijinjenis_id" onchange="tampilsyarat(this.value)" required>
                    <?php include "tampilijinjenis.php"; ?>
                </select>
            </div>
            
        </div>
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
                <input type="text" class="form-control input-sm headmas" name="ijin_jabatan" id="ijin_jabatan" style="min-width: 100%;" required>
            </div>
        </div>
        <div class="form-group row form-inline">
         
            <label class="col-sm-3 control-label" for="w1-username">NIK/Paspor</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm headmas" name="ijin_nik" id="ijin_nik" style="min-width: 100%;" required>
            </div>
        </div>
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
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="w1-username">Alasan Kebutuhan</label>
            <div class="col-sm-9">
                <textarea id="ijin_keterangan" name="ijin_keterangan" style="width: 100%" value="<?=$mtc[ijin_keterangan]?>" required></textarea>    
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        
        
        <div class="form-group row" id="syaratupload">
            
            <?php //include "isiupload.php"; ?>
        </div>
        
    </div>
</div>
</div>
 <hr>
</section>
</form>
<div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18"><i class="la la-list"></i>View Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tampilhis">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>                                      
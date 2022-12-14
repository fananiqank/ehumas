<form class="form-user" id="form" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
<section class="card">
<header class="card-header">
    <div class="card-actions">
        <a href="#" class="fa fa-caret-down"></a>
    </div>
    <h2 class="card-title">Input Bisnis Visa</h2>
    <p class="card-subtitle">
    </p>
</header>
<div class="card-body">
  
    <input type="hidden" class="form-control input-sm headmas" name="ijinjenis_id" id="ijinjenis_id" value="1" required>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row form-inline">
         
            <label class="col-sm-3 control-label" for="w1-username">Nama TKA</label>
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
         
            <label class="col-sm-3 control-label" for="w1-username">No. Passport</label>
            <div class="col-sm-7">
                <input type="text" class="form-control input-sm headmas" name="bvisa_nopas" id="bvisa_nopas" style="min-width: 100%;" required>
            </div>
        </div>
        <div class="form-group row form-inline">
        <label class="col-sm-3 control-label" for="w1-username">Jenis Visa</label>
            <div class="col-sm-5">
                <select class="select2 form-control block headmas" id="bvisa_jenis" name="bvisa_jenis" required>
                    <?php include "tampiljenisvisa.php"; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            
            <label class="col-sm-3 control-label" for="w1-username">Rencana Masa Tinggal</label>
            <div class="col-sm-4">
                 <input type="date" class="form-control input-sm" id="bvisa_tglawal" name="bvisa_tglawal" value="<?=$mtc[bvisa_tglawal]?>" style="width: 100%" required>
            </div>
            <div class="col-sm-1" align="center">-</div>
            <div class="col-sm-4">
                 <input type="date" class="form-control input-sm" id="bvisa_tglakhir" name="bvisa_tglakhir" value="<?=$mtc[bvisa_tglakhir]?>" style="width: 100%" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="w1-username">Alasan Kebutuhan</label>
            <div class="col-sm-9">
                <textarea id="bvisa_keterangan" name="bvisa_keterangan" style="width: 100%" value="<?=$mtc[bvisa_keterangan]?>" required></textarea>    
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="w1-username">Alamat kantor kedutaan RI</label>
            <div class="col-sm-9">
                <textarea id="bvisa_alamatkantor" name="bvisa_alamatkantor" style="width: 100%" value="<?=$mtc[bvisa_alamatkantor]?>" required></textarea>    
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="w1-username">No. Cost Center</label>
            <div class="col-sm-9">
                <input type="text" class="form-control input-sm headmas" name="bvisa_biaya" id="bvisa_biaya" style="min-width: 100%;" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="w1-username">Diminta Oleh</label>
            <div class="col-sm-9">
                <input type="text" class="form-control input-sm headmas" name="bvisa_biaya" id="bvisa_biaya" style="min-width: 100%;" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        
        
        <div class="form-group row" id="syaratupload">
            
            <?php include "isiupload.php"; ?>
        </div>
        <div class="form-group row " style="float: right;">
            
                 <div id='ck' >
                    <!-- <a class="btn btn-primary" role="button" tabindex="6" id="simpan"><i class="fa fa-save">  Simpan</i></a> -->
                    
                        <a href="index.php?x=trijinvisa" class="btn btn-warning">Back</a>
                    <?php if($_GET['id'] == ''){ ?>
                        <button type="submit" class="btn btn-info" id="tambah">Simpan</button>
                    <?php } ?>                    
                </div>
            
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
<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep","a.*,b.ijinjenis_name,b.skema_id,c.nama_dep","a.ijin_id = '$_GET[id]'") as $val2){}

?>
<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 6px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 13px;
  transition: 0.4s;
  border-radius: 5px;
}

.active, .accordion:hover {
  background-color: #ccc;
}

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>
<form class="form-user" id="form" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
    <div class="col-sm-12">
            <div class="form-group row">
                <label class="col-sm-2 control-label" style="font-size: 13px;"><b>Jenis Perijinan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijinjenis_name]?>
                    <input type="hidden" name="skema_id" id="skema_id" value="<?=$val2[skema_id]?>">
                    <input type="hidden" name="ijin_id" id="ijin_id" value="<?=$_GET[id]?>">
                    <input type="hidden" name="ijinjenis_id" id="ijinjenis_id" value="<?=$_GET[ijinjenis_id]?>">
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Rencana Tgl Perijinan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_tglawal]." - ".$val2[ijin_tglakhir]?>
                </div>
            </div>
           <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>No. Pengajuan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_kode]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Nama</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_name]?>
                </div>
                
                
            </div>
            <div class="form-group row">
                 <label class="col-sm-2" style="font-size: 13px;"><b>Dept</b></label>
                <div class="col-4">: 
                    <?=$val2[nama_dep]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>NIK/Paspor</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_nik]?>
                </div>
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Jabatan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_jabatan]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Alasan Kebutuhan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_keterangan]?>
                </div>
                
            </div>
            <div class="form-group row">
                <b><u>Persyaratan</u></b><br>
                <?php $no = 1;
                    foreach ($db->select("uploaddata a join m_berkas b on a.berkas_id=b.berkas_id","a.*,b.berkas_deskripsi","ijin_id='$_GET[id]'") as $upd) { ?>
                    <button class="accordion"><?=$no.". ".$upd[berkas_deskripsi]?></button>
                    <div class="panel table-responsive">
                        <embed src="data/<?=$upd[upload_name]?>" width="100%" height="300"></embed>
                    </div>
                <?php $no++; } ?>
            </div>
            <div class="form-group row">
               <label class="col-sm-2" style="font-size: 13px;"><b>Remark</b></label>
                <div class="col-sm-8">: 
                    <textarea id="app_keterangan" name="app_keterangan"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2"><b>&nbsp</b></label>
                <div class="col-4">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="approve(1)">Approve</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="approve(2)">Reject</a>
                </div>
            </div>
            
            
        </div>
    </div>
</form>
<script type="text/javascript">
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      });
    }

    function approve(type){
        var data = $('#form').serializeFormJSON();        
            $('#prosesloading').html('<img src="../assets/images/loading.gif">');
            $.post('apps/trapprove/proses.php?act=save&type='+type,data,
                function(msg) {
                    if(msg!==""){alert(msg);}
                   $('#prosesloading').html('');
                   window.location='index.php?x=approve';
                }
            );
    }
</script>
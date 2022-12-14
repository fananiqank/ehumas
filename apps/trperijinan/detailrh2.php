<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id left join m_dep c on a.dep_id=c.id_dep left join m_jabatan e on a.id_jabatan=e.id_jabatan","a.*,b.ijinjenis_name,b.skema_id,c.nama_dep,DATEDIFF(a.ijin_tglakhirterbit,a.ijin_tglawalterbit) as masaberlaku,e.nama_jabatan,b.ijinjenis_type","a.ijin_id = '$_GET[id]'") as $val2){}

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
                    <input type="hidden" name="ijinjenis_id" id="ijinjenis_id" value="<?=$val2[ijinjenis_id]?>">
                </div>
                <?php if($val2[ijinjenis_id] == 1){ ?>
                <label class="col-sm-2" style="font-size: 13px;"><b>Rencana Tgl Perijinan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_tglawal]." - ".$val2[ijin_tglakhir]?>
                </div>
                <?php } ?>
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
        <?php if($val2[ijinjenis_type] == 1){ ?>
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
                    <?=$val2[nama_jabatan]?>
                </div>
                
                
            </div>
        <?php } ?>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Cost Center</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_costcenter]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Keterangan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_keterangan]?>
                </div>
            </div>
                <?php  
                if($val2[ijinjenis_id] == 1 )
                { 
                    include "../includeform/formshvisabisnis.php";
                } 
                
                if ($val2[ijinjenis_id] == 3 ){ 
                    include "../includeform/formshvisa.php";
                } 

                if ($val2[ijinjenis_id] == 4 ){ 
                    include "../includeform/formshvisatka.php";
                } 

                if ($val2[ijinjenis_id] == 5 ){ 
                    include "../includeform/formshslo.php";
                } 

                if ($val2[ijinjenis_id] == 6 ){ 
                    include "../includeform/formshsio.php";
                } 

                if ($val2[ijinjenis_id] == 10 ){ 
                    include "../includeform/formshsia.php";
                } 

                if ($val2[ijinjenis_id] == 11 ){ 
                    include "../includeform/formshpendampingtka.php";
                } 

                if ($val2[ijinjenis_id] == 12 ){ 
                    include "../includeform/formshpaspor.php";
                } 



                ?> 
            <hr>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>No. SK</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_nosk]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Tempat Terbit</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_tempatterbit]?>
                </div>
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Tgl Terbit</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_tglawalterbit]."-".$val2[ijin_tglakhirterbit]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Masa Berlaku</b></label>
                <div class="col-4">: 
                    <?php if($val2['masaberlaku'] != ''){echo $val2['masaberlaku']." hari";}?> 
                </div>    
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Remark Admin</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_remarkadmin]?>
                </div>
                
            </div>
           
            <div class="form-group row">
                <b><u>Persyaratan</u></b><br>
                <?php $no = 1;
                    foreach ($db->select("uploaddata a join m_berkas b on a.berkas_id=b.berkas_id","a.*,b.berkas_deskripsi","ijin_id='$_GET[id]'") as $upd) { ?>
                    <button type="button" class="accordion"><?=$no.". ".$upd[berkas_deskripsi]?></button>
                    <div class="panel table-responsive" style="text-align:center">
                        <embed src="data/<?=$upd[upload_name]?>" width="50%" height="250"></embed>
                    </div>
                <?php $no++; } ?>
            </div>
            <div class="form-group row">
               <label class="col-sm-2" style="font-size: 13px;"><b>Approve Head</b></label>
                <div class="col-sm-8">: 
                    <?php foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$_GET[id]' and skemadtl_seq = 1") as $cekhead){} 
                        if($cekhead[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead[id_pegawai]'") as $hh){}
                            echo "<b>".$cekhead[statusijin]."</b> by <b>".$hh[nama_pegawai]."</b> on <b>".$cekhead[app_createdate]."</b><br>: <b>Note</b> : ".$cekhead['app_keterangan'];
                        } else {
                            echo "Waiting";
                        }
                    ?>
                </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2" style="font-size: 13px;"><b>Approve Head PGA</b></label>
                <div class="col-sm-8">: 
                    <?php foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$_GET[id]' and skemadtl_seq = 2") as $cekhead2){} 
                        if($cekhead2[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead2[id_pegawai]'") as $hh){}
                            echo "<b>".$cekhead2[statusijin]."</b> by <b>".$hh[nama_pegawai]."</b> on <b>".$cekhead2[app_createdate]."</b><br>: <b>Note</b> : ".$cekhead2['app_keterangan'];
                        } else if ($cekhead[app_status] == 0) {
                            echo "-";
                        } else {
                            echo "Waiting";
                        }
                    ?>
                </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2" style="font-size: 13px;"><b>Approve Direktur</b></label>
                <div class="col-sm-8">: 
                    <?php foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$_GET[id]' and skemadtl_seq = 3") as $cekhead3){} 
                        if($cekhead3[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                            echo "<b>".$cekhead3[statusijin]."</b> by <b>".$hh[nama_pegawai]."</b> on <b>".$cekhead3[app_createdate]."</b><br>: <b>Note</b> : ".$cekhead3['app_keterangan'];
                        } else if ($cekhead2[app_status] == 0) {
                            echo "-";
                        } else {
                            echo "Waiting";
                        }
                    ?>
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
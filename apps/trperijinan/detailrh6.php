<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id left join tx_imb c on a.ijin_id=c.ijin_id","a.*,b.ijinjenis_name,c.*, case when c.imb_type=1 then 'Baru' when c.imb_type=2 then 'Lama' when c.imb_type=3 then 'Penambahan' when c.imb_type=4 then 'Perbaikan' else 'Renovasi' end as jenisimb","a.ijin_id = '$_GET[id]'") as $val2){}

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
                <label class="col-sm-2" style="font-size: 13px;"><b>No. Pengajuan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_kode]?>
                </div>
            </div>
           <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Nama Bangunan</b></label>
                <div class="col-4">: 
                    <?=$val2[imb_name]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Lokasi Bangunan</b></label>
                <div class="col-4">: 
                    <?=$val2[imb_lokasi]?>
                </div>
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Type Bangunan</b></label>
                <div class="col-4">: 
                    <?=$val2[jenisimb]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Rencana Tanggal Pekerjaan</b></label>
                <div class="col-4">: 
                    <?=$val2[imb_tglpekerjaan]?>
                </div>
                
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Alasan Kebutuhan</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_keterangan]?>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Cost Center</b></label>
                <div class="col-4">: 
                    <?=$val2[ijin_costcenter]?>
                </div>
                
            </div>
               
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
                            echo "<b>".$cekhead2[statusijin]."</b> by <b>".$hh[nama_pegawai]."</b> on <b>".$cekhead2[app_createdate]."</b>";
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
                            echo "<b>".$cekhead3[statusijin]."</b> by <b>".$hh[nama_pegawai]."</b> on <b>".$cekhead3[app_createdate]."</b>";
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
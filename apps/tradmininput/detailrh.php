<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep left join m_jabatan e on a.id_jabatan=e.id_jabatan","a.*,b.ijinjenis_name,b.skema_id,c.nama_dep,e.nama_jabatan","a.ijin_id = '$_GET[id]'") as $val2){}

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
                    <?=$val2[nama_jabatan]?>
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
                    <button type="button" class="accordion"><?=$no.". ".$upd[berkas_deskripsi]?></button>
                    <div class="panel table-responsive" align="center">
                        <embed src="data/<?=$upd[upload_name]?>" width="50%" height="300"></embed>
                    </div>
                <?php $no++; } ?>
            </div>
<?php if($_SESSION['ID_JAB'] == 10 || $_SESSION['ID_JAB'] == 9 ) {?>
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
<?php } if ($_SESSION['ID_JAB'] == 10) { ?>
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
<?php } ?>  
<?php if ($_SESSION['ID_PEG'] == 99) { ?>      
<hr>    
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>No SK</b></label>
                <div class="col-4">
                    <input type="text" class="form-control input-sm headmas" name="ijin_nosk" id="ijin_nosk" style="min-width: 100%;" value="<?=$val2[ijin_nosk]?>" required>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Tempat Terbit</b></label>
                <div class="col-4">
                    <input type="text" class="form-control input-sm headmas" name="ijin_tempatterbit" id="ijin_tempatterbit" style="min-width: 100%;" value="<?=$val2[ijin_tempatterbit]?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Tgl Terbit</b></label>
                <div class="col-4">
                    <input type="date" class="form-control input-sm headmas" name="ijin_tglawalterbit" id="ijin_tglawalterbit" style="min-width: 100%;" value="<?=$val2[ijin_tglawalterbit]?>" required>
                </div>
                <label class="col-sm-2" style="font-size: 13px;"><b>Tgl Berakhir</b></label>
                <div class="col-4">
                    <input type="date" class="form-control input-sm headmas" name="ijin_tglakhirterbit" id="ijin_tglakhirterbit" style="min-width: 100%;" value="<?=$val2[ijin_tglakhirterbit]?>" required>
                </div>    
                
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Dikeluarkan Oleh</b></label>
                <div class="col-4">
                    <input type="text" class="form-control input-sm headmas" name="ijin_dikeluarkan" id="ijin_dikeluarkan" style="min-width: 100%;" value="<?=$val2[ijin_dikeluarkan]?>" required>
                </div>    
               <label class="col-sm-2" style="font-size: 13px;"><b>Remark</b></label>
                <div class="col-sm-4">: 
                    <textarea id="ijin_remarkadmin" name="ijin_remarkadmin"><?=$val2[ijin_remarkadmin]?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2" style="font-size: 13px;"><b>Upload</b></label>
                <div class="col-7">
                <?php 
                    $cekuplod = $db->select("uploaddata_sk","*","ijin_id = '$_GET[id]' and upload_status = 1");
                ?>
                    <input type="file" id="file" name="file">
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="uploadFile()">Upload</a>
                    <?php 
                        $jumisi = 0;
                        foreach($cekuplod as $cmm){
                            if($cmm[upload_id] > 0){
                                // echo '<a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="'.$cmm[upload_id].'" data-toggle="modal" id="detailrh">View Data</a>';
                                $jumisi = 1;
                            }
                        } 
                       if($jumisi==0){
                        echo '<a href="javascript:void(0)" class="btn btn-default btn-sm">Belum Upload</a>';
                       }
                    ?>
                    <input type="hidden" id="upload_id" name="upload_id" value="<?php foreach($cekuplod as $cu){echo $cu[upload_id];} ?>">
                </div>
                
            </div>
            <div class="form-group row col-sm-12" id="skupload">
                <?php include "skdata.php"; ?>
            </div>
                
            
<?php } ?>
            
            
            
        </div>
        <div class="col-sm-12"><hr></div>
            
            <div class="form-group row">
                <div class="col-12" align="center">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="approve(1)">Submit</a>
                    
                </div>
            </div>
    </div>
</form>
<script type="text/javascript">
    // var acc = document.getElementsByClassName("accordion");
    // var i;

    // for (i = 0; i < acc.length; i++) {
    //   acc[i].addEventListener("click", function() {
    //     this.classList.toggle("active");
    //     var panel = this.nextElementSibling;
    //     if (panel.style.maxHeight) {
    //       panel.style.maxHeight = null;
    //     } else {
    //       panel.style.maxHeight = panel.scrollHeight + "px";
    //     } 
    //   });
    // }

    function approve(type){
        if(type == 0 && $('#app_keterangan').val() == ''){
            alert("Harap Isi Remark!!");
            $('#app_keterangan').focus();
        } else {
            if(type == 1 && ($('#ijin_tempatterbit').val() == '' || $('#ijin_tglawalterbit').val() == '' || $('#ijin_tglakhirterbit').val() == '')){
                alert("Harap Lengkapi Tempat Terbit / Tanggal Terbit / Tanggal Berakhir");
            }
            else {
                var data = $('#form').serializeFormJSON();        
                $('#prosesloading').html('<img src="../assets/images/loading.gif">');
                $.post('apps/tradmininput/proses.php?act=save&type='+type,data,
                    function(msg) {
                        if(msg!==""){alert(msg);}
                       $('#prosesloading').html('');
                       window.location='index.php?x=tradmininput';
                    }
                );
            }
            
        }
        
    }

    function uploadFile(urut,id) {
       var files = document.getElementById("file").files;
       var idx = $("#upload_id").val();
       var ijinidz = $("#ijin_id").val();
       strijin = ijinidz.split("_");
       var ijinid = strijin[0];

       if(files.length > 0 ){

          var formData = new FormData();
          formData.append("file", files[0]);
          formData.append("idx", idx);
          formData.append("ijinid", ijinid);
       //alert(ijinid);   
          var xhttp = new XMLHttpRequest();

          // Set POST method and ajax file path
          xhttp.open("POST", "apps/tradmininput/upload.php", true);

          // call on request changes state
          xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {

               var response = this.responseText;
            
               if(response == 1){
                  alert("UPLOAD SUKSES");
                  $('#file_'+urut).val('');
                  $('#skupload').load("apps/tradmininput/skdata.php?id="+$('#ijin_id').val()+"&tek=1");
               } else if(response == 2){
                  alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");
                   $('#file_'+urut).val('');
                  $('#file_'+urut).focus();
               } else if(response == 3){
                  alert("UKURAN FILE TERLALU BESAR");
                   $('#file_'+urut).val('');
                   $('#file_'+urut).focus();
               } else{
                  alert("GAGAL UPLOAD FILE");
               }
             }
          };

          // Send request with data
          xhttp.send(formData);

       }else{
          alert("Please select a file");
       }

    }
</script>
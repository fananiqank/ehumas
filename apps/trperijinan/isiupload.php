<?php 
error_reporting(0);
session_start();

require_once "../../webclass.php";
$db = new kelas();
 
?>
<b>Upload Persyaratan </b>- (File: JPG,PNG | Max File: 2MB)
<table class="table" >
    <?php 
    $jumisi=0;
    $jo = 0;
    $no=1;
    foreach($db->select("m_berkas a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id","a.*,b.ijinjenis_name","berkas_status = 1 and b.ijinjenis_id = '$_GET[id]'") as $berkas){ 
        $cekuplod = $db->select("uploaddata","*","id_pegawai = '$_SESSION[ID_PEG]' and berkas_id='$berkas[berkas_id]' and upload_status = 0");
       
         
    ?>
        <tr>
            <td style="padding: 5px;"><?=$no?></td>
            <td colspan="2" style="padding: 5px;"><?=$berkas[berkas_deskripsi]?></td>
        </tr>
        <tr>
            <td style="padding: 5px;">&nbsp;</td>
            <td colspan="2"><input type="file" id="file_<?=$no?>" name="file[]"></td>
        </tr>
        <tr>
            <td style="padding: 5px;">&nbsp;</td>
            <td colspan="2" align="left"><a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="uploadFile(<?=$no?>,<?php foreach($cekuplod as $cu){echo $cu[upload_id];} ?>)">Upload</a>
            <?php 
                $jumisi = 0;
                foreach($cekuplod as $cmm){
                    if($cmm[upload_id] > 0){echo '<a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="'.$cmm[upload_id].'" data-toggle="modal" id="detailrh">View Data</a>';
                        $jumisi = 1;
                    }
                    
                } 
               if($jumisi==0){
                echo '<a href="javascript:void(0)" class="btn btn-default btn-sm">Belum Upload</a>';
            
               }
                   
            ?>
            <input type="hidden" id="upload_id_<?=$no?>" name="upload_id[]" value="<?php foreach($cekuplod as $cu){echo $cu[upload_id];} ?>">
            <input type="hidden" id="berkas_id_<?=$no?>" name="berkas_id[]" value="<?=$berkas[berkas_id]?>">
            </td>

        </tr>
    <?php 
    $no++; 
    $jumdata+=1;
    $jumisis+=$jumisi;
    $jumreq+=$berkas[berkas_required];
    }
    
    ?>
        <input type="hidden" name="jumdata" id="jumdata" value="<?=$jumdata?>">
        <input type="hidden" name="jumisi" id="jumisi" value="<?=$jumisis?>">
        <input type="hidden" name="jumreq" id="jumreq" value="<?=$jumreq?>">
        <tr>
            <td colspan="3" align="center"><a href="index.php?x=trperijinan" class="btn btn-warning ">Back</a>
                <button type="submit" class="btn btn-info" id="tambah">Simpan</button></td>
        </tr>
</table>
            
       
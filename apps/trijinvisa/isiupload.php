<?php 
    if($_GET[reload] == 1){
        session_start();
        require_once "../../webclass.php";
        $db = new kelas();
    }

?>
<table class="table" >
    <?php 
    $jo = 0;
    $no=1;
    foreach($db->select("m_berkas a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id","a.*,b.ijinjenis_name","berkas_status = 1 and b.ijinjenis_id = 1") as $berkas){ 
        echo "ijin_id = 1 and berkas_id='$berkas[berkas_id]'";
        foreach($db->select("uploaddata","*","ijin_id = 1 and berkas_id='$berkas[berkas_id]'") as $cc){}
         if($cc[ijin_id]>0){$judview = '<a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="<?=$cc[upload_id]?>" data-toggle="modal" id="detailrh">View Data</a>';}else{$judview = '<a href="javascript:void(0)" class="btn btn-default btn-sm">Belum Upload</a>';}
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
            <td colspan="2" align="left"><a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="uploadFile(<?=$no?>,<?=$cc[upload_id]?>)">Upload</a>
            <?=$judview?>
            <input type="" id="upload_id_<?=$no?>" name="upload_id[]" value="<?=$cc[upload_id]?>">
            </td>

        </tr>
    <?php 
    $no++; 
    $jumdata+=1;
    }
    
    ?>
        <input type="hidden" name="jumdata" id="jumdata" value="<?=$jumdata?>">
    
</table>
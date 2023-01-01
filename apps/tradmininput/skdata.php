<?php 

// if($GET['tek'] == 1){
session_start();
require_once "../../webclass.php";
$db = new kelas();    
// }
$cekuplod2 = $db->select("uploaddata_sk a join tx_perijinan b on a.ijin_id=b.ijin_id","a.*,b.ijin_nosk","a.ijin_id = '$_GET[id]' ");
foreach($cekuplod2 as $cmm){ 
     if($cmm[upload_id] > 0){
?>
<b><u>SK Data</u></b><br>
<?php $no = 1;
    foreach ($db->select("uploaddata_sk a","a.*","a.ijin_id='$_GET[id]'") as $upd) {?>
    <button type="button" class="accordion"><?=$no.". ".$cmm[ijin_nosk]?></button>
    <div class="panel table-responsive" align="center">
        <embed src="data/<?=$upd[upload_name]?>" width="50%" height="300" ></embed>
    </div>
<?php $no++; } }}?>

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
</script>
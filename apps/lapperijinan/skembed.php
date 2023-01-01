<?php
	session_start();
	require_once "../../webclass.php";
	$db = new kelas(); 
	$cekuplod2 = $db->select("uploaddata_sk a join tx_perijinan b on a.ijin_id=b.ijin_id","a.*,b.ijin_nosk","a.ijin_id = '$_GET[id]' ");
	foreach($cekuplod2 as $cmm){ 
		
?>
<div align="center">
<embed src="../../data/<?=$cmm[upload_name]?>" width="50%" height="400px"></embed>
</div>
<?php 
	}
	if($cmm[upload_id] == ""){

		echo "<div align='center'>No Upload Data</div>";
	}; 	
?>
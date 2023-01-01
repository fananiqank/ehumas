<?php 
// session_start();
// require_once "../../webclass.php";
//$db = new kelas();


echo "<option value='0'>Pilih Dept</option>";
 foreach($db->select("m_dep","*","id_dep = 1") as $val){
	if($mtc['id_dep'] == $val['id_dep']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[id_dep]' $s>$val[nama_dep]</option>"; 

}
?>
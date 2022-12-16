<?php 
if($_GET[rel] == 1){
	session_start();
	require_once "../../webclass.php";
	$db = new kelas();
}


foreach($db->select("m_skema_approve","*","skema_status > 0") as $val){ 
	if($_GET['skemaid'] == $val['skema_id']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[skema_id]' $s>$val[skema_name]</option>"; 

}
?>
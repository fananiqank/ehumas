
<?php 
if($_GET['reload']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}

echo "<option value=''>Pilih Jenis Ijin</option>";
 foreach($db->select("m_ijinjenis","*","ijinjenis_status=1") as $val){
	if($_GET['id'] == $val['ijinjenis_id']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[ijinjenis_id]' $s>$val[ijinjenis_name]</option>"; 

}
?>
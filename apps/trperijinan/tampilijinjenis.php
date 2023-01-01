
<?php 
if($_GET['rel']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}

echo "<option value='0'>Pilih Perijinan</option>";
 foreach($db->select("m_ijinjenis","*","ijinjenis_status = 1 and ijinjenis_type = '$type'") as $val){
	if($_GET['ijinjenis_id'] == $val['ijinjenis_id']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[ijinjenis_id]' $s>$val[ijinjenis_name]</option>"; 

}
?>
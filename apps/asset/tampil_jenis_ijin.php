
<?php 
if($_GET['status']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}


 foreach($db->select("m_ijinjenis","*","") as $val){
	if($_GET['status'] == $val['ijinjenis_id']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[ijinjenis_id]' $s>$val[ijinjenis_name]</option>"; 


}
?>
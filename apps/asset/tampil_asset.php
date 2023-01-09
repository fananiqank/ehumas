
<?php 
if($_GET['status']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}


 foreach($db->select("m_assetjenis","*","") as $val){
	if($_GET['status'] == $val['assetjenis_id']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[assetjenis_id]' $s>$val[assetjenis_name]</option>"; 


}
?>
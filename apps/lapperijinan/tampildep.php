
<?php 
if($_GET['reload']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}

echo "<option value=''>Pilih Dept</option>";
 foreach($db->select("m_dep","*","") as $val){
	if($_GET['id'] == $val['id_dep']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[id_dep]' $s>$val[nama_dep]</option>"; 

}
?>
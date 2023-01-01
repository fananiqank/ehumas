
<?php 
if($_GET['rel'] == 1){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}

echo "<option value=''>Pilih Jabatan</option>";
 foreach($db->select("m_jabatan","*","status = 1") as $val){
	if($_GET['id_jabatan'] == $val['id_jabatan']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[id_jabatan]' $s>$val[nama_jabatan]</option>"; 

}
?>
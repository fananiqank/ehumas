
<?php 
//if($_GET['reload']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
//}

echo "<option value=''>Pilih Asset</option>";
 foreach($db->select("m_assets","*","asset_st = 1 and assetjenis_id = 1") as $val){
	if($_GET['asset_id'] == $val['asset_id']) {
		$s = "selected";
	} else {
		$s = "";
	}
	echo "<option value='$val[asset_id]_$val[asset_name]_$val[asset_lokasi]_$val[asset_keterangan]' $s>$val[asset_name] - $val[asset_lokasi] - $val[asset_keterangan]</option>"; 

}
?>
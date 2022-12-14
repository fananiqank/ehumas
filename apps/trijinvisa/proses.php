<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");

if($_GET[act]=='post'){

	$selno = $db->selectcount("tx_perijinan","ijin_id","");
 	
 	$nopart = $selno+1;
 	$nomasuk = 'VB' . sprintf('%05s', $nopart);
 	$data = array(
 		'ijin_name' => $_POST['ijin_name'],
		'ijin_jenis' => $_POST['ijinjenis_id'],
		'ijin_nosk' => $nomasuk,
		'dep_id' => $_POST['dep_id'],
		'ijin_tglpengajuan' => $date,
		'id_pegawai' => $_SESSION['ID_PEG'],
		'ijin_jabatan' => $_POST['ijin_jabatan']
 	);
	$last = $db->insertID("tx_perijinan",$data);
	$db->query("update uploaddata set
				upload_status = 1,
				ijin_id = $last
			where id_pegawai = '$_SESSION[ID_PEG]' and upload_status = '0'
 			");
	if($last){echo "1";}else{echo "0";}


	// $db->query("
	// 		update tx_mekanik set
	// 			id_mtc = $idmtc,
	// 			stinput='1'
	// 		where stinput = 0 and userinput = '$_SESSION[ID_PEG]'
 	// 		");


} else if($_GET[act]=='del'){
	
	$dt=$db->delete("tx_maintenancedtl",array("id_mtcdtl"=> $_GET[id]));
	// echo json_encode($dt);

}
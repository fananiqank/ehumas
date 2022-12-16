<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");

if($_GET[act]=='save'){
	
	$cekjml = $db->selectcount("tx_approve","app_id","ijin_id = '$_POST[ijin_id]'");
	
	$sequence = $cekjml+1;
 	$data = array(
		'skema_id' => $_POST['skema_id'],
		'ijin_id' => $_POST['ijin_id'],
		'id_pegawai' => $_SESSION['ID_PEG'],
		'app_keterangan' => $_POST['app_keterangan'],
		'app_createdate' => $date,
		'app_status' => $_GET[type],
		'skemadtl_seq' => $sequence
 	);
 	$last = $db->insertID("tx_approve",$data);
	
	if($_GET[type] == 0){
		$data2 = array(
			'ijin_status' => 0
		);
		$last2 = $db->update("tx_perijinan",$data2,"ijin_id = '$_POST[ijin_id]'");
	} 

} else if($_GET[act]=='del'){
	
	$dt=$db->delete("tx_perijinan",array("ijin_id"=> $_GET[id]));
	// echo json_encode($dt);

}
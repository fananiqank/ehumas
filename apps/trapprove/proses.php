<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");
$datez = date("ymd");

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

	foreach($db->select("m_ijinjenis","*","ijinjenis_id = '$_POST[ijinjenis_id]'") as $ijj){}
	$selno = $db->selectcount("tx_perijinan","ijin_id","ijin_status = 1 and ijin_nosk != ''");
 	
 	$nopart = $selno+1;
 	$nomasuk = $ijj[ijinjenis_inisial]."/".$datez."/".sprintf('%05s', $nopart);
 	
	$data3 = array(
 		'ijin_nosk' => $nomasuk,
		'ijin_tempatterbit' => $_POST['ijin_tempatterbit'],
		'ijin_tglawalterbit' => $_POST['ijin_tglawalterbit'],
		'ijin_tglakhirterbit' => $_POST['ijin_tglakhirterbit'],
 	);
 	$last3 = $db->update("tx_perijinan",$data3,"ijin_id = '$_POST[ijin_id]'");

} else if($_GET[act]=='del'){
	
	$dt=$db->delete("tx_perijinan",array("ijin_id"=> $_GET[id]));
	// echo json_encode($dt);

}
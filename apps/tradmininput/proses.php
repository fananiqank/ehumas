<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");
$datez = date("ymd");

if($_GET[act]=='save'){
		$exps = explode("_",$_POST['ijin_id']);
		foreach($db->select("m_ijinjenis","*","ijinjenis_id = '$_POST[ijinjenis_id]'") as $ijj){}
		$selno = $db->selectcount("tx_perijinan","ijin_id","ijin_status = 1 and ijin_nosk != ''");
	 	
	 	$nopart = $selno+1;
	 	$nomasuk = $ijj[ijinjenis_inisial]."/".$datez."/".sprintf('%05s', $nopart);
	 	
		$data3 = array(
	 		'ijin_nosk' => $_POST['ijin_nosk'],
			'ijin_tempatterbit' => $_POST['ijin_tempatterbit'],
			'ijin_tglawalterbit' => $_POST['ijin_tglawalterbit'],
			'ijin_tglakhirterbit' => $_POST['ijin_tglakhirterbit'],
			'ijin_remarkadmin' => $_POST['ijin_remarkadmin'],
			'ijin_dikeluarkan' => $_POST['ijin_dikeluarkan'],
	 	);

	 	$last3 = $db->update("tx_perijinan",$data3,"ijin_id = '$exps[0]'");
		
} else if($_GET[act]=='del'){
	
	$dt=$db->delete("tx_perijinan",array("ijin_id"=> $_GET[id]));
	// echo json_encode($dt);

}
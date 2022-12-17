<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");

if($_GET[act]=='post'){
	foreach($db->select("m_ijinjenis","*","ijinjenis_id = '$_POST[ijinjenis_id]'") as $ijj){}
	$selno = $db->selectcount("tx_perijinan","ijin_id","");
 	
 	$nopart = $selno+1;
 	$nomasuk = $ijj[ijinjenis_inisial] . sprintf('%05s', $nopart);
 	$data = array(
 		'ijin_name' => $_POST['ijin_name'],
		'ijinjenis_id' => $_POST['ijinjenis_id'],
		'ijin_kode' => $nomasuk,
		'dep_id' => $_POST['dep_id'],
		'ijin_tglpengajuan' => $date,
		'id_pegawai' => $_SESSION['ID_PEG'],
		'id_jabatan' => $_POST['id_jabatan'],
		'ijin_tglawal' => $_POST['ijin_tglawal'],
		'ijin_tglakhir' => $_POST['ijin_tglakhir'],
		'ijin_nik' => $_POST['ijin_nik'],
		'ijin_keterangan' => $_POST['ijin_keterangan']
 	);
 	//var_dump($data);
	$last = $db->insertID("tx_perijinan",$data);

	$db->query("update uploaddata set
				upload_status = 1,
				ijin_id = $last
			where id_pegawai = '$_SESSION[ID_PEG]' and upload_status = '0'
 			");
	if($last){echo "1";}else{echo "0";}


} else if($_GET[act]=='update'){
 	$data2 = array(
 		'ijin_nosk' => $_POST['ijin_nosk'],
		'ijin_tempatterbit' => $_POST['ijin_tempatterbit'],
		'ijin_tglawalterbit' => $_POST['ijin_tglawalterbit'],
		'ijin_tglakhirterbit' => $_POST['ijin_tglakhirterbit'],
		
 	);
 	$last = $db->update("tx_perijinan",$data2,"ijin_id = '$_POST[ijin_id]'");

	if($last){echo "Update Sukses";}else{echo "Gagal Update";}

} else if($_GET[act]=='del'){
	
	$dt=$db->delete("tx_perijinan",array("ijin_id"=> $_GET[id]));
	// echo json_encode($dt);

}
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
 	if($_POST['ijinjenis_id'] == 7 || $_POST['ijinjenis_id'] == 8){
 		$ijinname = $_POST['kalbar_name'];
 	} else if($_POST['ijinjenis_id'] == 9){
 		$ijinname = $_POST['imb_name'];
 	} else {
 		$ijinname = $_POST['ijin_name'];
 	}
 	$data = array(
 		'ijin_name' => $ijinname,
		'ijinjenis_id' => $_POST['ijinjenis_id'],
		'ijin_kode' => $nomasuk,
		'dep_id' => $_POST['dep_id'],
		'ijin_tglpengajuan' => $date,
		'id_pegawai' => $_SESSION['ID_PEG'],
		'id_jabatan' => $_POST['id_jabatan'],
		'ijin_tglawal' => $_POST['ijin_tglawal'],
		'ijin_tglakhir' => $_POST['ijin_tglakhir'],
		'ijin_nik' => $_POST['ijin_nik'],
		'ijin_keterangan' => $_POST['ijin_keterangan'],
		'ijin_costcenter' => $_POST['ijin_costcenter'],
 	);
 	//var_dump($data);
	$last = $db->insertID("tx_perijinan",$data);

	if($_POST['ijinjenis_id'] == 1){
		$data2 = array(
 		'ijin_id' => $last,
		'bvisa_jenis' => $_POST['bvisa_jenis'],
		'bvisa_alamat' => $_POST['bvisa_alamat'],
	 	);
		$last2 = $db->insertID("tx_bvisa",$data2);
	}

	if($_POST['ijinjenis_id'] == 3){
		$data3 = array(
 		'ijin_id' => $last,
		'visa_jenis' => $_POST['visa_jenis'],
	 	);
		$last3 = $db->insertID("tx_visa",$data3);
	}

	if($_POST['ijinjenis_id'] == 4){
		$data4 = array(
 		'ijin_id' => $last,
		'tka_status' => $_POST['tka_status'],
		'tka_lamatinggal' => $_POST['tka_lamatinggal'],
	 	);
		$last4 = $db->insertID("tx_visatka",$data4);
	}

	if($_POST['ijinjenis_id'] == 5){
		$data5 = array(
 		'ijin_id' => $last,
		'slo_tujuan' => $_POST['slo_tujuan'],
		'slo_biaya1' => $_POST['slo_biaya1'],
		'slo_biaya2' => $_POST['slo_biaya2'],
	 	);
		$last5 = $db->insertID("tx_slo",$data5);
	}

	if($_POST['ijinjenis_id'] == 6){
		$data6 = array(
 		'ijin_id' => $last,
		'sio_tujuan' => $_POST['sio_tujuan'],
		'sio_biaya1' => $_POST['sio_biaya1'],
		'sio_biaya2' => $_POST['sio_biaya2'],
	 	);
		$last6 = $db->insertID("tx_sio",$data6);
	}

	if($_POST['ijinjenis_id'] == 7){
		$data7 = array(
 		'ijin_id' => $last,
		'kalbar_name' => $_POST['kalbar_name'],
		'kalbar_type' => $_POST['kalbar_type'],
		'kaltbar_lokasi' => $_POST['kaltbar_lokasi'],
		'kalbar_jenisijin' => $_POST['kalbar_jenisijin'],
		'kalbar_pengajuan' => 1
	 	);
		$last7 = $db->insertID("tx_kalibrasi",$data7);
		$db->query("update tx_perijinan set ijin_name='$_POST[kalbar_name]' where ijin_id = '$last'");
	}

	if($_POST['ijinjenis_id'] == 8){
		$data8 = array(
 		'ijin_id' => $last,
		'kalbar_name' => $_POST['kalbar_name'],
		'kalbar_type' => $_POST['kalbar_type'],
		'kaltbar_lokasi' => $_POST['kaltbar_lokasi'],
		'kalbar_jenisijin' => $_POST['kalbar_jenisijin'],
		'kalbar_pengajuan' => 2
	 	);
		$last8 = $db->insertID("tx_kalibrasi",$data8);
		$db->query("update tx_perijinan set ijin_name='$_POST[kalbar_name]' where ijin_id = '$last'");
	}

	if($_POST['ijinjenis_id'] == 9){
		$data9 = array(
 		'ijin_id' => $last,
		'imb_name' => $_POST['imb_name'],
		'imb_lokasi' => $_POST['imb_lokasi'],
		'imb_type' => $_POST['imb_type'],
		'imb_tglpekerjaan' => $_POST['imb_tglpekerjaan']

	 	);
		$last9 = $db->insertID("tx_imb",$data9);
	}

	if($_POST['ijinjenis_id'] == 10){
		$data9 = array(
 		'ijin_id' => $last,
		'sia_tujuan' => $_POST['sia_tujuan'],
		'sia_biaya1' => $_POST['sia_biaya1'],
		'sia_biaya2' => $_POST['sia_biaya2'],
	 	);
		$last10 = $db->insertID("tx_sia",$data10);
	}

	if($_POST['ijinjenis_id'] == 11){
		$data10 = array(
 		'ijin_id' => $last,
		'ptka_hp' => $_POST['ptka_hp'],
		'ptka_email' => $_POST['ptka_email'],
		'ptka_name' => $_POST['ptka_name'],
		'ptka_paspor' => $_POST['ptka_paspor']

	 	);
		$last10 = $db->insertID("tx_ptka",$data10);
	}

	if($_POST['ijinjenis_id'] == 12){
		$data11 = array(
 		'ijin_id' => $last,
		'paspor_lamatinggal' => $_POST['paspor_lamatinggal'],
		'paspor_negara' => $_POST['paspor_negara'],
		

	 	);
		$last11 = $db->insertID("tx_paspor",$data11);
	}

	
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
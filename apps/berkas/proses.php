<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");

if($_GET[act]=='post'){
	$berkasid = $db->idurut("m_berkas","berkas_id");
	if($_POST[ijin_id] == ''){
		$db->query("
		insert into m_berkas (
			berkas_id,
			ijinjenis_id,
			berkas_deskripsi,
			berkas_status,
			berkas_createdate
		) 
		values (
			$berkasid,
			'$_POST[ijin_id]',
			'$_POST[berkas_nm]',
			'$_POST[berkas_status]',
			'$date'
		)");
	} else {
		$db->query("
		update m_berkas set  
			ijinjenis_id='$_POST[ijin_id]',
			berkas_deskripsi='$_POST[berkas_nm]',
			berkas_status='$_POST[berkas_status]'
		where berkas_id = '$_POST[berkas_id]'
		");
	}
	
} else if($_GET[act]=='get'){
	$dt=$db->select("m_berkas","*","berkas_id='$_GET[id]'");
	echo json_encode($dt);

}
<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");

if($_GET[act]=='post'){
	$db->query("
		insert into m_ijinjenis (
			ijinjenis_id,
			ijinjenis_name,
			ijinjenis_inisial,
			ijinjenis_status,
			ijinjenis_createdate
		) 
		values (
			'$_POST[ijin_id]',
			'$_POST[ijin_nm]',
			'$_POST[ijin_inisial]',
			'$_POST[ijin_status]',
			'$date'
		) ON DUPLICATE KEY UPDATE 
			ijinjenis_name='$_POST[ijin_nm]',
			ijinjenis_inisial='$_POST[ijin_inisial]',
			ijinjenis_status='$_POST[ijin_status]'
		");
} else if($_GET[act]=='get'){
	$dt=$db->select("m_ijinjenis","*","ijinjenis_id='$_GET[id]'");
	echo json_encode($dt);

}
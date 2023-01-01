<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");


if($_GET[act]=='post'){
	$ijinid = $db->idurut("m_ijinjenis","ijinjenis_id");
	if($_POST[ijin_id] == ''){
		$db->query("
		insert into m_ijinjenis (
			ijinjenis_id,
			ijinjenis_name,
			ijinjenis_inisial,
			ijinjenis_status,
			ijinjenis_createdate,
			skema_id,
			ijinjenis_type
		) 
		values (
			$ijinid,
			'$_POST[ijin_nm]',
			'$_POST[ijin_inisial]',
			'$_POST[ijin_status]',
			'$date',
			'$_POST[skema_id]',
			'$_POST[ijinjenis_type]'
		)");
	} else {
		$db->query("
		update m_ijinjenis set ijinjenis_name='$_POST[ijin_nm]',
			ijinjenis_inisial='$_POST[ijin_inisial]',
			ijinjenis_status='$_POST[ijin_status]',
			ijinjenis_type='$_POST[ijinjenis_type]'
		where ijinjenis_id = '$_POST[ijin_id]'");
	}
	
} else if($_GET[act]=='get'){
	$dt=$db->select("m_ijinjenis","*","ijinjenis_id='$_GET[id]'");
	echo json_encode($dt);

}
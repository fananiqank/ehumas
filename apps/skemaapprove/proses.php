<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");



if($_GET[act]=='post'){

	for($i=1;$i<=3;$i++){
		$apps[]=$_POST['app'.$i];
	}
	$aps = implode(";", $apps);
	echo $aps;
	die();
	$db->query("
		insert into m_skema_approve (
			skema_name,
			skema_approve,
			skema_status,
			skema_createdate
		) 
		values (
			'$_POST[skema_name]',
			'$aps',
			'$_POST[skema_status]',
			'$date'
		) ON DUPLICATE KEY UPDATE 
			skema_name='$_POST[skema_name]',
			skema_status='$_POST[skema_status]',
			skema_approve=$aps,
		");
} else if($_GET[act]=='get'){
	$dt=$db->select("m_ijinjenis","*","ijinjenis_id='$_GET[id]'");
	echo json_encode($dt);

}
<?php
session_start();
// error_reporting(0);
include "../../webclass.php";
$db=new kelas();
$date = date("Y-m-d H:i:s");

if($_GET[act]=='post'){
	$assetsid = $db->idurut("m_assets","asset_id");
	if($_POST[asset_id] == ''){
		
		$db->query("
		insert into m_assets (
			asset_id,
			assetjenis_id,
			asset_no,
			asset_name,
			asset_lokasi,
			asset_ukuran,
			asset_type,
			asset_keterangan
		) 
		values (
			$assetsid,
			'$_POST[assetjenis_id]',
			'$_POST[asset_no]',
			'$_POST[asset_name]',
			'$_POST[asset_lokasi]',
			'$_POST[asset_ukuran]',
			'$_POST[asset_type]',
			'$_POST[asset_keterangan]'
		)");
	} else {
		$db->query("
		update m_assets set  
			asset_no='$_POST[asset_no]',
			asset_name='$_POST[asset_name]',
			asset_lokasi='$_POST[asset_lokasi]',
			asset_ukuran='$_POST[asset_ukuran]',
			asset_type='$_POST[asset_type]',
			asset_keterangan='$_POST[asset_keterangan]'
		where asset_id = '$_POST[asset_id]'
		");
	}
	
} else if($_GET[act]=='get'){
	$dt=$db->select("m_assets","*","asset_id='$_GET[id]'");
	echo json_encode($dt);

}
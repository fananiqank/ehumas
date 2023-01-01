<?php

session_start();
error_reporting(0);
include "../../webclass.php";
$db=new kelas();
foreach($db->select("m_jabatan","hak_approve","id_jabatan = '$_SESSION[ID_JAB]'") as $jab){}
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use

$table = "tx_perijinan";

// Table's primary key
$primaryKey = 'ijin_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array('db'      => 'no_urut','dt'   => 0, 'field' => 'no_urut',
		   'formatter' => function( $d, $row ) {
			return"$d";
			}
		  ),
	array('db'      => 'ijinjenis_name','dt'   => 1, 'field' => 'ijinjenis_name',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'ijin_kode','dt'   => 2, 'field' => 'ijin_kode',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'ijin_nosk','dt'   => 3, 'field' => 'ijin_nosk',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'ijin_name','dt'   => 4, 'field' => 'ijin_name',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'nama_dep','dt'   => 5, 'field' => 'nama_dep',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'ijin_id','dt'   => 6, 'field' => 'ijin_id',
		   'formatter' => function( $d, $row ) {
			//return "<a href='javascript:void(0)' onclick=\"delCart('$d')\">Hapus</a>";
			return "<a href='javascript:void(0)' class='btn btn-warning btn-sm' data-id=\"$d\" data-toggle=\"modal\" id=\"detailrh\">Check</a>";
					 
			}
		  ),
	
		  
	
	
		
);

// SQL server connection information
$sql_details = array(
	'user' => $db->usernya(),
	'pass' => $db->passnya(),
	'db'   => $db->dbnya(),
	'host' => $db->hostnya()
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('../../lib/ssp.customized.class.php' );
if($jab['hak_approve'] == '1'){
	if($_SESSION['ID_JAB'] == 8){
		$joinQuery = "FROM (SELECT @rownum:=@rownum+1 no_urut,a.*,b.ijinjenis_name,c.nama_dep from tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep JOIN (SELECT @rownum:=0) r where a.dep_id = '$_SESSION[ID_DEP]' and a.ijin_id not in (select ijin_id from tx_approve) ) a";
	} else if($_SESSION['ID_JAB'] == 9){
		$joinQuery = "FROM (SELECT @rownum:=@rownum+1 no_urut,a.*,b.ijinjenis_name,c.nama_dep from tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep JOIN (SELECT @rownum:=0) r where a.ijin_id in (select ijin_id from tx_approve where skemadtl_seq = 1 and app_status = 1 and ijin_id not in (select ijin_id from tx_approve where skemadtl_seq > 1))) a";
	} else if($_SESSION['ID_JAB'] == 10){
		$joinQuery = "FROM (SELECT @rownum:=@rownum+1 no_urut,a.*,b.ijinjenis_name,c.nama_dep from tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep JOIN (SELECT @rownum:=0) r where a.ijin_id in (select ijin_id from tx_approve where skemadtl_seq = 2 and app_status = 1 and ijin_id not in (select ijin_id from tx_approve where skemadtl_seq > 2))) a";
	} else {
		$joinQuery = "FROM (SELECT @rownum:=@rownum+1 no_urut,a.*,b.ijinjenis_name,c.nama_dep from tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep JOIN (SELECT @rownum:=0) r ) a";
	}
	
} 

$extraWhere = "";        
//echo $joinQuery;

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
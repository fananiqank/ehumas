<?php

session_start();
error_reporting(0);
include "../../webclass.php";
$db=new kelas();

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
	array('db'      => 'det','dt'   => 5, 'field' => 'det',
		   'formatter' => function( $d, $row ) {
		   	$expd = explode('_', $d);
		   	if($expd[3] == 0){
		   		$ddet = "";
		   		$btncol = "btn-danger";
		   	} else {
		   		if($expd[1]==$expd[2]){
			   		// $ddet = "<a href='javascript:void(0)' data-id=\"$expd[0]\" data-toggle=\"modal\" id=\"detailrh3\" class='btn btn-info btn-sm'>Edit</a>";
			   		$ddet = "";
			   		$btncol = "btn-success";
		   		} else {
		   			$ddet = "";
		   			$btncol = "btn-warning";
		   		} 		   		
		   	}
			//return "<a href='javascript:void(0)' onclick=\"delCart('$d')\">Hapus</a>";
			return "<a href='javascript:void(0)' data-id=\"$expd[0]\" data-toggle=\"modal\" id=\"detailrh2\" class='btn ".$btncol." btn-sm'>Detail</a>".$ddet;
					 
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

$joinQuery = "FROM (SELECT @rownum:=@rownum+1 no_urut,a.*,b.ijinjenis_name,concat(a.ijin_id,'_',coalesce(c.maxseq,0),'_',coalesce(d.maxseqapp,0),'_',ijin_status) det 
from tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id 
left join (select max(skemadtl_seq) maxseq,skema_id from m_skema_approve_dtl GROUP BY skema_id) c
on b.skema_id=c.skema_id
left join (select max(skemadtl_seq) maxseqapp,ijin_id from tx_approve GROUP BY ijin_id) d
on a.ijin_id=d.ijin_id JOIN (SELECT @rownum:=0) r where id_pegawai = '$_SESSION[ID_PEG]') a";
$extraWhere = "";        
//echo $joinQuery;

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
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
	array('db'      => 'ijin_nosk','dt'   => 1, 'field' => 'ijin_nosk',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'ijin_name','dt'   => 2, 'field' => 'ijin_name',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'jenis_visa','dt'   => 3, 'field' => 'jenis_visa',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array('db'      => 'ijin_id','dt'   => 4, 'field' => 'ijin_id',
		   'formatter' => function( $d, $row ) {
			//return "<a href='javascript:void(0)' onclick=\"delCart('$d')\">Hapus</a>";
			return "<a href='javascript:void(0)' data-id=\"$d\" data-toggle=\"modal\" id=\"detailrh\">History</a>";
					 
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

$joinQuery = "FROM (SELECT @rownum:=@rownum+1 no_urut,ijin_nosk,ijin_name,bvisa_jenis,case when bvisa_jenis = 1 then '211a/211B Single-Entry' else 'Multiple-Entry (VKUBP)' end jenis_visa  from tx_perijinan a join tx_bvisa b on a.ijin_id=b.ijin_id JOIN (SELECT @rownum:=0) r where ijinjenis_id = 1) a";
$extraWhere = "";        
//echo $joinQuery;

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
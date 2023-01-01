<?php 
session_start();
require_once "../webclass.php";
$db = new kelas();
foreach($db->select("include_form","*","ijinjenis_id = '$_GET[id]'") as $incform){
	 echo "<input type='hidden' id='inc_table' name='inc_table' value='".$incform[inc_table]."'>";
	 echo "<input type='hidden' id='inc_id' name='inc_id' value='".$incform[inc_id]."'>";
	 include $incform['inc_form'];
}
//include 'includeform/formvisabisnis.php';
?>
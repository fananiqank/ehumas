<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();
echo "select * from include_form where ijinjenis_id = '$_GET[id]'";
foreach($db->select("include_form","*","ijinjenis_id = '$_GET[id]'") as $incform){
	echo $incform[inc_form];
	include "'".$incform[inc_form]."'";
}
include './includeform/formvisabisnis.php';
?>
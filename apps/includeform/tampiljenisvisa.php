<?php 
if($_GET['reload'] == 1){
session_start();
require_once "../../webclass.php";
$db = new kelas();
} 
?>
	<option value='1' <?php if($_GET['bvisa_jenis'] == 1){echo "selected";}?>>211a/211B Single-Entry</option> 
	<option value='2' <?php if($_GET['bvisa_jenis'] == 2){echo "selected";}?>>Multiple-Entry (VKUBP)</option>

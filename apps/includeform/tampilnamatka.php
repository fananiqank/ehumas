
<?php 
if($_GET['rel']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}

echo "<option value=''>Pilih Status</option>";
?>
<option value="1">Permanen</option>
<option value="2">Sementara</option>
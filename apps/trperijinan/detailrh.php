<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("uploaddata","*","upload_id = '$_GET[id]'") as $val2){}

?>

<div class="table-responsive" align="center">
    <embed src="data/<?=$val2[upload_name]?>" width="50%" height="250"></embed>
</div>
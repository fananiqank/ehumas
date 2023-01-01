<?php 
session_start();
require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("uploaddata","*","upload_id = '$_GET[id]'") as $val2){}

?>

<div class="table-responsive">
    <embed src="data/<?=$val2[upload_name]?>" width="100%" height="400"></embed>
</div>
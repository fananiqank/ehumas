
<?php 
if($_GET['divisi']){
session_start();
require_once "../../webclass.php";
$db = new kelas();
}


 foreach($db->select("hr_divisi","*","") as $val){
    if($_GET['divisi'] == $val['id_divisi']) {
        $s = "selected";
    } else {
        $s = "";
    }
    echo "<option value='$val[id_divisi]' $s>$val[nama_divisi]</option>"; 


}
?>
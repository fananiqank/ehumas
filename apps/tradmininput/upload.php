<?php 	
session_start();
error_reporting(0);
include "../../webclass.php";
$db=new kelas();

$date = date("Y-m-d H:i:s");
$date2 = date("Y-m-d_H-i-s");
if(isset($_FILES['file']['name'])){
	
	foreach($db->select("uploaddata_sk","upload_name","upload_id = '$_POST[idx]'") as $cekpict){}
	$cekupload = $db->selectcount("uploaddata_sk","upload_name","upload_id = '$_POST[idx]'");
   
   //data lama
	$datalama = '../../data/'.$cekpict[upload_name]; 
   // file name
   $filename = $_FILES['file']['name'];
   $filesname = $date2."_".$filename;
   // Location
   $location = '../../data/'.$filesname;
   $ukuran = $_FILES['file']['size'];
  
   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   // Valid extensions
   $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
   
   	if (file_exists($datalama)) {
		unlink($datalama);
	}

   $response = 0;
   if(in_array($file_extension,$valid_ext) === true){
	   	if ($ukuran < 2044070) {
	   		// Upload file
	   		if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
	   			//echo count($cekpict[upload_id]);
	   			if($cekupload > 0){
	   				$data = array(
						'upload_name' => $filesname,
						'upload_date' => $date,
						);
	   				//	var_dump($data);
						$exec = $db->update("uploaddata_sk", $data, "upload_id = '$_POST[idx]'");
						$response = 1;
	   			} else {
	   				$data = array(
	   					'ijin_id' => $_POST['ijinid'],
						'upload_name' => $filesname,
						'upload_date' => $date,
						'upload_status' => 1,
						'id_pegawai' => $_SESSION['ID_PEG']
						);
	   				//var_dump($data);
						$exec = $db->insert("uploaddata_sk", $data);
						$response = 1;
	   			}
	      	} else {
	      		$response = 4;
	      	}
	   	} else {
	   		$response = 3;
	   	}
   } else {
   	 $response = 2;
   }
    echo $response;
  // die();
  
   exit;
}
?>
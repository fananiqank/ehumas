<?php
require_once "../../lib/fpdf/fpdf.php";


class PDF extends FPDF
{
// Page header
  
  function Header()
  {
      // Logo  //posisi, posisi tinggi ,besar
      $this->Image('../../assets/image/KOP DAS.jpg',10,1,190); 
      // Line break
      $this->SetLineWidth(0.5);
      $this->Line(10,30,200,30);
      $this->SetLineWidth(1);
      $this->Line(10,31,200,31);
      $this->Ln(25);
  }

  // Page footer
  function Footer()
  {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Page number
      $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
  }

  function garis_tabel(){
    $this->SetLineWidth(0.5);
    $this->Line(10,77,200,77);
  }
  
}



require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep left join m_jabatan e on a.id_jabatan=e.id_jabatan","a.*,b.ijinjenis_name,b.skema_id,c.nama_dep,DATEDIFF(a.ijin_tglakhirterbit,a.ijin_tglawalterbit) as masaberlaku,e.nama_jabatan","a.ijin_kode = '$_GET[kode]'") as $val2){}

$no=1;


$pdf = new PDF("P","mm","A4");
$pdf->AliasNbPages();
$pdf->AddPage();


// $pdf->gbr('./pratama.png');
$pdf->SetFont('Arial','BU',12);
$pdf->Cell(190,7,"SK No:".$val2[ijin_nosk],0,0,'C');
$pdf->ln(12);

$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Jenis Perijinan",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijinjenis_name],0,0,'L');
$pdf->Cell(69,5,"Tanggal Terbit",0,0,'R');
$pdf->Cell(4,5,":",0,0,'R');
$pdf->Cell(38,5,date("d-m-Y", strtotime($val2[ijin_tglawalterbit])),0,1,'L');

$pdf->Cell(35,5,"No Pengajuan",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_kode],0,0,'L');
$pdf->Cell(69,5,"Tempat Terbit",0,0,'R');
$pdf->Cell(4,5,":",0,0,'R');
$pdf->Cell(38,5,$val2[ijin_tempatterbit],0,1,'L');

$pdf->Cell(35,5,"Nama",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_name],0,0,'L');
$pdf->Cell(69,5,"Masa Berlaku",0,0,'R');
$pdf->Cell(4,5,":",0,0,'R');
$pdf->Cell(38,5,$val2[masaberlaku]." Hari",0,1,'L');

$pdf->Cell(35,5,"NIK/Paspor",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_nik],0,1,'L');

$pdf->Cell(35,5,"Departement",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[nama_dep],0,1,'L');

$pdf->Cell(35,5,"Jabatan",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[nama_jabatan],0,1,'L');

$pdf->Cell(35,5,"Alasan Kebutuhan",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_keterangan],0,1,'L');

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 1") as $cekhead){} 
  if($cekhead[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead[id_pegawai]'") as $hh){}
    $app1 = $cekhead[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead[app_createdate]));
    $note1 = $cekhead['app_keterangan'];
                            
                        } else {
                            $app1 = "Waiting";
                        }

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 2") as $cekhead2){}
if($cekhead2[app_id] != '') {
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead2[id_pegawai]'") as $hh){}
      $app2 = $cekhead2[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead2[app_createdate])); 
                            
                        } else if ($cekhead[app_status] == 0) {
                            $app2 = "-";
                        } else {
                            $app2 = "Waiting";
                        }

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 3") as $cekhead3){} 
                        if($cekhead3[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                        $app3 = $cekhead3[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead3[app_createdate]));
                        } else if ($cekhead3[app_status] == 0) {
                            $app3 = "-";
                        } else {
                            $app3 = "Waiting";
                        }

$pdf->ln(5);
$pdf->SetFont('Arial','I',10);
$pdf->Cell(35,5,"Approve Head",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$app1,0,1,'L');
$pdf->Cell(35,5,"Note",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$note1,0,1,'L');

$pdf->SetFont('Arial','I',10);
$pdf->Cell(35,5,"Approve Head PGA",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$app2,0,1,'L');
$pdf->Cell(35,5,"Note",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$note2,0,1,'L');

$pdf->SetFont('Arial','I',10);
$pdf->Cell(35,5,"Approve Direktur",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$app3,0,1,'L');
$pdf->Cell(35,5,"Note",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$note3,0,1,'L');


$no = 1;
                    foreach ($db->select("uploaddata a join m_berkas b on a.berkas_id=b.berkas_id","a.*,b.berkas_deskripsi","ijin_id='$val2[ijin_id]'") as $upd) {
$pdf->AddPage();
$pdf->SetFont('Arial','I',10);
$pdf->Cell(35,5,"Lampiran Dokumen : ",0,1,'L');
$pdf->Cell(35,5,$upd[upload_name],0,1,'L');
$pdf->Image('../../data/'.$upd[upload_name],10,50,0,80);                    

               $no++; }

 //$pdf->Image('../../assets/image/KOP PAS.jpg',10,50,0,20,'JPG','www.dashteknologi.com');



                    








#output file PDF
$pdf->Output("".$val[arm_norangka].".pdf","I");
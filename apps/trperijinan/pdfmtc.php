<?php
require_once "../../lib/fpdf/fpdf.php";

class PDF extends FPDF
{
// Page header
  
  // function Header()
  // {
  //     // Logo  //posisi, posisi tinggi ,besar
  //     $this->Image('../../assets/image/LOGO_WILMAR.png',10,1,190); 
  //     // Line break
  //     $this->SetLineWidth(0.5);
  //     $this->Line(10,30,200,30);
  //     $this->SetLineWidth(1);
  //     $this->Line(10,31,200,31);
  //     $this->Ln(25);
  // }

  // Page footer
  // function Footer()
  // {
  //     // Position at 1.5 cm from bottom
  //     $this->SetY(-15);
  //     // Arial italic 8
  //     $this->SetFont('Arial','I',8);
  //     // Page number
  //     $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
  // }

  // function garis_tabel(){
  //   $this->SetLineWidth(0.5);
  //   $this->Line(10,77,200,77);
  // }
  
}

require_once "../../webclass.php";
$db = new kelas();

foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id = b.ijinjenis_id","*","a.ijin_id='$_GET[id]' ") as $tipe){}
$jenisIjin = $tipe['ijinjenis_id'];

//echo $jenisIjin;

if($jenisIjin == 7 || $jenisIjin == 8) {
foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id left join tx_kalibrasi c on a.ijin_id=c.ijin_id","a.*,b.ijinjenis_name,c.*, case when c.kalbar_jenisijin=1 then 'Baru' when c.kalbar_jenisijin=2 then 'Perpanjangan' else 'Perbaikan' end as jeniskalbar","a.ijin_id = '$_GET[id]'") as $val2){} 
}
else if($jenisIjin == 9) {
foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id left join tx_imb c on a.ijin_id=c.ijin_id","a.*,b.ijinjenis_name,c.*, case when c.imb_type=1 then 'Baru' when c.imb_type=2 then 'Lama' when c.imb_type=3 then 'Penambahan' when c.imb_type=4 then 'Perbaikan' else 'Renovasi' end as jenisimb","a.ijin_id = '$_GET[id]'") as $val2){} 
}
else{
foreach($db->select("tx_perijinan a join m_ijinjenis b on a.ijinjenis_id=b.ijinjenis_id join m_dep c on a.dep_id=c.id_dep left join m_jabatan e on a.id_jabatan=e.id_jabatan left join tx_bvisa d on d.ijin_id = a.ijin_id ","a.*,b.ijinjenis_name,b.skema_id,c.nama_dep,DATEDIFF(a.ijin_tglakhirterbit,a.ijin_tglawalterbit) as masaberlaku,e.nama_jabatan, case when d.bvisa_jenis=1 then '211a/211B Single-Entry' else 'Multiple-Entry (VKUBP)' end as jenisvisa","a.ijin_id = '$_GET[id]'") as $val2){} 
}


// var_dump($val2)

$tglPengajuan = date("d-m-Y",strtotime($val2[ijin_tglpengajuan]));
$tglAwal = date("d-m-Y",strtotime($val2[ijin_tglawalterbit]));
$tglAkhir = date("d-m-Y",strtotime($val2[ijin_tglakhirterbit]));

$no=1;
$pdf = new PDF("P","mm","A4");
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','',10);
$pdf->Cell(190,3,"ijinjenisID : ".$jenisIjin,0,1,'R'); // cek ijin jenis 

if($val2[ijinjenis_id] == 1){ // VISA BISNIS
$pdf->Image('../../assets/image/LOGO_WILMAR.png',10,1,190); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(190,1,$val2[ijinjenis_name],0,0,'C');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////

$pdf->Cell(50,5,"NAMA TKA",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_name],0,1,'L');

$pdf->Cell(50,5,"NOMOR PASPOR",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_nik],0,1,'L');

$pdf->Cell(50,5,"JENIS VISA",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[jenisvisa],0,1,'L');

$pdf->Cell(50,5,"MASA TINGGAL",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$tglAwal." S/D ".$tglAkhir,0,1,'L');

$pdf->Cell(50,5,"KEPERLUANNYA",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_keterangan],0,1,'L');

$pdf->Cell(50,5,"Beban Biaya / No. Cost Center",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_costcenter],0,1,'L');

$pdf->Cell(50,5,"Alamat Kantor Kedutaan RI",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[bvisa_alamat],0,1,'L');

$pdf->SetFont('Arial','',8);
$pdf->Cell(100,5,"(alamat kantor perwakilan kedutaan RI di negara Ybs/negara yg dipilih untuk memproses visanya )",0,1,'L');

///////////////////////////////////// TTD //////////////////////////////////////////////
$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50, 5, "Diminta Oleh,", 0, 0, 'C');
$pdf->Cell(115, 5, "Diketahui,", 0, 1, 'R');
$pdf->Cell(50, 5, "Head Departemen", 0, 0, 'C');
$pdf->Cell(118, 5, "PGA Manager", 0, 1, 'R');
$pdf->ln(15);
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(50,2, "(________________)", 0, 0, 'C');
$pdf->Cell(120,2, "( Andi Machmud )", 0, 1, 'R');

$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190, 5, "Disposisi Director", 0, 1, 'C');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,131,200,131); // garis

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 3") as $cekhead3){} 
                        if($cekhead3[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                        // $app3 = $cekhead3[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead3[app_createdate]));
                        $app3 ="V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else if ($cekhead3[app_status] == 0) {
                            $app3 = "V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else {
                            $app3 = "V";
                            $pdf->ln(5);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Disetujui",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditunda",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditolak",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,10,$app3,1,1,'L');
                        }
// $no = 1;
//                     foreach ($db->select("uploaddata a join m_berkas b on a.berkas_id=b.berkas_id","a.*,b.berkas_deskripsi","ijin_id='$val2[ijin_id]'") as $upd) {

//  if($upd[upload_name] == ''){
//     $TIDAK = " V";
//     $ADA = "";
//  }else if($upd[upload_name]!= ''){
//     $TIDAK = "";
//     $ADA = " V";
//  }
               
// $no++; }

$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10, 5, "Lembar Verifikasi Persyaratan Dokomen  :", 0, 1, 'L');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,163,200,163); // garis

$pdf->SetFont('Arial','',8);
$pdf->Cell(116, 5, "ADA", 0, 0, 'R');
$pdf->Cell(10, 5, "TIDAK", 0, 1, 'R');

 $num = 0;       
        // foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","*","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){
 foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","a.berkas_deskripsi,b.ijinjenis_name","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){

            foreach($db->select("uploaddata","*","ijin_id='$val2[ijin_id]'")as $cc){}

            if($cc[upload_name] == ''){
                            $TIDAK = " V";
                            $ADA = "";
                         }else if($cc[upload_name]!= ''){
                            $TIDAK = "";
                            $ADA = " V";
                        }

$num = $num+1;
$pdf->SetFont('Arial','',8);
$pdf->Cell(105,5,$num.". ".$berkas[berkas_deskripsi],0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(8,5,$ADA,1,0,'L');
$pdf->Cell(8,5,$TIDAK,1,1,'L');

}

$pdf->ln(3);
$pdf->Cell(10, 5, "Keterangan :", 0, 1, 'L');
$pdf->Cell(10,5,"Pengajuan Telex Visa selambat-lambatnya 14 hari sebelum tanggal permintaan  terhitung sejak persyaratan dokumen lengkap ",0,1,'L');
/////////////////////////////////////////////////////////////////////////////////////////////////////////


}else if($val2[ijinjenis_id] == 3){ // PASPOR
    $pdf->Image('../../assets/image/LOGO_WILMAR_INVITATION_LETTER.png',10,1,190); 
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
    $pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
    $pdf->ln(12);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10,30,200,30);
    $pdf->SetLineWidth(1);
    $pdf->Line(10,31,200,31);
    $pdf->Ln(10);
    ////////////////////////////////// KOP END ////////////////////////////////////
    
    $pdf->Cell(50,5,"NAMA TKA",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(39,5,$val2[ijin_name],0,1,'L');
    
    $pdf->Cell(50,5,"NOMOR PASPOR",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(39,5,$val2[ijin_nik],0,1,'L');
    
    $pdf->Cell(50,5,"JENIS VISA",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(39,5,$val2[jenisvisa],0,1,'L');
    
    $pdf->Cell(50,5,"RENCANA MASA TINGGAL",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(39,5,$tglAwal." S/D ".$tglAkhir,0,1,'L');
    
    $pdf->Cell(50,5,"ALASAN KEPERLUANNYA",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(50,5,$val2[ijin_keterangan],0,1,'L');
    

    ///////////////////////////////////// TTD //////////////////////////////////////////////
    $pdf->ln(10);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(50, 5, "Diminta Oleh,", 0, 0, 'C');
    $pdf->Cell(115, 5, "Diketahui,", 0, 1, 'R');
    $pdf->Cell(50, 5, "Head Departemen", 0, 0, 'C');
    $pdf->Cell(118, 5, "PGA Manager", 0, 1, 'R');
    $pdf->ln(15);
    $pdf->SetFont('Arial','BI',8);
    $pdf->Cell(50,2, "(________________)", 0, 0, 'C');
    $pdf->Cell(120,2, "( Andi Machmud )", 0, 1, 'R');
    
    $pdf->ln(10);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(190, 5, "Disposisi Director", 0, 1, 'C');
    $pdf->SetLineWidth(0.5); 
    $pdf->Line(10,117,200,117); // garis
    
    foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 3") as $cekhead3){} 
                            if($cekhead3[app_id] != ''){
                                foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                            // $app3 = $cekhead3[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead3[app_createdate]));
                            $app3 ="V";
    $pdf->ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,"Disetujui",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(5,5,$app3,1,1,'L');
    $pdf->ln(1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,"Ditunda",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(5,5,"",1,1,'L');
    $pdf->ln(1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,"Ditolak",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(5,5,"",1,1,'L');
                            } else if ($cekhead3[app_status] == 0) {
                                $app3 = "V";
    $pdf->ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,"Disetujui",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(5,5,"",1,1,'L');
    $pdf->ln(1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,"Ditunda",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(5,5,$app3,1,1,'L');
    $pdf->ln(1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,"Ditolak",0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(5,5,"",1,1,'L');
                            } else {
                                $app3 = "V";
                                $pdf->ln(5);
                                $pdf->SetFont('Arial','',10);
                                $pdf->Cell(35,5,"Disetujui",0,0,'L');
                                $pdf->Cell(4,5,":",0,0,'L');
                                $pdf->Cell(5,5,"",1,1,'L');
                                $pdf->ln(1);
                                $pdf->SetFont('Arial','',10);
                                $pdf->Cell(35,5,"Ditunda",0,0,'L');
                                $pdf->Cell(4,5,":",0,0,'L');
                                $pdf->Cell(5,5,"",1,1,'L');
                                $pdf->ln(1);
                                $pdf->SetFont('Arial','',10);
                                $pdf->Cell(35,5,"Ditolak",0,0,'L');
                                $pdf->Cell(4,5,":",0,0,'L');
                                $pdf->Cell(5,10,$app3,1,1,'L');
                            }
    
    $pdf->ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10, 5, "Lembar Verifikasi Persyaratan Dokomen  :", 0, 1, 'L');
    $pdf->SetLineWidth(0.5); 
    $pdf->Line(10,148,200,148); // garis
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(116, 5, "ADA", 0, 0, 'R');
    $pdf->Cell(10, 5, "TIDAK", 0, 1, 'R');
    
     $num = 0;       
            foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","a.berkas_deskripsi,b.ijinjenis_name","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){
    
                foreach($db->select("uploaddata","*","ijin_id='$val2[ijin_id]'")as $cc){}
    
                if($cc[upload_name] == ''){
                                $TIDAK = " V";
                                $ADA = "";
                             }else if($cc[upload_name]!= ''){
                                $TIDAK = "";
                                $ADA = " V";
                            }
    $num = $num+1;
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(105,5,$num.". ".$berkas[berkas_deskripsi],0,0,'L');
    $pdf->Cell(4,5,":",0,0,'L');
    $pdf->Cell(8,5,$ADA,1,0,'L');
    $pdf->Cell(8,5,$TIDAK,1,1,'L');
    
    }
    
    $pdf->ln(3);
    $pdf->Cell(10, 5, "Keterangan :", 0, 1, 'L');
    $pdf->Cell(10,5," Pengajuan Invitation Letter selambat-lambatnya 3 hari sebelum tanggal permintaan ",0,1,'L');
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
}else if($val2[ijinjenis_id] == 12){ // PASPOR
$pdf->Image('../../assets/image/LOGO_WILMAR_PASPOR.png',10,1,190); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////

$pdf->Cell(58,5,"NAMA",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_name],0,1,'L');

$pdf->Cell(58,5,"JABATAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[ijin_nik],0,1,'L');

$pdf->Cell(58,5,"TUJUAN NEGARA KUNJUNGAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[jenisvisa],0,1,'L');

$pdf->Cell(58,5,"RENCANA TANGGAL KEPERGIAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$tglAwal." S/D ".$tglAkhir,0,1,'L');

$pdf->Cell(58,5,"ALASAN BERPERGIAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_keterangan],0,1,'L');

///////////////////////////////////// TTD //////////////////////////////////////////////
$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50, 5, "Diminta Oleh,", 0, 0, 'C');
$pdf->Cell(115, 5, "Diketahui,", 0, 1, 'R');
$pdf->Cell(50, 5, "Head Departemen", 0, 0, 'C');
$pdf->Cell(118, 5, "PGA Manager", 0, 1, 'R');
$pdf->ln(15);
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(50,2, "(________________)", 0, 0, 'C');
$pdf->Cell(120,2, "( Andi Machmud )", 0, 1, 'R');

$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190, 5, "Disposisi Director", 0, 1, 'C');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,117,200,117); // garis

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 3") as $cekhead3){} 
                        if($cekhead3[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                        // $app3 = $cekhead3[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead3[app_createdate]));
                        $app3 ="V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else if ($cekhead3[app_status] == 0) {
                            $app3 = "V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else {
                            $app3 = "V";
                            $pdf->ln(5);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Disetujui",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditunda",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditolak",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,10,$app3,1,1,'L');
                        }

$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10, 5, "Lembar Verifikasi Persyaratan Dokomen  :", 0, 1, 'L');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,148,200,148); // garis

$pdf->SetFont('Arial','',8);
$pdf->Cell(121, 5, "ADA", 0, 0, 'R');
$pdf->Cell(10, 5, "TIDAK", 0, 1, 'R');

 $num = 0;       
        foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","a.berkas_deskripsi,b.ijinjenis_name","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){

            foreach($db->select("uploaddata","*","ijin_id='$val2[ijin_id]'")as $cc){}

            if($cc[upload_name] == ''){
                            $TIDAK = " V";
                            $ADA = "";
                         }else if($cc[upload_name]!= ''){
                            $TIDAK = "";
                            $ADA = " V";
                        }
$num = $num+1;
$pdf->SetFont('Arial','',8);
$pdf->Cell(110,5,$num.". ".$berkas[berkas_deskripsi],0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(8,5,$ADA,1,0,'L');
$pdf->Cell(8,5,$TIDAK,1,1,'L');

}

$pdf->ln(3);
$pdf->Cell(10, 5, "Keterangan :", 0, 1, 'L');
$pdf->Cell(10,5," - Pengajuan Paspor selambat-lambatnya 10 hari sebelum diperlukan ",0,1,'L');
$pdf->Cell(10,5," * Kelengkapan persyaratan dokumen disiapkan oleh yang berkepentingan ",0,1,'L');
/////////////////////////////////////////////////////////////////////////////////////////////////////////


}else if($val2[ijinjenis_id] == 4){
$pdf->Image('../../assets/image/LOGO_WILMAR_TKA.png',10,1,190); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END //////////////////////////////////// 

}else if($val2[ijinjenis_id] == 5){
$pdf->Image('../../assets/image/LOGO_WILMAR_SLO.png',10,1,190);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////

}else if($val2[ijinjenis_id] == 6){
$pdf->Image('../../assets/image/LOGO_WILMAR_SLO.png',10,1,190); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////

}else if($val2[ijinjenis_id] == 7){
$pdf->Image('../../assets/image/LOGO_WILMAR_TERRA.png',10,1,190); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////

}else if($val2[ijinjenis_id] == 8){
$pdf->Image('../../assets/image/LOGO_WILMAR_TERRA.png',10,1,190);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////

$pdf->Cell(58,5,"NAMA ALAT",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[kalbar_name],0,1,'L');

$pdf->Cell(58,5,"TYPE ALAT",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[kalbar_type],0,1,'L');

$pdf->Cell(58,5,"LOKASI ALAT",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[kalbar_lokasi],0,1,'L');

$pdf->Cell(58,5,"JENIS PERIJINAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[jeniskalbar],0,1,'L');

$pdf->Cell(58,5,"BIAYA (No. Cost Center)",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_costcenter],0,1,'L');

$pdf->Cell(58,5,"KETERANGAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_keterangan],0,1,'L');

///////////////////////////////////// TTD //////////////////////////////////////////////
$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50, 5, "Diminta Oleh,", 0, 0, 'C');
$pdf->Cell(115, 5, "Diketahui,", 0, 1, 'R');
$pdf->Cell(50, 5, "Head Departemen", 0, 0, 'C');
$pdf->Cell(118, 5, "PGA Manager", 0, 1, 'R');
$pdf->ln(15);
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(50,2, "(________________)", 0, 0, 'C');
$pdf->Cell(120,2, "( Andi Machmud )", 0, 1, 'R');

$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190, 5, "Disposisi Director", 0, 1, 'C');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,124,200,124); // garis

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 3") as $cekhead3){} 
                        if($cekhead3[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                        // $app3 = $cekhead3[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead3[app_createdate]));
                        $app3 ="V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else if ($cekhead3[app_status] == 0) {
                            $app3 = "V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else {
                            $app3 = "V";
                            $pdf->ln(5);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Disetujui",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditunda",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditolak",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,10,$app3,1,1,'L');
                        }

$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10, 5, "Lembar Verifikasi Persyaratan Dokomen  :", 0, 1, 'L');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,156,200,156); // garis

$pdf->SetFont('Arial','',8);
$pdf->Cell(121, 5, "ADA", 0, 0, 'R');
$pdf->Cell(10, 5, "TIDAK", 0, 1, 'R');

 $num = 0;       
        foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","a.berkas_deskripsi,b.ijinjenis_name","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){

            foreach($db->select("uploaddata","*","ijin_id='$val2[ijin_id]'")as $cc){}

            if($cc[upload_name] == ''){
                            $TIDAK = " V";
                            $ADA = "";
                         }else if($cc[upload_name]!= ''){
                            $TIDAK = "";
                            $ADA = " V";
                        }
$num = $num+1;
$pdf->SetFont('Arial','',8);
$pdf->Cell(110,5,$num.". ".$berkas[berkas_deskripsi],0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(8,5,$ADA,1,0,'L');
$pdf->Cell(8,5,$TIDAK,1,1,'L');

}

$pdf->ln(3);
$pdf->Cell(10, 5, "Keterangan :", 0, 1, 'L');
$pdf->Cell(10,5," - Pengajuan Paspor selambat-lambatnya 10 hari sebelum diperlukan ",0,1,'L');
$pdf->Cell(10,5," * Kelengkapan persyaratan dokumen disiapkan oleh yang berkepentingan ",0,1,'L');
/////////////////////////////////////////////////////////////////////////////////////////////////////////

}else if($val2[ijinjenis_id] == 9){ // IMB
$pdf->Image('../../assets/image/LOGO_WILMAR_IMB.png',10,1,190);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,7,"Form : ".$val2[ijin_kode],0,1,'R');
$pdf->Cell(190,7,"Tanggal Pengajuan : ".$tglPengajuan,0,0,'R');
$pdf->ln(12);
$pdf->SetLineWidth(0.5);
$pdf->Line(10,30,200,30);
$pdf->SetLineWidth(1);
$pdf->Line(10,31,200,31);
$pdf->Ln(10);
////////////////////////////////// KOP END ////////////////////////////////////  
$pdf->Cell(50,5,"NAMA BANGUNAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[imb_name],0,1,'L');

$pdf->Cell(50,5,"LOKASI BANGUNAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[imb_lokasi],0,1,'L');

$pdf->Cell(50,5,"TYPE BANGUNAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[jenisimb],0,1,'L');

$pdf->Cell(50,5,"TANGGAL PEKERJAAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(39,5,$val2[imb_tglpekerjaan],0,1,'L');

$pdf->Cell(50,5,"PEMBEBANAN BIAYA (AFCE)",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_costcenter],0,1,'L');

$pdf->Cell(50,5,"KETERANGAN",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(50,5,$val2[ijin_keterangan],0,1,'L');


///////////////////////////////////// TTD //////////////////////////////////////////////
$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50, 5, "Diminta Oleh,", 0, 0, 'C');
$pdf->Cell(115, 5, "Diketahui,", 0, 1, 'R');
$pdf->Cell(50, 5, "Head Departemen", 0, 0, 'C');
$pdf->Cell(118, 5, "PGA Manager", 0, 1, 'R');
$pdf->ln(15);
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(50,2, "(________________)", 0, 0, 'C');
$pdf->Cell(120,2, "( Andi Machmud )", 0, 1, 'R');

$pdf->ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190, 5, "Disposisi Director", 0, 1, 'C');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,122,200,122); // garis

foreach($db->select("tx_approve","*,case when app_status = 1 then 'Approved' else 'Rejected' end as statusijin","ijin_id = '$val2[ijin_id]' and skemadtl_seq = 3") as $cekhead3){} 
                        if($cekhead3[app_id] != ''){
                            foreach($db->select("m_pegawai","nama_pegawai","id_pegawai = '$cekhead3[id_pegawai]'") as $hh){}
                        // $app3 = $cekhead3[statusijin]." by ".$hh[nama_pegawai]." on ".date("d-m-Y H:i:s", strtotime($cekhead3[app_createdate]));
                        $app3 ="V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else if ($cekhead3[app_status] == 0) {
                            $app3 = "V";
$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Disetujui",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditunda",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,$app3,1,1,'L');
$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,5,"Ditolak",0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(5,5,"",1,1,'L');
                        } else {
                            $app3 = "V";
                            $pdf->ln(5);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Disetujui",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditunda",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,5,"",1,1,'L');
                            $pdf->ln(1);
                            $pdf->SetFont('Arial','',10);
                            $pdf->Cell(35,5,"Ditolak",0,0,'L');
                            $pdf->Cell(4,5,":",0,0,'L');
                            $pdf->Cell(5,10,$app3,1,1,'L');
                        }
                $no = 1;
                    foreach ($db->select("uploaddata a join m_berkas b on a.berkas_id=b.berkas_id","a.*,b.berkas_deskripsi","ijin_id='$val2[ijin_id]'") as $upd) {

                         if($upd[upload_name] == ''){
                            $TIDAK = " V";
                            $ADA = "";
                         }else if($upd[upload_name]!= ''){
                            $TIDAK = "";
                            $ADA = " V";
                         }
               $no++; }

$pdf->ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10, 5, "Lembar Verifikasi Persyaratan Dokomen  :", 0, 1, 'L');
$pdf->SetLineWidth(0.5); 
$pdf->Line(10,153,200,153); // garis

$pdf->SetFont('Arial','',8);
$pdf->Cell(123, 5, "ADA", 0, 0, 'R');
$pdf->Cell(10, 5, "TIDAK", 0, 1, 'R');

 $num = 0;       
        // foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","a.berkas_deskripsi,b.ijinjenis_name,(SELECT case when upload_name = NULL then 'V' else 'X' end as upload from uploaddata WHERE ijin_id = 19)as upload","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){
        //     if($berkas[upload_name] == ''){
        //                     $TIDAK = " V";
        //                     $ADA = "";
        //                  }else if($berkas[upload_name]!= ''){
        //                     $TIDAK = "";
        //                     $ADA = " V";
        //                 }

        foreach($db->select("m_berkas a join m_ijinjenis b ON a.ijinjenis_id = b.ijinjenis_id","a.berkas_deskripsi,b.ijinjenis_name","b.ijinjenis_id ='$val2[ijinjenis_id]'") as $berkas){

            foreach($db->select("uploaddata","*","ijin_id='$val2[ijin_id]'")as $cc){}

            if($cc[upload_name] == ''){
                            $TIDAK = " V";
                            $ADA = "";
                         }else if($cc[upload_name]!= ''){
                            $TIDAK = "";
                            $ADA = " V";
                        }

$num = $num+1;
$pdf->SetFont('Arial','',8);
$pdf->Cell(112,5,$num.". ".$berkas[berkas_deskripsi],0,0,'L');
$pdf->Cell(4,5,":",0,0,'L');
$pdf->Cell(8,5,$ADA,1,0,'L');
$pdf->Cell(8,5,$TIDAK,1,1,'L');

}

$pdf->ln(3);
$pdf->Cell(10, 5, "Keterangan :", 0, 1, 'L');
$pdf->Cell(10,5,"Pengajuan IMB selambat-lambatnya 6 bulan sebelum dimulainya pekerjaan pembangunan ",0,1,'L');
/////////////////////////////////////////////////////////////////////////////////////////////////////////

}






#output file PDF
$pdf->Output("".$val[arm_norangka].".pdf","I");
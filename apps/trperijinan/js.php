<script type="text/javascript">

$('.server-side').DataTable( {
        "processing": true,
        "serverSide": true,
        //"ajax": "../server_side/scripts/server_processing.php" NOTE: use serverside script to fatch the data
        "ajax": "apps/trperijinan/data.php"
    } );


$(document).ready(function(){
    $('#form input,#form select, #form select2 , #form textarea').jqBootstrapValidation({
        preventSubmit: true,
        submitSuccess: function($form, event){     
            event.preventDefault();
            if($('#jumisi').val()==$('#jumdata').val()){
                var data = $('#form').serializeFormJSON();        
                $('#prosesloading').html('<img src="../assets/images/loading.gif">');
                $.post('apps/trperijinan/proses.php?act=post',data,
                    function(msg) {
                        if(msg=="1"){alert("Data Tersimpan");}
                        else{alert("Gagal Tersimpan!!")}
                        //location.reload();
                         window.location='index.php?x=trperijinan';
                       // swal({
                       //       title: "Konfirmasi!",
                       //       text: msg,
                       //       type: "success"
                       //       //timer: 1000
                       //    });
                    }
                );          
            } else {
                alert("Upload Berkas Belum Lengkap");
            }
            
      },
      submitError: function ($form, event, errors) { 
         alert("Data Belum Lengkap");
     }
    });
});


    

    

// $(document).ready(function(){
//   $('#upload').on('click', function(event){
//     event.preventDefault();
//     var formData = new FormData();
//     formData.append('file', $('input[type=file]')[0].files[0]);
//     formData.append('txangkut_tgl', $('#txangkut_tgl').val());
//     formData.append('txangkut_shift', $('#txangkut_shift').val());
//     formData.append('id_site', $('#id_site').val());
//     formData.append('driver_id', $('#driver_id').val());
//     formData.append('arm_id', $('#arm_id').val());
//     $.ajax({
//       url:"app-assets/plugins/spreadsheet/ritasehaul.php?act=save",
//       method:"POST",
//       data:formData,
//       contentType:false,
//       cache:false,
//       processData:false,
//       success:function(data)
//       {
//         alert(data);
//          window.location='index.php?x=trperijinan';
//         // $('#excel_area').html(data);
//         // $('table').css('width','100%');
//       }
//     })
//   });
// });



function delCart(a){
    if($('idmtc').val() == ''){
        $.get( "apps/trperijinan/proses.php?act=del&id="+a, function( data ) {
            // $( ".result" ).html( data );

            $('.server-side').DataTable().ajax.reload();
        });
    } else {
        alert("Tidak dapat dihapus!!");
    }
}

function delCart2(a){
        $.get( "apps/trperijinan/proses2.php?act=del&id="+a, function( data ) {
            // $( ".result" ).html( data );

            $('.mekanikx').DataTable().ajax.reload();
        });
   
}

$(document).on('click','#detailrh',function(e){
    e.preventDefault();
        $("#defaultSize").modal('show');
        $.post('apps/trperijinan/detailrh.php?id='+$(this).attr("data-id"),
                function(html){
                $("#tampilhis").html(html);
                }   
            );
});

$(document).on('click','#detailrh2',function(e){
    e.preventDefault();
        $("#defaultSize2").modal('show');
        $.post('apps/trperijinan/detailrh2.php?id='+$(this).attr("data-id"),
                function(html){
                $("#tampilhis2").html(html);
                }   
            );
});

$(document).on('click','#detailrh3',function(e){
    e.preventDefault();
        $("#defaultSize2").modal('show');
        $.post('apps/trperijinan/detailrh3.php?id='+$(this).attr("data-id"),
                function(html){
                $("#tampilhis2").html(html);
                }   
            );
});


function uploadFile(urut,id) {
   var files = document.getElementById("file_"+urut).files;
   var idx = $("#upload_id_"+urut).val();
   var berkasid = $("#berkas_id_"+urut).val();
   
   if(files.length > 0 ){

      var formData = new FormData();
      formData.append("file", files[0]);
      formData.append("idx", idx);
      formData.append("berkas_id", berkasid);
   
      var xhttp = new XMLHttpRequest();

      // Set POST method and ajax file path
      xhttp.open("POST", "apps/trperijinan/upload.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {

           var response = this.responseText;
        
           if(response == 1){
              alert("UPLOAD SUKSES");
              $('#file_'+urut).val('');
              $('#syaratupload').load("apps/trperijinan/isiupload.php?id="+$('#ijinjenis_id').val());
           } else if(response == 2){
              alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");
               $('#file_'+urut).val('');
              $('#file_'+urut).focus();
           } else if(response == 3){
              alert("UKURAN FILE TERLALU BESAR");
               $('#file_'+urut).val('');
               $('#file_'+urut).focus();
           } else{
              alert("GAGAL UPLOAD FILE");
           }
         }
      };

      // Send request with data
      xhttp.send(formData);

   }else{
      alert("Please select a file");
   }

}

function tampilsyarat(id){
    //alert(id);
        $('#syaratupload').load("apps/trperijinan/isiupload.php?id="+id);
}
</script>
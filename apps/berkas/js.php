<script type="text/javascript">
$('.server-side').DataTable( {
        "processing": true,
        "serverSide": true,
        //"ajax": "../server_side/scripts/server_processing.php" NOTE: use serverside script to fatch the data
        "ajax": "apps/berkas/data.php"
    } );

$(document).ready(function(){
    $("#simpan").click(function(){
            $('#form input,#form select, #form select2 ').jqBootstrapValidation({
                preventSubmit: true,
                submitSuccess: function($form, event){     
                    event.preventDefault();
                    var data = $('#form').serializeFormJSON();        
                    $('#prosesloading').html('<img src="./assets/images/loading.gif">');
                    $.post('apps/berkas/proses.php?act=post',data,

                        function(msg) {
                           $('#prosesloading').html('');
                           $('#form').load("apps/berkas/tampilform.php?reload=1");
                           $('.server-side').DataTable().ajax.reload();
                           swal({
                                 title: "Input Success!",
                                 text: msg,
                                 type: "success"
                                 //timer: 1000
                              });
                        }
                    );
              },
              submitError: function ($form, event, errors) { 
                 //alert("Data Belum Lengkap");
             }
         });

     });

    
});
function nolam(a){
    const custcode=a.split("_");
    const lam=$('#arm_nolambungx').val();
    console.log(a);
    if(custcode[0]===""){
        alert("Pilih Customer");
    } else {
        $('#nolambung').html(custcode[1]+lam);
        $('#arm_nolambung').html(custcode[1]+lam);
    }
}
function getEdit(a){
     $.get( "apps/berkas/proses.php?act=get&id="+a, function( data ) {
        // $( ".result" ).html( data );
        var jsonData = JSON.parse(data);
        for (var i = 0; i < jsonData.length; i++) {
            var counter = jsonData[i];
            //console.log(counter.ijinjenis_id);
            // alert(counter.cust_id+"_"+counter.arm_nolambung.substring(0,3));
            $('#berkas_id').val(counter.berkas_id);
            $('#berkas_nm').val(counter.berkas_deskripsi);
            $('#ijin_id').load("apps/berkas/tampil_jenis_ijin.php?status="+counter.ijinjenis_id);
            $('#berkas_status').load("apps/berkas/tampilstatus.php?status="+counter.berkas_status);

        }
        
    });
    
}

function getLambung(a){
    // $('#large').modal('show');
    $.get( "apps/berkas/getDetail.php?act=get&id="+a, function( data ) {

        $('#detailarmada').html(data);
        $('#large').modal('show');

    });
}
function cekMerk(val) {
  $('#arm_type').load("apps/armada/tampiltype.php?merk="+val);
}

function reset() {
    $('#prosesloading').html('');
   // $('.frhead').trigger("reset");
   // $('.frhead').val(null).trigger('change');
    $('#form').load("apps/ijinjenis/tampilform.php?reload=1");
    $('.server-side').DataTable().ajax.reload();

}

function simpandetail(){
    // alert("test");
    var form = $( "#formku" ).serializeArray();
    // alert(JSON.stringify(form));
    // alert(form[4].value);
    $("#detailarmada > tbody"). empty();
    $.post( "apps/armada/simpandetail.php", $( "#formku" ).serialize())
      .done(function( data ) {
        alert( "Data Loaded: " + data + " - " + $('#arm_id').val());
        $("#detailarmada > tbody"). empty();
        loaddetail(form[4].value);
      });

}

function loaddetail(a){
    
    $.get( "apps/armada/getDetailRow.php?act=get&id="+a, function( data ) {
        $('#detailarmada tr:last').after(data);
    });
}
</script>


<script type="text/javascript">
$('.server-side').DataTable( {
        "processing": true,
        "serverSide": true,
        //"ajax": "../server_side/scripts/server_processing.php" NOTE: use serverside script to fatch the data
        "ajax": "apps/skemaapprove/data.php"
    } );

$(document).ready(function(){
    $("#simpan").click(function(){
            $('#form input,#form select, #form select2 ').jqBootstrapValidation({
                preventSubmit: true,
                submitSuccess: function($form, event){     
                    event.preventDefault();
                    alert("Asa");
                    var data = $('#form').serializeFormJSON();        
                    $('#prosesloading').html('<img src="./assets/images/loading.gif">');
                    $.post('apps/skemaapprove/proses.php?act=post',data,

                        function(msg) {
                           $('#prosesloading').html('');
                           //$('#form').load("apps/skemaapprove/tampilform.php?reload=1");
                           //$('.server-side').DataTable().ajax.reload();
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
                 alert("Data Belum Lengkap");
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
     $.get( "apps/skemaapprove/proses.php?act=get&id="+a, function( data ) {
        // $( ".result" ).html( data );
        var jsonData = JSON.parse(data);
        for (var i = 0; i < jsonData.length; i++) {
            var counter = jsonData[i];
            //console.log(counter.skemaapprove_id);
            // alert(counter.cust_id+"_"+counter.arm_nolambung.substring(0,3));
            $('#ijin_id').val(counter.skemaapprove_id);
            $('#ijin_nm').val(counter.skemaapprove_name);
            $('#ijin_status').load("apps/skemaapprove/tampilstatus.php?status="+counter.skemaapprove_status);

        }
        
    });
    
}

function getLambung(a){
    // $('#large').modal('show');
    $.get( "apps/armada/getDetail.php?act=get&id="+a, function( data ) {

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
    $('#form').load("apps/skemaapprove/tampilform.php?reload=1");
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


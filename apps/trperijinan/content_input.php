<form class="form-user" id="form" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
<?php 
    if($_GET[x] == 'trperijinaninput1'){
        $xinput = 'trperijinan';
        $type = 1;
    } else if($_GET[x] == 'trperijinaninput2'){
        $xinput = 'trperijinan2';
        $type = 2;
    } else if($_GET[x] == 'trperijinaninput3'){
        $xinput = 'trperijinan3';
        $type = 3;
    }
?>  
<section class="card">
<header class="card-header">
    <div class="card-actions">
        <a href="#" class="fa fa-caret-down"></a>
    </div>
    <h2 class="card-title">Input Perijinan</h2>
    <p class="card-subtitle">
        <a href="index.php?x=trperijinan<?=$type?>" style="float:right;" class="btn btn-info btn-sm">Back to List</a>
    </p>
</header>
<div class="card-body">

<div class="row">
    <div class="col-md-6">
        <div class="form-group row form-inline">
         <input type="hidden" name="typeijin" id="typeijin" value="<?=$type?>">
            <label class="col-sm-3 control-label" for="w1-username">Jenis Perijinan</label>
            <div class="col-sm-9">
                <select class="select2 form-control block headmas" id="ijinjenis_id" name="ijinjenis_id" onchange="tampilsyarat(this.value,<?=$type?>,'<?=$_GET[x]?>')" required>
                    <?php include "tampilijinjenis.php"; ?>
                </select>
            </div>
            
        </div>
        <div id="tampilperijinan">
        </div>
    </div>
    <div class="col-md-6">
        
        
        <div id="syaratupload">
            
            <?php //include "isiupload.php"; ?>
        </div>
        
    </div>
</div>
</div>
 <hr>
</section>
</form>
<div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18"><i class="la la-list"></i>View Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tampilhis">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>                                      
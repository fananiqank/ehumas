<section class="card">
<header class="card-header">
    <div class="card-actions">
        <a href="#" class="fa fa-caret-down"></a>
    </div>
    <h2 class="card-title">Pengajuan Perijinan</h2>
    <p class="card-subtitle">
    </p>
</header>
<div class="card-body">
<?php
    if($_GET[x] == 'trperijinan1'){
        $xinput = 'trperijinaninput1';
        $type = 1;
    } else if($_GET[x] == 'trperijinan2'){
        $xinput = 'trperijinaninput2';
        $type = 2;
    } else if($_GET[x] == 'trperijinan3'){
        $xinput = 'trperijinaninput3';
        $type = 3;
    }
 ?>
<div class="row">
    <div class="col-12">
        <div class="btn-group float-md-right" style="margin-bottom: 1%">
            <a class="btn btn-info" href="index.php?x=trperijinaninput<?=$type?>">Input</a>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="table-responsive">  
            <input type="hidden" name="typeijin" id="typeijin" value="<?=$type?>">
            <input type="hidden" name="xinput" id="xinput" value="<?=$xinput?>"> 
            <table class="table table-striped table-bordered server-side" id="trijinvisa">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis</th>
                        <th>No Pengajuan</th>
                        <th>No SK</th>
                        <th>Nama</th>
                        <th>Dtl</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Jenis</th>
                        <th>No Pengajuan</th>
                        <th>No SK</th>
                        <th>Nama</th>
                        <th>Dtl</th>
                        <th>#</th>
                    </tr>
                </tfoot>
            </table>
        </div>
         
    </div>
</div>
</section>
<div class="modal fade text-left" id="defaultSize2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18"><i class="la la-list"></i>Perijinan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tampilhis2">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>                                      
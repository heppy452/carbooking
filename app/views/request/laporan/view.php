<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if(!empty($panel)){echo $panel;}?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Tanggal Awal </label>
                                <input class="form-control date" value="<?php echo date('Y-m-d'); ?>" type="text" id="start_date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Tanggal Akhir </label>
                                <input class="form-control date" value="<?php echo date('Y-m-d'); ?>" type="text" id="end_date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-default center-block" id="btn_cari"> <i class="fa fa-search"></i>&nbsp; Search</button>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-default center-block" id="btn_download"> <i class="fa fa-download"></i>&nbsp; Download</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
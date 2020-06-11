<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if(!empty($panel)){echo $panel;}?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="control-label">NAMA SOPIR </label>
                                <select class="form-control" id="id_driver">
                                    <option value="">--- PILIH ---</option>
                                    <?php $this->m_print_jadwal->select_driver(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="control-label">TANGGAL JADWAL </label>
                                <input class="form-control date" value="<?php echo date('Y-m-d'); ?>" type="text" id="tgl_jadwal">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-default center-block" id="btn_cari">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
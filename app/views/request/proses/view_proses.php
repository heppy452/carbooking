<div class="container-fluid">
    <?= $this->l_skin->breadcrumb(); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if (!empty($panel)) {
                        echo $panel;
                    } ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="control-label">Tanggal Awal </label>
                                <input class="form-control tanggalproses" value="<?php echo date('Y-m-d'); ?>" type="text" id="start_date">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="control-label">Tanggal Akhir </label>
                                <input class="form-control tanggalproses" value="<?php echo date('Y-m-d'); ?>" type="text" id="end_date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-default center-block" id="btn_cari"> <i class="fa fa-search"></i>&nbsp; Search</button>
                            </div>
                        </div>
                    </div>
                    <div id="tabel_pencarian"></div>
                    <div id="hide">
                        <table class="table table-bordered table-hover" id="tabel_proses">
                            <thead>
                                <tr>
                                    <th>Nomor Tiket</th>
                                    <th>Tanggal Jadwal</th>
                                    <th>Lokasi Keberangkatan</th>
                                    <th>Lokasi Tujuan</th>
                                    <th>Kendaraan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
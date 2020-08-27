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
                    <table class="table table-bordered table-hover" id="tabel_custom">
                        <thead>
                            <tr>
                                <th>Nomor Tiket</th>
                                <th>Tanggal Jadwal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Lokasi Keberangkatan</th>
                                <th>Lokasi Tujuan</th>
                                <th>Perusahaan</th>
                                <th>Divisi</th>
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
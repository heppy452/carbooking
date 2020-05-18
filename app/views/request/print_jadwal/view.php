<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if(!empty($panel)){echo $panel;}?>
                </div>
                <div class="card-body">
                    <button id="add_btn" class="btn btn-default"><i class="fa fa-user-plus"></i> Tambah Data</button><hr>
                    <table class="table table-bordered table-hover" id="tabel_custom">
                        <thead>
                            <tr>
                                <th>Nomor Tiket</th>
                                <th>Waktu Penjemputan</th>
                                <th>Lokasi Awal</th>
                                <th>Lokasi Tujuan</th>
                                <th>Approval Atasan</th>
                                <th>Approval GA</th>
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
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
                                <th>Nomor Pemesanan</th>
                                <th>Tanggal & Jam Penjemputan</th>
                                <th>Jenis Kebutuhan</th>
                                <th>Jenis Lokasi</th>
                                <th>Lokasi Awal</th>
                                <th>Lokasi Tujuan</th>
                                <th>Approval Atasan</th>
                                <th>Approval GA</th>
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
<div id="popup_menu" class="popup_box">
    <button class="btn btn-default btn-block" id="edit_btn"><i class="ion-edit"></i>&nbsp;&nbsp;Ubah</button>
    <button class="btn btn-default btn-block" id="delete_btn"><i class="ion-trash-a"></i>&nbsp;&nbsp;Hapus</button>
    <button class="btn btn-default btn-block" id="reset_btn"></i>&nbsp;&nbsp;Tampil</button>
</div>
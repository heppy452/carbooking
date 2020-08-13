<div class="container-fluid">
    <div id="formArea"></div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php if (!empty($panel)) {
                        echo $panel;
                    } ?>
                </div>
                <div class="card-body">
                    <?php
                    $level_user = $this->session->userdata('sess_level');
                    if ($level_user == 5) {
                    ?>
                        <div class="row">
                            <div class="input-group col-lg-3">
                                <select class="custom-select" id="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="1">Tidak Rutin</option>
                                    <option value="2">Rutin</option>
                                    <option value="3">Non Driver</option>
                                </select>
                                <div class="input-group-append">
                                    <button id="add_btn" class="btn btn-default"><i class="fa fa-plus-circle"></i> Tambah Tiket</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <table class="table table-bordered table-hover" id="tabel_custom">
                        <thead>
                            <tr>
                                <th>Nomor Tiket</th>
                                <th>Kategori</th>
                                <th>Tanggal Jadwal</th>
                                <th>Lokasi Keberangkatan</th>
                                <th>Lokasi Tujuan</th>
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
<div id="popup_menu" class="popup_box">
    <button class="btn btn-default btn-block" id="edit_btn"><i class="ion-edit"></i>&nbsp;&nbsp;Ubah</button>
    <button class="btn btn-default btn-block" id="delete_btn"><i class="ion-trash-a"></i>&nbsp;&nbsp;Hapus</button>
    <button class="btn btn-default btn-block" id="reset_btn"></i>&nbsp;&nbsp;Tampil</button>
</div>
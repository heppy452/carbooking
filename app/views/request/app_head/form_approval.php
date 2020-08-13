<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong>Form Edit Tiket</strong></div>
                <div class="card-body">
                    <div class="row">
                        <input type="text" value="<?= $tanggal ?>" id="tanggal" hidden>
                        <input type="text" value="<?= $departement ?>" id="departement" hidden>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><i class="fa fa-clock"></i> <strong>Data Jadwal </strong> <strong class="text-danger"><?= date("d-m-Y", strtotime($tanggal)) ?></strong></div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="detail">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nomor Tiket</th>
                                                <th style="text-align: center;">Nama Karyawan</th>
                                                <th style="text-align: center;">Keterangan</th>
                                                <th style="text-align: center;">Waktu Penjemputan</th>
                                                <th style="text-align: center;">Lokasi Keberangkatan</th>
                                                <th style="text-align: center;">Lokasi Tujuan</th>
                                                <th style="text-align: center;">Approval</th>
                                                <th style="text-align: center;">Keterangan Approval</th>
                                            </tr>
                                    </table>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="text-align: right;">
                    <button type="submit" class="btn btn-success" id="approve_btn">Simpan</button>
                    <button type="submit" class="btn btn-danger" id="tutup_btn">Batal</button>
                </div>
            </div>

        </div>
    </div>
</div>
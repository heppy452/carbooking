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
                                <div class="card-header"><i class="fa fa-city"></i> <strong>Departement </strong> <strong class="text-danger"><?= $this->m_proses->nama_departemen($departement) ?></strong></div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="detail">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nomor Tiket</th>
                                                <th style="text-align: center;" width="10px">Tanggal Jadwal</th>
                                                <th style="text-align: center;" width="10px">Lokasi Keberangkatan</th>
                                                <th style="text-align: center;">Lokasi Tujuan</th>
                                                <th style="text-align: center;">Approval</th>
                                                <th style="text-align: center;">Keterangan Approval</th>
                                                <th style="text-align: center;">Kendaraan</th>
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
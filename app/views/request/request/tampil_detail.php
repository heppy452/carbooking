<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong>Detail Tiket</strong></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header"><i class="fa fa-book"></i> <strong>Data Pemesanan </strong></div>
                                <div class="card-body">
                                    <table class="table">

                                        <?php if ($id->jns_pemesan == 1) { ?>
                                            <tr>
                                                <td class="tdstyle">Perusahaan</td>
                                                <td>:</td>
                                                <td><?= $this->m_request->nama_perusahaan($id->id_perusahaan) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdstyle">Departement</td>
                                                <td>:</td>
                                                <td><?= $this->m_request->nama_divisi($id->id_departement) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdstyle">Nomor Induk Karyawan</td>
                                                <td>:</td>
                                                <td><?= $id->nik_karyawan ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdstyle">Nama Lengkap</td>
                                                <td>:</td>
                                                <td><?= $this->m_request->nama_driver($id->nik_karyawan) ?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td class="tdstyle">Nama Tamu</td>
                                                <td>:</td>
                                                <td><?= $id->nama_lengkap ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="tdstyle">Nomor Telepon</td>
                                            <td>:</td>
                                            <td><?= $id->no_hp ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="nik" value="<?= $id->nik_karyawan ?>" name="">
                        <input type="hidden" id="tanggal" value="<?= $id->dari_tanggal ?>" name="">
                        <input type="hidden" id="nama" value="<?= $nama ?>" name="">
                        <input type="hidden" id="pemesan" value="<?= $pemesan ?>" name="">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header"><i class="fa fa-clock"></i> <strong>Data Jadwal </strong> <strong style="color : red"> <?= $tanggal ?> </strong></div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="tabel_view">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Nomor Tiket</th>
                                                <th style="text-align: center;">Tanggal Jadwal</th>
                                                <th style="text-align: center;">Lokasi Keberangkatan</th>
                                                <th style="text-align: center;">Lokasi Tujuan</th>
                                                <th style="text-align: center;">Kendaraan</th>
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
            <div class="card-footer" style="text-align: right;">
                <button type="submit" class="btn btn-danger" id="batal_btn">Tutup</button>
            </div>
        </div>
    </div>
</div>
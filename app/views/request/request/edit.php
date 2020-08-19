<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><i class="fa fa-money-bill"></i> <strong style="color: red;"> <?= $id->nomor_request ?></strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label class="control-label">Jenis Kebutuhan </label>
                            <select class="form-control" id="jenis_kebutuhan">
                                <option value="1" <?php if ($id->jenis_kebutuhan == 1) {
                                                        echo ' selected="selected"';
                                                    } ?>>Operasional Kantor</option>
                                <option value="2" <?php if ($id->jenis_kebutuhan == 2) {
                                                        echo ' selected="selected"';
                                                    } ?>>Kebutuhan Pribadi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="control-label">Jenis Lokasi </label>
                            <select class="form-control" id="jenis_lokasi">
                                <option value="1" <?php if ($id->jenis_lokasi == 1) {
                                                        echo ' selected="selected"';
                                                    } ?>>Internal</option>
                                <option value="2" <?php if ($id->jenis_lokasi == 2) {
                                                        echo ' selected="selected"';
                                                    } ?>>External</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Jenis Pemesan </label>
                            <select class="form-control" id="jenis_pemesan">
                                <option value="1" <?php if ($id->jns_pemesan == 1) {
                                                        echo ' selected="selected"';
                                                    } ?>>Karyawan</option>
                                <option value="2" <?php if ($id->jns_pemesan == 2) {
                                                        echo ' selected="selected"';
                                                    } ?>>Non Karyawan</option>
                            </select>
                        </div>
                    </div>
                    <?php
                    $jns_pemesan = $id->jns_pemesan;
                    if ($jns_pemesan == 1) {
                        $tampil = 'show';
                        $tampil1 = 'none';
                    } else {
                        $tampil = 'none';
                        $tampil1 = 'show';
                    }
                    ?>
                    <div class="col-lg-12">
                        <div id="karyawan" style="display: <?= $tampil ?>">
                            <div class="form-group">
                                <label class="control-label">Nomor Induk Karyawan</label>
                                <input type="text" class="form-control" required="true" value="<?= $id->nik_karyawan ?>" id="nik_input">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?= $this->m_request->nama_driver($id->nik_karyawan) ?>" required="true" readonly="" id="nama_lengkap">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Perusahaan</label>
                                <input type="text" class="form-control" value="<?= $this->m_request->nama_perusahaan($id->id_perusahaan) ?>" required="true" readonly="" id="company">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Departemen</label>
                                <input type="text" class="form-control" value="<?= $this->m_request->nama_divisi($id->id_departement) ?>" required="true" readonly="" id="divisi">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="visitor" style="display: <?= $tampil1 ?>">
                            <div class="form-group">
                                <label class="control-label">Nama Lengkap</label>
                                <input type="text" value="<?= $id->nama_lengkap ?>" class="form-control" required="true" id="nm_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Nomor Telepon </label>
                            <input class="form-control" type="text" value="<?= $id->no_hp ?>" id="nomor_hp">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Jumlah Penumpang </label>
                            <input class="form-control" type="number" value="<?= $id->jml_penumpang ?>" min="1" id="jml_penumpang">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><i class="fa fa-clock"></i> <strong>Data Jadwal </strong></div>
            <div class="card-body">
                <div class="row">
                    <?php if ($id->kategori == 3) {
                        if ($id->jns_booking == 1) { ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Jadwal </label>
                                    <div class="input-group">
                                        <input class="form-control date1" placeholder="Pilih Tanggal" type="text" id="tgl_jadwal" value="<?= date('d-m-Y', strtotime($id->dari_tanggal)) ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Dari </label>
                                    <div class="input-group">
                                        <input class="form-control time waktu" value="<?= $id->dari_jam ?>" type="text" id="dari_pukul">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Sampai </label>
                                    <div class="input-group">
                                        <input class="form-control time waktu" value="<?= $id->sampai_jam ?>" type="text" id="sampai_pukul">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-clock"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Dari Tanggal </label>
                                    <div class="input-group">
                                        <input class="form-control date1" placeholder="Pilih Tanggal" type="text" id="tgl_jadwal" value="<?= date('d-m-Y', strtotime($id->dari_tanggal)) ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Sampai Tanggal </label>
                                    <div class="input-group">
                                        <input class="form-control date1" placeholder="Pilih Tanggal" type="text" id="sampai_tanggal" value="<?= date('d-m-Y', strtotime($id->dari_tanggal)) ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Tanggal Jadwal </label>
                                <div class="input-group">
                                    <input class="form-control date1" placeholder="Pilih Tanggal" type="text" id="tgl_jadwal" value="<?= date('d-m-Y', strtotime($id->dari_tanggal)) ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Dari </label>
                                <div class="input-group">
                                    <input class="form-control time waktu" value="<?= $id->dari_jam ?>" type="text" id="dari_pukul">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Sampai </label>
                                <div class="input-group">
                                    <input class="form-control time waktu" value="<?= $id->sampai_jam ?>" type="text" id="sampai_pukul">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Lokasi Penjemputan </label>
                                <input class="form-control" type="text" value="<?= $id->lokasi_jemput ?>" id="lokasi_penjemputan">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Lokasi Keberangkatan</label>
                                <select class="form-control" id="lokasi_awal">
                                    <option value="">--- Pilih ---</option>
                                    <?php $this->m_request->select_lokasi($data = $id->lokasi_awal, $id->jenis_lokasi); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Lokasi Tujuan</label>
                                <select class="form-control" id="lokasi_tujuan">
                                    <option value="">--- Pilih ---</option>
                                    <?php $this->m_request->select_lokasi($data = $id->lokasi_tujuan, $id->jenis_lokasi); ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan"><?= $id->keterangan ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="id_request" value="<?= $id->id_request; ?>" name="">
<input type="hidden" id="kategori" value="<?= $id->kategori; ?>" name="">
<input type="hidden" id="jns_booking" value="<?= $id->jns_booking; ?>" name="">
<input type="hidden" value="<?= $kategori ?>" id="kategori">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><strong>Form Tambah Tiket</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-book"></i> <strong>Data Pemesanan </strong></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Kebutuhan </label>
                                            <select class="form-control" id="jenis_kebutuhan">
                                                <option value="1">Operasional Kantor</option>
                                                <option value="2">Kebutuhan Pribadi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Lokasi </label>
                                            <select class="form-control" id="jenis_lokasi">
                                                <option value="1">Internal</option>
                                                <option value="2">External</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Pemesan </label>
                                            <select class="form-control" id="jenis_pemesan">
                                                <option value="1">Karyawan</option>
                                                <option value="2">Non Karyawan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div id="karyawan">
                                            <div class="form-group ">
                                                <label class="control-label">Nomor Induk Karyawan</label>
                                                <input type="text" class="form-control " required="true" id="nik_input">
                                            </div>
                                            <div class="form-group" id="nam" style="display:none;">
                                                <label class="control-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" required="true" readonly="" id="nama_lengkap">
                                            </div>
                                            <div class="form-group" id="per" style="display:none;">
                                                <label class="control-label">Perusahaan</label>
                                                <input type="text" class="form-control" required="true" readonly="" id="company">
                                            </div>
                                            <div class="form-group" id="div" style="display:none;">
                                                <label class="control-label">Divisi</label>
                                                <input type="text" class="form-control" required="true" readonly="" id="divisi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div id="visitor" style="display: none">
                                            <div class="form-group">
                                                <label class="control-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" required="true" id="nm_lengkap">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label class="control-label">Nomor Telepon </label>
                                            <input class="form-control" type="text" id="nomor_hp">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="control-label">Jumlah Penumpang </label>
                                            <input class="form-control" type="number" value="1" min="1" id="jml_penumpang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                $kat = $kategori;
                                if ($kat == 3) {
                                ?>
                                    <div class="card">
                                        <div class="card-header"><i class="fa fa-clock"></i> <strong>Data Jadwal</strong></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="radio" class="jns_booking" name="jns_booking" value="1" checked=""> Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" class="jns_booking" name="jns_booking" value="2"> Tanggal
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row" id="by_jam">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tanggal Jadwal </label>
                                                        <div class="input-group">
                                                            <input class="form-control date" placeholder="Pilih Tanggal" type="text" id="tgl_jadwal_bkg">
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
                                                            <input class="form-control time waktu" type="text" value="08:00" id="dari_pukul_bkg">
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
                                                            <input class="form-control time waktu" type="text" value="08:00" id="sampai_pukul_bkg">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">
                                                                    <i class="fa fa-clock"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan_jam"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="by_tanggal" style="display: none">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Dari Tanggal </label>
                                                        <div class="input-group">
                                                            <input class="form-control date" placeholder="Pilih Tanggal" type="text" id="dari_tgl_bkg">
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
                                                        <label class="control-label">Sampai </label>
                                                        <div class="input-group">
                                                            <input class="form-control date" placeholder="Pilih Tanggal" type="text" id="sampai_tgl_bkg">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan_tanggal"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="card">
                                        <div class="card-header"><i class="fa fa-clock"></i> <strong>Data Jadwal</strong></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="radio" class="jns_layanan" name="jns_layanan" value="1" checked=""> Sekali Jalan / Pulang Pergi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" class="jns_layanan" name="jns_layanan" value="2"> Multi-Tujuan
                                                    </div>
                                                    <hr>
                                                </div>
                                                <?php if ($kat == 1) { ?>
                                                    <!-- Kategori Nonrutin -->
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tanggal Jadwal </label>
                                                            <div class="input-group">
                                                                <input class="form-control date" placeholder="Pilih Tanggal" type="text" id="tgl_jadwal">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Dari </label>
                                                            <div class="input-group">
                                                                <input class="form-control time waktu" type="text" value="08:00" id="dari_pukul">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">
                                                                        <i class="fa fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Sampai </label>
                                                            <div class="input-group">
                                                                <input class="form-control time waktu" type="text" value="08:00" id="sampai_pukul">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">
                                                                        <i class="fa fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label class="control-label">Lokasi Penjemputan </label>
                                                            <input class="form-control" type="text" id="lokasi_penjemputan">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Lokasi Keberangkatan</label>
                                                            <select class="form-control" id="lokasi_awal">
                                                                <option value="">--- Pilih ---</option>
                                                                <?php $this->m_request->select_lokasi($data = NULL); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Lokasi Tujuan</label>
                                                            <select class="form-control" id="lokasi_tujuan">
                                                                <option value="">--- Pilih ---</option>
                                                                <?php $this->m_request->select_lokasi($data = NULL); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label class="control-label">Keterangan</label>
                                                            <textarea class="form-control" id="keterangan"></textarea>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div id="multitujuan">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="sekali_jalan">
                                                        <div class="form-group">
                                                            <label class="control-label">&nbsp;</label><br>
                                                            <input type="checkbox" class="pulang" name="pulang" value="1"><b> Pulang Pergi</b>
                                                        </div>
                                                    </div>
                                                    <div id="multi_tujuan" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="control-label">&nbsp;</label>
                                                            <div class="input-group-append">
                                                                <button id="add_tujuan" class="btn btn-default"><i class="fa fa-map-marker-alt"></i> Tambah Tujuan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="pulang_pergi" style="display: none">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Tanggal Pulang </label>
                                                        <div class="input-group">
                                                            <input class="form-control date" placeholder="Pilih Tanggal" type="text" id="tgl_jadwal_plg">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Dari Pukul </label>
                                                        <div class="input-group">
                                                            <input class="form-control time waktu" type="text" value="08:00" id="dari_pukul_plg">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">
                                                                    <i class="fa fa-clock"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Sampai </label>
                                                        <div class="input-group">
                                                            <input class="form-control time waktu" type="text" value="08:00" id="sampai_pukul_plg">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">
                                                                    <i class="fa fa-clock"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label class="control-label">Lokasi Penjemputan Pulang</label>
                                                        <input class="form-control" type="text" id="lokasi_penjemputan_plg">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Kategori rutin -->
                                        <?php } else { ?>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal </label>
                                                    <div class="input-group">
                                                        <input class="form-control date" placeholder="Pilih Tanggal" type="text" id="tanggal">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label class="control-label">Dari </label>
                                                    <div class="input-group">
                                                        <input class="form-control time waktu" type="text" value="08:00" id="dari_pukul">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">
                                                                <i class="fa fa-clock"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label class="control-label">Sampai </label>
                                                    <div class="input-group">
                                                        <input class="form-control time waktu" type="text" value="08:00" id="sampai_pukul">
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
                                                    <input class="form-control" type="text" id="lokasi_penjemputan">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="control-label">Lokasi Keberangkatan</label>
                                                    <select class="form-control" id="lokasi_awal">
                                                        <option value="">--- Pilih ---</option>
                                                        <?php $this->m_request->select_lokasi($data = NULL); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="control-label">Lokasi Tujuan</label>
                                                    <select class="form-control" id="lokasi_tujuan">
                                                        <option value="">--- Pilih ---</option>
                                                        <?php $this->m_request->select_lokasi($data = NULL); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="control-label">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="multitujuan">
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="sekali_jalan">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label><br>
                                                    <input type="checkbox" class="pulang" name="pulang" value="1"><b> Pulang Pergi</b>
                                                </div>
                                            </div>
                                            <div id="multi_tujuan" style="display: none;">
                                                <div class="form-group">
                                                    <label class="control-label">&nbsp;</label>
                                                    <div class="input-group-append">
                                                        <button id="add_tujuan" class="btn btn-default"><i class="fa fa-map-marker-alt"></i> Tambah Tujuan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="pulang_pergi" style="display: none">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Dari Pukul </label>
                                                            <div class="input-group">
                                                                <input class="form-control time waktu" type="text" value="08:00" id="dari_pukul_plg">
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
                                                                <input class="form-control time waktu" type="text" value="08:00" id="sampai_pukul_plg">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">
                                                                        <i class="fa fa-clock"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Lokasi Penjemputan </label>
                                                            <input class="form-control" type="text" id="lokasi_penjemputan_plg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer" style="text-align: right;">
        <button type="submit" class="btn btn-success" id="save_add_btn"><i class="fa fa-spinner fa-spin" style="display:none" id="show_spinner"></i>Simpan</button>
        <button type="submit" class="btn btn-danger" id="batal_btn">Batal</button>
    </div>
</div>
</div>
</div>
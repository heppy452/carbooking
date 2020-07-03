<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><i class="fa fa-book"></i> <strong>Data Permintaan </strong></div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td class="tdstyle" width="160">Nomor Tiket</td>
                        <td width="5">:</td>
                        <td><?=$id->nomor_request?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Jenis Kebutuhan</td>
                        <td>:</td>
                        <td><?=$this->l_proses->jenis_kebutuhan($id->jenis_kebutuhan)?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Jenis Lokasi</td>
                        <td>:</td>
                        <td><?=$this->l_proses->jenis_lokasi($id->jenis_lokasi)?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Tanggal Penjemputan</td>
                        <td>:</td>
                        <td><?=$id->tgl_jadwal?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Perusahaan</td>
                        <td>:</td>
                        <td><?=$this->m_proses->nama_perusahaan($id->id_perusahaan)?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Departement</td>
                        <td>:</td>
                        <td><?=$this->m_proses->nama_divisi($id->id_departement)?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Jam Penjemputan</td>
                        <td>:</td>
                        <td><?=$id->jam_jemput?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Nama Pemesan</td>
                        <td>:</td>
                        <td><?=$id->nama_pemesan?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Nomor Handphone</td>
                        <td>:</td>
                        <td><?=$id->no_hp?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Jumlah Penumpang</td>
                        <td>:</td>
                        <td><?=$id->jml_penumpang?> Orang</td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Lokasi Penjemputan</td>
                        <td>:</td>
                        <td><?=$id->lokasi_jemput?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle">Lokasi Awal</td>
                        <td>:</td>
                        <td><?=$this->m_proses->lokasi($id->lokasi_awal)?></td>
                    </tr>
                    <?php if ($id->jam_berangkat!='00:00:00'){ ?>
                    <tr>
                        <td class="tdstyle">Jam Berangkat</td>
                        <td>:</td>
                        <td><?=$id->jam_berangkat?></td>
                    </tr>
                    <?php } if ($id->jam_tiba!='00:00:00'){ ?>
                    <tr>
                        <td class="tdstyle">Jam Tiba</td>
                        <td>:</td>
                        <td><?=$id->jam_tiba?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td class="tdstyle">Lokasi Tujuan</td>
                        <td>:</td>
                        <td><?=$this->m_proses->lokasi($id->lokasi_tujuan)?></td>
                    </tr>
                    <tr>
                        <td class="tdstyle" style="vertical-align: top;">Keterangan</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;"><?=$id->keterangan?></td>
                    </tr>
                     <tr>
                        <td class="tdstyle">Status</td>
                        <td><center>:</center></td>
                        <td><?=$this->l_proses->status($id->status_request)?></td>
                    </tr>
                    <?php if ($id->status_request==4) { ?>
                    <tr>
                        <td class="tdstyle" style="vertical-align: top;">Keterangan</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;"><?=$id->ket_cancel?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><i class="fa fa-car"></i> <strong>Informasi Sopir </strong></div>
            <div class="card-body">
                <?php 
                    $id_driver= $id->id_driver;
                    $id_kendaraan= $id->id_kendaraan;
                    if ($id_kendaraan!=0 OR $id_driver!=0){
                ?>
                <table class="table">
                    <tr>
                        <td><?php $type=$this->m_proses->jenis_mobil($id->id_kendaraan); echo $this->l_proses->jenis_mobil($type);?> &nbsp; <b><?=$this->m_proses->plat($id->id_kendaraan)?></b></td>
                    </tr>
                    <tr>
                        <td><?php $nik=$this->m_proses->nik_driver($id->id_driver); echo $this->m_proses->nama_driver($nik);?></td>
                    </tr>
                    <tr>
                        <td><?=$this->m_proses->no_hp($id->id_driver)?></td>
                    </tr>
                </table>
            <?php } ?>
            </div>
        </div><br>
        <?php if ($id->jenis_kebutuhan==1){ ?>
        <div class="card">
            <div class="card-header"><i class="fa fa-check"></i> <strong>Approval Head Departement </strong></div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td><?=$this->l_proses->approve($id->apr_spv)?></td>
                    </tr>
                    <tr>
                        <td><?=$id->apr_spv_tgl?></td>
                    </tr>
                    <tr>
                        <td><?=$id->apr_spv_ket?></td>
                    </tr>
                </table>
            </div>
        </div><br>
        <?php } ?>
        <div class="card">
            <div class="card-header"><i class="fa fa-check"></i> <strong>Approval Administrator GA </strong></div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td><?=$this->l_proses->approve($id->apr_ga)?></td>
                    </tr>
                    <tr>
                        <td><?php if ($id->apr_ga_tgl==0000-00-00){ echo '';} else { echo $id->apr_ga_tgl; }?></td>
                    </tr>
                    <tr>
                        <td><?=$id->apr_ga_ket?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
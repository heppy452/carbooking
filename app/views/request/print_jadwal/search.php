<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <table width="700">
                <tr>
                    <td width="150px">NAMA SOPIR</td><td width="20px">&nbsp;:&nbsp;</td><td width="500px"><?php $nik=$this->m_print_jadwal->nik_driver($driver); echo $this->m_print_jadwal->nama_driver($nik)?></td>
                    <td rowspan="2" width="150px" style="text-align: right;"><a href="<?=site_url("request/print_jadwal/print/$driver/$tgl")?>" target="_blank"><div class="btn btn-danger"><i class="fa fa-print"> Cetak</i></div></a></td>
                </tr>
                <tr>
                    <td>TANGGAL JADWAL</td><td>&nbsp;:&nbsp;</td><td><?php echo $tgl?></td>
                </tr>
            </table>
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nomor Tiket</th>
                        <th>Jam Penjemputan</th>
                        <th>Departement</th>
                        <th>Lokasi Keberangkatan</th>
                        <th>Lokasi Tujuan</th>
                        <th>Penumpang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($id->result() as $key) {
                        ?>
                    <tr>
                        <td><?=$key->nomor_request?></td>
                        <td><?=$key->jam_jemput?></td>
                        <td><?=$this->m_print_jadwal->nama_divisi($key->id_departement)?></td>
                        <td><?=$this->m_print_jadwal->lokasi($key->lokasi_awal)?></td>
                        <td><?=$this->m_print_jadwal->lokasi($key->lokasi_tujuan)?></td>
                        <td><?=$key->jml_penumpang?> Orang</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
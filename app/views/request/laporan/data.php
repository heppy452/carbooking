<div class="row">
   <div class="col-md-12"> 
        <table class="table table-bordered table-hover" id="tabel_custom">
            <thead>
                <tr>
                    <th>Nomor Tiket</th>
                    <th>Perusahaan</th>
                    <th>Departement</th>
                    <th>Jenis Kebutuhan</th>
                    <th>Pemesan</th>
                    <th>Lokasi Awal</th>
                    <th>Lokasi Tujuan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($id->result() as $key) {
                ?>
                <tr>
                    <td><?=$key->nomor_request;?></td>
                    <td><?=$this->m_laporan->nama_perusahaan($key->id_departement)?></td>
                    <td><?=$this->m_laporan->nama_divisi($key->id_departement)?></td>
                    <td><?=$this->l_laporan->jenis_kebutuhan($key->jenis_kebutuhan)?></td>
                    <td><?=$key->nama_pemesan?> Orang</td>
                    <td><?=$this->m_laporan->lokasi($key->lokasi_awal)?></td>
                    <td><?=$this->m_laporan->lokasi($key->lokasi_tujuan)?></td>
                    <td><?=$key->keterangan?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
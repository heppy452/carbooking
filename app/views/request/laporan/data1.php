<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover" id="tabel_custom">
            <thead>
                <tr>
                    <th>Nomor Tiket</th>
                    <th>Nomor Kendaraan</th>
                    <th>Perusahaan</th>
                    <th>Departement</th>
                    <th>Jenis Kebutuhan</th>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($id->result() as $key) {
                    if ($key->sampai_tanggal=='0000-00-00'){
                        $sampai_tanggal ='-';
                    } else{
                        $sampai_tanggal = date('d-m-Y',strtotime($key->sampai_tanggal));
                    }
                ?>
                    <tr>
                        <td><?= $key->nomor_request ?></td>
                        <td><?= $this->m_laporan->plat($key->id_kendaraan) ?></td>
                        <td><?= $this->m_laporan->nama_perusahaan($key->id_perusahaan) ?></td>
                        <td><?= $this->m_laporan->nama_divisi($key->id_departement) ?></td>
                        <td><?= $this->l_laporan->jenis_kebutuhan($key->jenis_kebutuhan) ?></td>
                        <td><?=date('d-m-Y',strtotime($key->dari_tanggal))?></td>
                        <td><?=$sampai_tanggal?></td>
                        <td><?= $key->keterangan ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
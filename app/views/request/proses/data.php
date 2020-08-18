<table class="table table-bordered table-hover" id="tabel_pencarian_proses">
    <thead>
        <tr>
            <th>Nomor Tiket</th>
            <th>Tanggal Jadwal</th>
            <th>Jenis Kebutuhan</th>
            <th>Lokasi Keberangkatan</th>
            <th>Lokasi Tujuan</th>
            <th>Perusahaan</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($id->result() as $key) {
        ?>
            <tr>
                <td><?= $key->nomor_request ?></td>
                <td><?= $key->dari_tanggal . ' ' . $key->dari_jam ?></td>
                <td><?= $this->l_proses->kategori($key->kategori) ?></td>
                <td><?= $this->m_proses->lokasi($key->lokasi_awal) ?></td>
                <td><?= $this->m_proses->lokasi($key->lokasi_tujuan) ?></td>
                <td><?= $this->m_proses->lokasi($key->lokasi_awal) ?></td>
                <td><?= $this->l_proses->status($key->status_request) ?></td>
                <td><?= '<a href="" title="Detail"><i id="detail_btn" data-id="' . $key->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> 
                &nbsp; <a href="" title="Pilih Sopir"><i id="sopir_btn" data-id="' . $key->id_request . '" class="fa fa-user" style="font-size:15px; color:#0b7d32;"></i></a>
                &nbsp; <a href="" title="Edit"><i id="edit_btn" data-id="' . $key->id_request . '" class="fa fa-edit" style="font-size:15px; color:#0b7d32;"></i></a>
                &nbsp; <a href="' . site_url("request/print_jadwal/printa/$key->id_driver/$key->dari_tanggal") . '" title="Edit"><i class="fa fa-print" style="font-size:15px; color:#0b7d32;"></i></a>' ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
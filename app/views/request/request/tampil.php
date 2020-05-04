<table>
    <tr>
        <td class="tdstyle">Nomor Pemesanan</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->nomor_request?></td>
    </tr>
    <tr>
        <td class="tdstyle">Jenis Kebutuhan</td>
        <td width="20"><center>:</center></td>
        <td><?=$this->l_request->jenis_kebutuhan($id->jenis_kebutuhan)?></td>
    </tr>
    <tr>
        <td class="tdstyle">Jenis Lokasi</td>
        <td width="20"><center>:</center></td>
        <td><?=$this->l_request->jenis_lokasi($id->jenis_lokasi)?></td>
    </tr>
    <tr>
        <td class="tdstyle">Tanggal Jadwal</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->tgl_jadwal?></td>
    </tr>
    <tr>
        <td class="tdstyle">Jam Penjemputan</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->jam_jemput?></td>
    </tr>
    <tr>
        <td class="tdstyle">Nama Pemesan</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->nama_pemesan?></td>
    </tr>
    <tr>
        <td class="tdstyle">Nomor Handphone</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->no_hp?></td>
    </tr>
    <tr>
        <td class="tdstyle">Jumlah Penumpang</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->jml_penumpang?> Orang</td>
    </tr>
    <tr>
        <td class="tdstyle">Lokasi Penjemputan</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->lokasi_jemput?></td>
    </tr>
    <tr>
        <td class="tdstyle">Lokasi Awal</td>
        <td width="20"><center>:</center></td>
        <td><?=$this->m_request->lokasi($id->lokasi_awal)?></td>
    </tr>
    <tr>
        <td class="tdstyle">Lokasi Tujuan</td>
        <td width="20"><center>:</center></td>
        <td><?=$this->m_request->lokasi($id->lokasi_tujuan)?></td>
    </tr>
    <tr>
        <td class="tdstyle">Keterangan</td>
        <td width="20"><center>:</center></td>
        <td><?=$id->keterangan?></td>
    </tr>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Carpool</title>
</head>
<body>
<div class="container">
<div class="row d-flex justify-content-center">
<div class="mt-5 mr-5 ml-5">
<img width="800" src="https://apps.imip.co.id/img_carpool/banneremail.png" alt="">
            <h3 class="populer text-center mt-5 color">Haloo Admin GA,</h3>
            <p>Harap cek aplikasi e-carpool, ada masuk pemesanan mobil dari perusahaan <?=$this->m_request->nama_perusahaan($id->id_departement)?> Departemen <?=$this->m_request->nama_divisi($id->id_departement)?>. Berikut detail pemesanan mobil :</p>
            <tr>
                <td class="tdstyle" width="160">Nomor Tiket</td>
                <td width="5">:</td>
                <td><?=$id->nomor_request?></td>
            </tr>
            <tr>
                <td class="tdstyle">Jenis Kebutuhan</td>
                <td>:</td>
                <td><?=$this->l_request->jenis_kebutuhan($id->jenis_kebutuhan)?></td>
            </tr>
            <tr>
                <td class="tdstyle">Jenis Lokasi</td>
                <td>:</td>
                <td><?=$this->l_request->jenis_lokasi($id->jenis_lokasi)?></td>
            </tr>
            <tr>
                <td class="tdstyle">Tanggal Penjemputan</td>
                <td>:</td>
                <td><?=$id->tgl_jadwal?></td>
            </tr>
            <tr>
                <td class="tdstyle">Perusahaan</td>
                <td>:</td>
                <td><?=$this->m_request->nama_perusahaan($id->id_departement)?></td>
            </tr>
            <tr>
                <td class="tdstyle">Departement</td>
                <td>:</td>
                <td><?=$this->m_request->nama_divisi($id->id_departement)?></td>
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
                <td><?=$this->m_request->lokasi($id->lokasi_awal)?></td>
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
                <td><?=$this->m_request->lokasi($id->lokasi_tujuan)?></td>
            </tr>
            <tr>
                <td class="tdstyle" style="vertical-align: top;">Keterangan</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;"><?=$id->keterangan?></td>
            </tr>
    </div>
    <p>Terima kasih.</p>
    <p style="color : #CACACA; margin-top : 10px;">Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
</div>
</div>
</body>
</html>
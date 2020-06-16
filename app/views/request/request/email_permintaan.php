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
            <h3 class="populer text-center mt-5 color">Haloo <?=$nama_pemesan?>,</h3>
            <p>Harap cek aplikasi e-carpool, ada masuk request peminjaman mobil ke departemen GA. Berikut detail pemesanan mobil :</p>
            <tr>
                <td class="tdstyle" width="160">Nomor Tiket</td>
                <td width="5">:</td>
                <td><?=$nomor_request?></td>
            </tr>
            <tr>
                <td class="tdstyle">Jenis Kebutuhan</td>
                <td>:</td>
                <td><?=$this->l_request->jenis_kebutuhan($jenis_kebutuhan)?></td>
            </tr>
            <tr>
                <td class="tdstyle">Tanggal Penjemputan</td>
                <td>:</td>
                <td><?=$tgl_jadwal?></td>
            </tr>
            <tr>
                <td class="tdstyle">Jam Penjemputan</td>
                <td>:</td>
                <td><?=$jam_jemput?></td>
            </tr>
            <tr>
                <td class="tdstyle" style="vertical-align: top;">Keterangan</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;"><?=$keterangan?></td>
            </tr>
    </div>
    <p>Terima kasih.</p>
    <p style="color : #CACACA; margin-top : 10px;">Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
</div>
</div>
</body>
</html>
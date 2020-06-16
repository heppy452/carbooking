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
            <h3 class="populer text-center mt-5 color">Haloo <?=$id->nama_pemesan?>,</h3>
            <p>Pemesanan mobil anda sudah di approve GA IMIP. Berikut informasi Sopir :</p>
            <tr>
                <td class="tdstyle" width="160">Nomor Tiket</td>
                <td width="5">:</td>
                <td><?=$id->nomor_request?></td>
            </tr>
                <?php 
                    $id_driver= $id->id_driver;
                    $id_kendaraan= $id->id_kendaraan;
                    if ($id_kendaraan!=0 OR $id_driver!=0){
                ?>
                 <tr>
                    <td class="tdstyle" width="160">Nama Kendaraan</td>
                    <td width="5">:</td>
                    <td><?php $type=$this->m_request->jenis_mobil($id->id_kendaraan); echo $this->l_request->jenis_mobil($type);?></td>
                 </tr>
                 <tr>
                    <td class="tdstyle" width="160">Plat Kendaraan</td>
                    <td width="5">:</td>
                    <td><b><?=$this->m_request->plat($id->id_kendaraan)?></b></td>
                </tr>
                <tr>
                    <td class="tdstyle" width="160">Nama Sopir</td>
                    <td width="5">:</td>
                    <td><?php $nik=$this->m_request->nik_driver($id->id_driver); echo $this->m_request->nama_driver($nik);?></td>
                 </tr>
                 <tr>
                    <td class="tdstyle" width="160">No.hp Sopir</td>
                    <td width="5">:</td>
                    <td><?=$this->m_request->no_hp($id->id_driver)?></td>
                 </tr>
            <?php } ?>
    </div>
    <p>Terima kasih.</p>
    <p style="color : #CACACA; margin-top : 10px;">Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</p>
</div>
</div>
</body>
</html>
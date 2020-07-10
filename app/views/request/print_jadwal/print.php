
<!DOCTYPE html>
<html>
    <head>
        <title>Car Booking</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet"  media="screen" href="<?=base_url('lib/bootstrap/css/bootstrap.min.css');?>">
        <link rel="stylesheet"  type="text/css" href="<?=base_url('lib/bootstrap/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('lib/fontawesome/fontawesome.min.css');?>">
        <link rel="stylesheet"  href="<?=base_url('lib/sidenav/sidenav.min.css');?>">
    </head>

    <body style="padding: 30px 10px 0px 20px">
        <div class="row">
            <table style="font-size: 13px; font-weight: bold;">
                <tr>
                    <td style="text-align: left" colspan="2"><img src="<?=base_url();?>img/imip_small.png" style="width: 60%"></td>
                
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                     <td width="150px">&nbsp;NAMA SOPIR</td>
                     <td>&nbsp;:&nbsp;<?php $nik=$this->m_print_jadwal->nik_driver($driver); echo $this->m_print_jadwal->nama_driver($nik)?></td>
                </tr>
                <tr>
                    <td>&nbsp;TANGGAL JADWAL</td>
                    <td>&nbsp;:&nbsp;<?php echo $tgl?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </table>

            <table class="table table-bordered" style="font-size: 12px;">
                <tr>
                    <td style="font-weight: bold;">Nomor Tiket</td>
                    <td style="font-weight: bold;">Perusahaan</td>
                    <td style="font-weight: bold;">Departement</td>
                    <td style="font-weight: bold;">Jam Penjemputan</td>
                    <td style="font-weight: bold;">Lokasi Penjemputan</td>
                    <td style="font-weight: bold;">Nama Pemesan</td>
                    <td style="font-weight: bold;">Penumpang</td>
                    <td style="font-weight: bold;">Handphone</td>
                    <td style="font-weight: bold;">Lokasi Keberangkatan</td>
                    <td style="font-weight: bold;">Lokasi Tujuan</td>
                    <td style="font-weight: bold;">Plat Kendaraan</td>
                </tr>
                <?php foreach ($id->result() as $key) { ?>
                <tr>
                    <td><?=$key->nomor_request?></td>
                    <td><?=$this->m_print_jadwal->nama_perusahaan($key->id_perusahaan)?></td>
                    <td><?=$this->m_print_jadwal->nama_divisi($key->id_departement)?></td>
                    <td><?=$key->jam_jemput?></td>
                    <td><?=$key->lokasi_jemput?></td>
                    <td><?=$key->nama_pemesan?></td>
                    <td><?=$key->jml_penumpang?> Orang</td>
                    <td><?=$key->no_hp?></td>
                    <td><?=$this->m_print_jadwal->lokasi($key->lokasi_awal)?></td>
                    <td><?=$this->m_print_jadwal->lokasi($key->lokasi_tujuan)?></td>
                    <td><?=$this->m_print_jadwal->plat($key->id_kendaraan).'('.$this->m_print_jadwal->no_internal($key->id_kendaraan).')'?></td>
                </tr>
                <?php } ?>
            </table>
            <script type="text/javascript">
                window.print();
            </script>
        </div>
    </body>
</html>
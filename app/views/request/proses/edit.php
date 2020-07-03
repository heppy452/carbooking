<div class="form-group">
    <label class="control-label">Jenis Kebutuhan </label>
    <select class="form-control" id="jenis_kebutuhan">
        <option value="1" <?php if($id->jenis_kebutuhan == 1){echo ' selected="selected"';}?>>Operasional Kantor</option>
        <option value="2" <?php if($id->jenis_kebutuhan == 2){echo ' selected="selected"';}?>>Kebutuhan Pribadi</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Jenis Lokasi </label>
    <select class="form-control" id="jenis_lokasi">
        <option value="1" <?php if($id->jenis_lokasi == 1){echo ' selected="selected"';}?>>Internal</option>
        <option value="2" <?php if($id->jenis_lokasi == 2){echo ' selected="selected"';}?>>External</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Perusahaan </label>
    <select class="form-control" id="id_perusahaan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_proses->select_perusahaan($data=$id->id_perusahaan); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Departement </label>
    <select class="form-control" id="id_departement">
        <option value="">--- Pilih ---</option>
        <?php $this->m_proses->select_departement($data=$id->id_departement); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Tanggal Jadwal </label>
    <input class="form-control date" placeholder="Select Date" type="text" id="tgl_jadwal" value="<?=$id->tgl_jadwal?>">
</div>
<div class="form-group">
    <label class="control-label">Jam Penjemputan </label>
    <input class="form-control time" type="text" id="jam_penjemputan" value="<?=$id->jam_jemput?>">
</div>
<div class="form-group">
    <label class="control-label">Nama Pemesan </label>
    <input class="form-control" type="text" id="nama_pemesan" value="<?=$id->nama_pemesan?>">
</div>
<div class="form-group">
    <label class="control-label">Nomor Handphone </label>
    <input class="form-control" type="text" id="nomor_hp" value="<?=$id->no_hp?>">
</div>
<div class="form-group">
    <label class="control-label">Jumlah Penumpang </label>
    <input class="form-control" type="number" min="1" id="jml_penumpang" value="<?=$id->jml_penumpang?>">
</div>
<div class="form-group">
    <label class="control-label">Lokasi Penjemputan </label>
    <input class="form-control" type="text" id="lokasi_penjemputan" value="<?=$id->lokasi_jemput?>">
</div>
<div class="form-group">
    <label class="control-label">Lokasi Keberangkatan</label>
    <select class="form-control" id="lokasi_awal">
        <option value="">--- Pilih ---</option>
        <?php $this->m_proses->select_lokasi($data=$id->lokasi_awal); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Lokasi Tujuan</label>
    <select class="form-control" id="lokasi_tujuan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_proses->select_lokasi($data=$id->lokasi_tujuan); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Keterangan</label>
    <textarea class="form-control" id="keterangan"><?=$id->keterangan?></textarea>
</div>
<input type="hidden" id="id_request" value="<?=$id->id_request?>">
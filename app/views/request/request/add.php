<div class="form-group">
    <label class="control-label">Jenis Lokasi </label>
    <select class="form-control" id="jenis_lokasi">
        <option value="1">Internal</option>
        <option value="2">External</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Tanggal Jadwal </label>
    <input class="form-control date" placeholder="Select Date" type="text" id="tgl_jadwal">
</div>
<div class="form-group">
    <label class="control-label">Jam Penjemputan </label>
    <input class="form-control time" type="text" value="08:30" id="jam_penjemputan">
</div>
<div class="form-group">
    <label class="control-label">Nama Pemesan </label>
    <input class="form-control" type="text" id="nama_pemesan">
</div>
<div class="form-group">
    <label class="control-label">Nomor Handphone </label>
    <input class="form-control" type="text" id="nomor_hp">
</div>
<div class="form-group">
    <label class="control-label">Jumlah Penumpang </label>
    <input class="form-control" type="number" value="1" min="1" id="jml_penumpang">
</div>
<div class="form-group">
    <label class="control-label">Lokasi Penjemputan </label>
    <input class="form-control" type="text" id="lokasi_penjemputan">
</div>
<div class="form-group">
    <label class="control-label">Lokasi Awal</label>
    <select class="form-control" id="lokasi_awal">
        <option value="">--- Pilih ---</option>
        <?php $this->m_request->select_lokasi($data=NULL); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Lokasi Tujuan</label>
    <select class="form-control" id="lokasi_tujuan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_request->select_lokasi($data=NULL); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Keterangan</label>
    <textarea class="form-control" id="keterangan"></textarea>
</div>
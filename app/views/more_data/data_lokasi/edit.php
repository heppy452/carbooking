<div class="form-group">
    <label class="control-label">Nama Lokasi</label>
    <input class="form-control" type="text" id="nama_lokasi" value="<?= $id->nama_lokasi ?>">
</div>
<div class="form-group">
    <label class="control-label">Kategori Lokasi</label>
    <select class="form-control" id="kategori_lokasi">
        <option value="">--- Pilih Kategori ---</option>
        <option value="1" <?php if ($id->kategori_lokasi == 1) {
                                echo ' selected="selected"';
                            } ?>>Internal</option>
        <option value="2" <?php if ($id->kategori_lokasi == 2) {
                                echo ' selected="selected"';
                            } ?>>External</option>
    </select>
</div>
<input type="hidden" id="id_lokasi" value="<?= $id->id_lokasi ?>" name="">
<input type="hidden" id="nama_lokasi_old" value="<?= $id->nama_lokasi ?>" name="">
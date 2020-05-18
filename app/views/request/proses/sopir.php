<div class="form-group">
    <label class="control-label">Nama Sopir</label>
    <select class="form-control" id="id_driver">
        <option value="">--- Pilih ---</option>
        <?php $this->m_proses->select_driver($id->id_driver); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Plat Kendaraan</label>
    <select class="form-control" id="id_kendaraan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_proses->select_kendaraan($id->id_kendaraan); ?>
    </select>
</div>
<input type="hidden" id="id_request" value="<?=$id->id_request?>">
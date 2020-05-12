<div class="form-group">
    <label class="control-label">Nama Sopir</label>
    <select class="form-control" id="id_driver">
        <option value="">--- Pilih ---</option>
        <?php $this->m_request->select_driver($data=NULL); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Plat Kendaraan</label>
    <select class="form-control" id="id_kendaraan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_request->select_kendaraan($data=NULL); ?>
    </select>
</div>
<input type="hidden" id="id_request" value="<?=$id?>">
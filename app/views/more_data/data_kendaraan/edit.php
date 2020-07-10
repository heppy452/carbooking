<div class="form-group">
    <label class="control-label">Nomor Plat Kendaraan</label>
    <input class="form-control" type="text" id="nomor" value="<?=$id->nomor_plat?>">
</div>
<div class="form-group">
    <label class="control-label">Nomor Internal</label>
    <input class="form-control" type="text" id="no_internal" value="<?=$id->no_internal?>">
</div>
<div class="form-group">
    <label class="control-label">Type Kendaraan </label>
    <select class="form-control" id="type">
    	<option value="">--- Pilih ---</option>
    	<option value="1" <?php if ($id->type_kendaraan==1) { echo 'selected'; } ?>>Avanza</option>
    	<option value="2" <?php if ($id->type_kendaraan==2) { echo 'selected'; } ?>>Xenia</option>
    	<option value="3" <?php if ($id->type_kendaraan==3) { echo 'selected'; } ?>>Hilux</option>
    	<option value="4" <?php if ($id->type_kendaraan==4) { echo 'selected'; } ?>>Panther</option>
        <option value="5" <?php if ($id->type_kendaraan==5) { echo 'selected'; } ?>>Innova</option>
        <option value="6" <?php if ($id->type_kendaraan==6) { echo 'selected'; } ?>>Hino</option>
        <option value="7" <?php if ($id->type_kendaraan==7) { echo 'selected'; } ?>>Izusu</option>
    </select>
</div>
<input type="hidden" id="id_kendaraan" value="<?=$id->id_kendaraan;?>">
<input type="hidden" id="nomor_lama" value="<?=$id->nomor_plat;?>">
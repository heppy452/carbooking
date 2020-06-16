<div class="form-group">
    <label class="control-label">Nama Lengkap </label>
    <input class="form-control" type="text" id="fullname" value="<?=$id->fullname;?>">
</div>
<div class="form-group">
    <label class="control-label">Perusahaan </label>
    <select class="form-control" id="id_perusahaan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_data_user->select_perusahaan($id->id_perusahaan); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Departement </label>
    <select class="form-control" id="id_departement">
        <option value="">--- Pilih ---</option>
        <?php $this->m_data_user->select_departement($id->id_departemen); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Username </label>
    <input class="form-control" type="text" id="username" value="<?=$id->username;?>">
</div>
<div class="form-group">
    <label class="control-label">Email </label>
    <input class="form-control" type="text" id="email" value="<?=$id->email;?>">
</div>
<div class="form-group">
    <label class="control-label">Level </label>
    <select class="form-control" id="level">
        <option value="5" <?php if($id->level == 5){echo ' selected="selected"';}?>>Admin</option>
        <option value="4" <?php if($id->level == 4){echo ' selected="selected"';}?>>Supervisor</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Status</label>
    <select class="form-control" id="status">
        <option value="1" <?php if($id->status == 1){echo ' selected="selected"';}?>>Aktif</option>
        <option value="2" <?php if($id->status == 2){echo ' selected="selected"';}?>>Nonaktif</option>
    </select>
</div>
<input type="hidden" id="id_user" value="<?=$id->id_user;?>">
<input type="hidden" id="username_old" value="<?=$id->username;?>">
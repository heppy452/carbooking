<div class="form-group">
    <label class="control-label">Nama Lengkap </label>
    <input class="form-control" type="text" id="fullname">
</div>
<div class="form-group">
    <label class="control-label">Perusahaan </label>
    <select class="form-control" id="id_perusahaan">
        <option value="">--- Pilih ---</option>
        <?php $this->m_data_user->select_perusahaan($data=NULL); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Departement </label>
    <select class="form-control" id="id_departement">
        <option value="">--- Pilih ---</option>
        <?php $this->m_data_user->select_departement($data=NULL); ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Username </label>
    <input class="form-control" type="text" id="username">
</div>
<div class="form-group">
    <label class="control-label">Email </label>
    <input class="form-control" type="text" id="email">
</div>
<div class="form-group">
    <label class="control-label">Password </label>
    <input class="form-control" type="password" id="password">
</div>
<div class="form-group">
    <label class="control-label">Ketik Ulang Password</label>
    <input class="form-control" type="password" id="passconf">
</div>
<div class="form-group">
    <label class="control-label">Level </label>
    <select class="form-control" id="level">
        <option value="5">Admin</option>
        <option value="4">Supervisor</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Status</label>
    <select class="form-control" id="status">
        <option value="1">Aktif</option>
        <option value="2">Nonaktif</option>
    </select>
</div>
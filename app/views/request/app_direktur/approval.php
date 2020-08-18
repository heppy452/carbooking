<div class="form-group">
    <select class="form-control" id="apr_dir">
        <option value="">--- Pilih Approval---</option>
        <option value="1" <?php if($id->apr_dir == 1){echo ' selected="selected"';}?>>Approved</option>
        <option value="2" <?php if($id->apr_dir == 2){echo ' selected="selected"';}?>>Denied</option>
    </select>
</div>
<?php 
	if ($id->apr_dir==2){
		$tampil='show';
	}else{
		$tampil='none';
	} 
?>
<div class="form-group" id="ket" style="display: <?=$tampil?>;">
    <textarea class="form-control" id="keterangan" placeholder="Keterangan"><?=$id->apr_dir_ket?></textarea>
</div>
<input type="hidden" id="id_request" value="<?=$id->id_request?>">
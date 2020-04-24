<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_data_user extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function select_perusahaan($data)
	{
		$db_hris = $this->load->database('db_hris', TRUE);
		$query = $db_hris->query('SELECT * FROM opt_perusahaan ORDER BY alias_perusahaan ASC');
		if(empty($data)){
			foreach($query->result() as $id) {
				echo '<option value="'.$id->id_perusahaan.'">'.$id->alias_perusahaan.'</option>';
			}
		}else{
			foreach($query->result() as $id) {
				if(strstr($data, $id->id_perusahaan) != FALSE){
					echo '<option value="'.$id->id_perusahaan.'" selected="selected">'.$id->alias_perusahaan.'</option>';
				}else{
					echo '<option value="'.$id->id_perusahaan.'">'.$id->alias_perusahaan.'</option>';
				}
			}
		}
	}

	function select_departement($data)
	{
		$db_hris = $this->load->database('db_hris', TRUE);
		$query = $db_hris->query('SELECT * FROM opt_divisi ORDER BY divisi_idn ASC');
		if(empty($data)){
			foreach($query->result() as $id) {
				echo '<option value="'.$id->id_divisi.'">'.$id->divisi_idn.'</option>';
			}
		}else{
			foreach($query->result() as $id) {
				if(strstr($data, $id->id_divisi) != FALSE){
					echo '<option value="'.$id->id_divisi.'" selected="selected">'.$id->divisi_idn.'</option>';
				}else{
					echo '<option value="'.$id->id_divisi.'">'.$id->divisi_idn.'</option>';
				}
			}
		}
	}

	function nama_perusahaan($data)
	{
		$db_hris = $this->load->database('db_hris', TRUE);
		$db_hris->select('alias_perusahaan');
		$db_hris->from('opt_perusahaan');
		$db_hris->where('id_perusahaan', $data);
		$get_data = $db_hris->get();
		$data = $get_data->row();
		if (isset($data->alias_perusahaan)){
			return $data->alias_perusahaan;
		} else {
			return 'Uknown';
		}
		
	}

	function nama_divisi($data)
	{
		$db_hris = $this->load->database('db_hris', TRUE);
		$db_hris->select('divisi_idn');
		$db_hris->from('opt_divisi');
		$db_hris->where('id_divisi', $data);
		$get_data = $db_hris->get();
		$data = $get_data->row();
		if (isset($data->divisi_idn)){
			return $data->divisi_idn;
		} else {
			return 'Uknown';
		}
		
	}
}
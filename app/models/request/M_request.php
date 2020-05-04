<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_request extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function data_request($param)
    {
    	$this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('id_user', $param);
        $get_all = $this->db->get();
        return $get_all;
    }

    function select_lokasi($data)
    {
        $query = $this->db->query('SELECT * FROM data_lokasi ORDER BY nama_lokasi ASC');
        if(empty($data)){
            foreach($query->result() as $id) {
                echo '<option value="'.$id->id_lokasi.'">'.$id->nama_lokasi.'</option>';
            }
        }else{
            foreach($query->result() as $id) {
                if(strstr($data, $id->id_lokasi) != FALSE){
                    echo '<option value="'.$id->id_lokasi.'" selected="selected">'.$id->nama_lokasi.'</option>';
                }else{
                    echo '<option value="'.$id->id_lokasi.'">'.$id->nama_lokasi.'</option>';
                }
            }
        }
    }

    function id_perusahaan($param)
    {
        $this->db->select('id_perusahaan');
        $this->db->from('conf_users');
        $this->db->where('id_user', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->id_perusahaan)){
            return $data->id_perusahaan;
        } else {
            return 0;
        }
    }

    function id_departement($param)
    {
        $this->db->select('id_departemen');
        $this->db->from('conf_users');
        $this->db->where('id_user', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->id_departemen)){
            return $data->id_departemen;
        } else {
            return 0;
        }
    }

    function lokasi($param)
    {
        $this->db->select('nama_lokasi');
        $this->db->from('data_lokasi');
        $this->db->where('id_lokasi', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->nama_lokasi)){
            return $data->nama_lokasi;
        } else {
            return 'Uknown';
        }
    }

    function get_tahun_tiket()
    {
        $this->db->select('nomor_request');
        $this->db->from('data_request');
        $this->db->order_by('id_request', 'desc');
        $this->db->limit(1);
        $get_data = $this->db->get();
        $data = $get_data->row();
        if(!empty($data->nomor_request)){
            $nomor_request = $data->nomor_request;
        }else{
            $nomor_request = '';
        }
        $char = substr($nomor_request,0,4);
        return $char;
    }

    function getLastTiket()
    {
        $query = $this->db->query("
                    SELECT RIGHT(nomor_request, 6)  AS tiket_num
                    FROM data_request
                    ORDER BY id_request DESC
                    LIMIT 1
                ");
        return $query->row();
    }

}
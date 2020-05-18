<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_proses extends CI_Model {

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

    function select_driver($data)
    {
        $query = $this->db->query('SELECT * FROM data_driver ORDER BY drv_nik ASC');
        if(empty($data)){
            foreach($query->result() as $id) {
                echo '<option value="'.$id->id_driver.'">'.$this->nama_driver($id->drv_nik).'</option>';
            }
        }else{
            foreach($query->result() as $id) {
                if(strstr($data, $id->id_driver) != FALSE){
                    echo '<option value="'.$id->id_driver.'" selected="selected">'.$this->nama_driver($id->drv_nik).'</option>';
                }else{
                    echo '<option value="'.$id->id_driver.'">'.$this->nama_driver($id->drv_nik).'</option>';
                }
            }
        }
    }

    function select_kendaraan($data)
    {
        $query = $this->db->query('SELECT * FROM data_kendaraan ORDER BY nomor_plat ASC');
        if(empty($data)){
            foreach($query->result() as $id) {
                echo '<option value="'.$id->id_kendaraan.'">'.$id->nomor_plat.'</option>';
            }
        }else{
            foreach($query->result() as $id) {
                if(strstr($data, $id->id_kendaraan) != FALSE){
                    echo '<option value="'.$id->id_kendaraan.'" selected="selected">'.$id->nomor_plat.'</option>';
                }else{
                    echo '<option value="'.$id->id_kendaraan.'">'.$id->nomor_plat.'</option>';
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

    function nama_driver($param)
    {
        $db_hris = $this->load->database('db_hris', TRUE);
        $db_hris -> select('nama_lengkap');
        $db_hris -> from('emp_master');
        $db_hris -> where('nik', $param);
        $emp = $db_hris->get();
        $dt = $emp->row();
        if (isset($dt->nama_lengkap)) {
            return $dt->nama_lengkap;
        } else {
            return '';
        }
    }

    function no_hp($param)
    {
        $this->db->select('drv_hp');
        $this->db->from('data_driver');
        $this->db->where('id_driver', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->drv_hp;
    }

    function nik_driver($param)
    {
        $this->db->select('drv_nik');
        $this->db->from('data_driver');
        $this->db->where('id_driver', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->drv_nik;
    }

    function plat($param)
    {
        $this->db->select('nomor_plat');
        $this->db->from('data_kendaraan');
        $this->db->where('id_kendaraan', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->nomor_plat;
    }

    function jenis_mobil($param)
    {
        $this->db->select('type_kendaraan');
        $this->db->from('data_kendaraan');
        $this->db->where('id_kendaraan', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->type_kendaraan;
    }
}
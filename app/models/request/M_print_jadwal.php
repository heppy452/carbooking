<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_print_jadwal extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function select_driver()
    {
        $query = $this->db->query('SELECT * FROM data_driver ORDER BY drv_nik ASC');
        foreach($query->result() as $id) {
            echo '<option value="'.$id->id_driver.'">'.$this->nama_driver($id->drv_nik).'</option>';
        }
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

    function data_print($id_driver,$tgl_jadwal)
    {
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('status_request', 1);
        $this->db->where('id_driver', $id_driver);
        $this->db->where('tgl_jadwal', $tgl_jadwal);
        $get_data = $this->db->get();
        $data = $get_data;
        return $data;
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
    
    function plat($param)
    {
        $this->db->select('nomor_plat');
        $this->db->from('data_kendaraan');
        $this->db->where('id_kendaraan', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->nomor_plat;
    }

    function no_internal($param)
    {
        $this->db->select('no_internal');
        $this->db->from('data_kendaraan');
        $this->db->where('id_kendaraan', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->no_internal;
    }
}
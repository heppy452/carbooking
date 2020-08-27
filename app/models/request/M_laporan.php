<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class M_laporan extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function select_kendaraan($data)
    {
        $query = $this->db->query('SELECT * FROM data_kendaraan ORDER BY nomor_plat ASC');
        if(empty($data)){
            foreach($query->result() as $id) {
                echo '<option value="'.$id->id_kendaraan.'">'.$id->nomor_plat.' ( '.$this->l_laporan->jenis_mobil($id->type_kendaraan).' )</option>';
            }
        }else{
            foreach($query->result() as $id) {
                if(strstr($data, $id->id_kendaraan) != FALSE){
                    echo '<option value="'.$id->id_kendaraan.'" selected="selected">'.$id->nomor_plat.' ( '.$this->l_laporan->jenis_mobil($id->type_kendaraan).' )</option>';
                }else{
                    echo '<option value="'.$id->id_kendaraan.'">'.$id->nomor_plat.' ( '.$this->l_laporan->jenis_mobil($id->type_kendaraan).' )</option>';
                }
            }
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

    function nama_driver($param)
    {
        $db_hris = $this->load->database('db_hris', TRUE);
        $db_hris->select('nama_lengkap');
        $db_hris->from('emp_master');
        $db_hris->where('nik', $param);
        $emp = $db_hris->get();
        $dt = $emp->row();
        return $dt->nama_lengkap;
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
        if (isset($data->nomor_plat)){
            return $data->nomor_plat;
        } else {
            return '-';
        }
        
    }

    function data_download($dari,$sampai,$kategori)
    {
        if ($kategori==2){
            $this->db->select('*');
            $this->db->from('data_request');
            $this->db->where('kategori',3);
            $this->db->where('status_request', 3);
            $this->db->where('dari_tanggal between"'.$dari.'"and"'.$sampai.'"','',false);
            $get_all = $this->db->get();
            return $get_all;
        } else {
            $this->db->select('*');
            $this->db->from('data_request');
            $this->db->where('kategori !=',3);
            $this->db->where('status_request', 3);
            $this->db->where('dari_tanggal between"'.$dari.'"and"'.$sampai.'"','',false);
            $get_all = $this->db->get();
            return $get_all;
        }
        
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
}
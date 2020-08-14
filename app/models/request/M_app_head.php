<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_app_head extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function data_request($id, $level, $perusahaan, $departement)
    {
        $this->db->select('*');
        $this->db->from('data_request');
        if ($level == 5) {
            $this->db->where('id_user', $id);
        } else if ($level == 4) {
            $this->db->where('jenis_kebutuhan', 1);
            $this->db->where('id_departement', $departement);
            $this->db->where('id_departement', $departement);
        } else if ($level == 2) {
            $this->db->where('apr_spv', 1);
            $this->db->where('apr_ga', 0);
        }

        $get_all = $this->db->get();
        return $get_all;
    }

    function data_detail($tanggal, $departement)
    {
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('dari_tanggal', $tanggal);
        $this->db->where('id_departement', $departement);
        $this->db->where('apr_spv', 0);
        $get_all = $this->db->get();
        return $get_all;
    }

    function id_perusahaan($param)
    {
        $this->db->select('id_perusahaan');
        $this->db->from('conf_users');
        $this->db->where('id_user', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->id_perusahaan)) {
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
        if (isset($data->id_departemen)) {
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
        if (isset($data->nama_lokasi)) {
            return $data->nama_lokasi;
        } else {
            return '-';
        }
    }

    function email_ga()
    {
        $this->db->select('email');
        $this->db->from('conf_users');
        $this->db->where('level', 2);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->email)) {
            return $data->email;
        } else {
            return 0;
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
        if (isset($data->alias_perusahaan)) {
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
        if (isset($data->divisi_idn)) {
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

    function nama_karyawan($param)
    {
        $db_hris = $this->load->database('db_hris', TRUE);
        $db_hris->select('nama_lengkap');
        $db_hris->from('emp_master');
        $db_hris->where('nik', $param);
        $emp = $db_hris->get();
        $dt = $emp->row();
        return $dt->nama_lengkap;
    }
}

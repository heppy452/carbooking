<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_request extends CI_Model
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


    function email($perusahaan, $departement)
    {
        $this->db->select('email');
        $this->db->from('conf_users');
        $this->db->where('id_perusahaan', $perusahaan);
        $this->db->where('id_departemen', $departement);
        $this->db->where('level', 4);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->email)) {
            return $data->email;
        } else {
            return 0;
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

    function email_admin($perusahaan, $departement)
    {
        $this->db->select('email');
        $this->db->from('conf_users');
        $this->db->where('id_perusahaan', $perusahaan);
        $this->db->where('id_departemen', $departement);
        $this->db->where('level', 5);
        $get_all = $this->db->get();
        $data = $get_all->row();
        if (isset($data->email)) {
            return $data->email;
        } else {
            return 0;
        }
    }

    function select_lokasi($data)
    {
        $query = $this->db->query('SELECT * FROM data_lokasi ORDER BY nama_lokasi ASC');
        if (empty($data)) {
            foreach ($query->result() as $id) {
                echo '<option value="' . $id->id_lokasi . '">' . $id->nama_lokasi . '</option>';
            }
        } else {
            foreach ($query->result() as $id) {
                if (strstr($data, $id->id_lokasi) != FALSE) {
                    echo '<option value="' . $id->id_lokasi . '" selected="selected">' . $id->nama_lokasi . '</option>';
                } else {
                    echo '<option value="' . $id->id_lokasi . '">' . $id->nama_lokasi . '</option>';
                }
            }
        }
    }

    function select_driver($data)
    {
        $query = $this->db->query('SELECT * FROM data_driver ORDER BY drv_nik ASC');
        if (empty($data)) {
            foreach ($query->result() as $id) {
                echo '<option value="' . $id->id_driver . '">' . $this->nama_driver($id->drv_nik) . '</option>';
            }
        } else {
            foreach ($query->result() as $id) {
                if (strstr($data, $id->id_driver) != FALSE) {
                    echo '<option value="' . $id->id_driver . '" selected="selected">' . $this->nama_driver($id->drv_nik) . '</option>';
                } else {
                    echo '<option value="' . $id->id_driver . '">' . $this->nama_driver($id->drv_nik) . '</option>';
                }
            }
        }
    }

    function select_kendaraan($data)
    {
        $query = $this->db->query('SELECT * FROM data_kendaraan ORDER BY nomor_plat ASC');
        if (empty($data)) {
            foreach ($query->result() as $id) {
                echo '<option value="' . $id->id_kendaraan . '">' . $id->nomor_plat . ' ( ' . $id->no_internal . ' )</option>';
            }
        } else {
            foreach ($query->result() as $id) {
                if (strstr($data, $id->id_kendaraan) != FALSE) {
                    echo '<option value="' . $id->id_kendaraan . '" selected="selected">' . $id->nomor_plat . ' ( ' . $id->no_internal . ' )</option>';
                } else {
                    echo '<option value="' . $id->id_kendaraan . '">' . $id->nomor_plat . ' ( ' . $id->no_internal . ' )</option>';
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
            return 'Uknown';
        }
    }

    //get nomor request
    function get_tahun_tiket()
    {
        $this->db->select('nomor_request');
        $this->db->from('data_request');
        $this->db->order_by('id_request', 'desc');
        $this->db->limit(1);
        $get_data = $this->db->get();
        $data = $get_data->row();
        if (!empty($data->nomor_request)) {
            $nomor_request = $data->nomor_request;
        } else {
            $nomor_request = '';
        }
        $char = substr($nomor_request, 0, 4);
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
    //end nomor request

    //get tiket
    function get_tiket()
    {
        $this->db->select('nomor_tiket');
        $this->db->from('data_request');
        $this->db->order_by('id_request', 'desc');
        $this->db->limit(1);
        $get_data = $this->db->get();
        $data = $get_data->row();
        if (!empty($data->nomor_tiket)) {
            $nomor_tiket = $data->nomor_tiket;
        } else {
            $nomor_tiket = '';
        }
        $char = substr($nomor_tiket, 0, 4);
        return $char;
    }

    function getLast()
    {
        $query = $this->db->query("
                    SELECT RIGHT(nomor_tiket, 6)  AS tiket_num
                    FROM data_request
                    ORDER BY id_request DESC
                    LIMIT 1
                ");
        return $query->row();
    }
    //end get tiket

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

    function data_karyawan($param)
    {
        $db_hris = $this->load->database('db_hris', TRUE);
        $db_hris->select('nama_lengkap,no_hp1,emp_master.id_perusahaan,emp_master.id_divisi,alias_perusahaan,divisi_idn');
        $db_hris->from('emp_master');
        $db_hris->join('opt_perusahaan', 'opt_perusahaan.id_perusahaan=emp_master.id_perusahaan', 'LEFT');
        $db_hris->join('opt_divisi', 'opt_divisi.id_divisi=emp_master.id_divisi', 'LEFT');
        $db_hris->where('nik', $param);
        $emp = $db_hris->get();
        $dt = $emp->row();
        return $dt;
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

    function no_internal($param)
    {
        $this->db->select('no_internal');
        $this->db->from('data_kendaraan');
        $this->db->where('id_kendaraan', $param);
        $get_all = $this->db->get();
        $data = $get_all->row();
        return $data->no_internal;
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

    function last_tiket()
    {
        $query = $this->db->query("SELECT nomor_request FROM data_request ORDER BY id_request DESC LIMIT 1");
        $data = $query->row();
        return $data->nomor_request;
    }
}

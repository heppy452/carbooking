<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public $dir_v = 'request/laporan/';
    public $dir_m = 'request/';
    public $dir_l = 'request/';

    public function __construct()
    {
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->helper('global');
        $this->load->model($this->dir_m . 'm_laporan');
        $this->load->library($this->dir_l . 'l_laporan');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datepicker/datepicker.min.css',
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datepicker/datepicker.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'lib/mask/jquery.mask.min.js',
            'src/js/request/laporan.js'
        );
        $data['panel'] = '<i class="fa fa-book"></i> &nbsp;<b>Laporan</b>';
        $this->l_skin->main($this->dir_v . 'view', $data);
    }

    function data()
    {
        $kategori       = $this->input->post('kategori');
        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        if ($kategori == 2) {
            $this->db->select('*');
            $this->db->from('data_request');
            $this->db->where('kategori', 3);
            $this->db->where('status_request', 3);
            $this->db->where('dari_tanggal between"' . $start_date . '"and"' . $end_date . '"', '', false);
            $get_all = $this->db->get();
            $data['id'] = $get_all;
            $this->load->view($this->dir_v . 'data1', $data);
        } else {
            $this->db->select('*');
            $this->db->from('data_request');
            $this->db->where('kategori !=', 3);
            $this->db->where('status_request', 3);
            $this->db->where('dari_tanggal between"' . $start_date . '"and"' . $end_date . '"', '', false);
            $get_all = $this->db->get();
            $data['id'] = $get_all;
            $this->load->view($this->dir_v . 'data', $data);
        }
    }

    function download($dari, $sampai, $kategori)
    {
        if ($kategori == 2) {
            ini_set('memory_limit', '16M');
            $this->load->library('Excel_xml');
            $xls    = new ExcelXml;
            $data   = array();
            $data[] =
                array(
                    'No',
                    'Nomor Tiket',
                    'Jenis Pemesan',
                    'Nomor Kendaraan',
                    'Perusahaan',
                    'Departement',
                    'Nomor Induk Karyawan',
                    'Nama Karyawan',
                    'Nama Tamu',
                    'Jenis Kebutuhan',
                    'Dari Tanggal',
                    'Sampai Tanggal',
                    'Dari Pukul',
                    'Sampai Pukul',
                    'Keterangan'
                );

            $no       = 1;
            $dari     = dateDB($dari);
            $sampai   = dateDB($sampai);
            $master   = $this->m_laporan->data_download($dari, $sampai, $kategori);

            foreach ($master->result() as $key) {
                if ($key->sampai_tanggal == '0000-00-00') {
                    $sampai_tanggal = '-';
                } else {
                    $sampai_tanggal = date('d-m-Y', strtotime($key->sampai_tanggal));
                }

                if ($key->dari_jam == '00:00:00') {
                    $dari_jam = '-';
                } else {
                    $dari_jam = $key->dari_jam;
                }

                if ($key->sampai_jam == '00:00:00') {
                    $sampai_jam = '-';
                } else {
                    $sampai_jam = $key->sampai_jam;
                }

                $data[] = array(
                    $no,
                    $key->nomor_request,
                    $this->l_laporan->jenis_pemesan($key->jns_pemesan),
                    $this->m_laporan->plat($key->id_kendaraan),
                    $this->m_laporan->nama_perusahaan($key->id_perusahaan),
                    $this->m_laporan->nama_divisi($key->id_departement),
                    $key->nik_karyawan,
                    $this->m_laporan->nama_driver($id->nik_karyawan),
                    $key->nama_lengkap,
                    $this->l_laporan->jenis_kebutuhan($key->jenis_kebutuhan),
                    date('d-m-Y', strtotime($key->dari_tanggal)),
                    $sampai_tanggal,
                    $dari_jam,
                    $sampai_jam,
                    $key->keterangan
                );
                $no++;
            }
            $file_name = 'Laporan Penggunaan Kendaraan';
            $xls->addWorksheet($file_name, $data);
            $xls->sendWorkbook($file_name . ' - ' . date('d-m-Y') . '.xls');
        } else {
            ini_set('memory_limit', '16M');
            $this->load->library('Excel_xml');
            $xls    = new ExcelXml;
            $data   = array();
            $data[] =
                array(
                    'No',
                    'Nomor Tiket',
                    'Tanggal Jadwal',
                    'Jenis Pemesan',
                    'Nomor Kendaraan',
                    'Nama Sopir',
                    'Perusahaan',
                    'Departement',
                    'Nomor Induk Karyawan',
                    'Nama Karyawan',
                    'Nama Tamu',
                    'Jenis Kebutuhan',
                    'Jenis Lokasi',
                    'Lokasi Keberangkatan',
                    'Lokasi Tujuan',
                    'Dari Pukul',
                    'Sampai Pukul',
                    'Keterangan'
                );

            $no       = 1;
            $dari     = dateDB($dari);
            $sampai   = dateDB($sampai);
            $master   = $this->m_laporan->data_download($dari, $sampai, $kategori);

            foreach ($master->result() as $key) {
                $nik = $this->m_laporan->nik_driver($key->id_driver);
                $data[] = array(
                    $no,
                    $key->nomor_request,
                    date('d-m-Y', strtotime($key->dari_tanggal)),
                    $this->l_laporan->jenis_pemesan($key->jns_pemesan),
                    $this->m_laporan->plat($key->id_kendaraan),
                    $this->m_laporan->nama_driver($nik),
                    $this->m_laporan->nama_perusahaan($key->id_perusahaan),
                    $this->m_laporan->nama_divisi($key->id_departement),
                    $key->nik_karyawan,
                    $this->m_laporan->nama_driver($key->nik_karyawan),
                    $key->nama_lengkap,
                    $this->l_laporan->jenis_kebutuhan($key->jenis_kebutuhan),
                    $this->l_laporan->jenis_lokasi($key->jenis_lokasi),
                    $this->m_laporan->lokasi($key->lokasi_awal),
                    $this->m_laporan->lokasi($key->lokasi_tujuan),
                    $key->dari_jam,
                    $key->sampai_jam,
                    $key->keterangan
                );
                $no++;
            }
            $file_name = 'Laporan Penggunaan Kendaraan';
            $xls->addWorksheet($file_name, $data);
            $xls->sendWorkbook($file_name . ' - ' . date('d-m-Y') . '.xls');
        }
    }
}

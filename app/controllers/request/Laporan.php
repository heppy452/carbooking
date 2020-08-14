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

        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('status_request', 3);
        $this->db->where('tgl_jadwal between"' . $start_date . '"and"' . $end_date . '"', '', false);
        $get_all = $this->db->get();
        $data['id'] = $get_all;
        $this->load->view($this->dir_v . 'data', $data);
    }

    function download($dari, $sampai)
    {
        ini_set('memory_limit', '4G');
        $this->load->library('Excel_xml');
        $xls    = new ExcelXml;
        $data   = array();
        $data[] =
            array(
                'No',
                'Nomor Tiket',
                'Nomor Kendaraan',
                'Perusahaan',
                'Departement',
                'Jenis Kebutuhan',
                'Lokasi Keberangkatan',
                'Lokasi Tujuan',
                'Keterangan'
            );

        $no       = 1;
        $dari     = dateDB($dari);
        $sampai   = dateDB($sampai);
        $master   = $this->m_laporan->data_download($dari, $sampai);

        foreach ($master->result() as $key) {

            $data[] = array(
                $no,
                $key->nomor_request,
                $this->m_laporan->plat($key->id_kendaraan),
                $this->m_laporan->nama_perusahaan($key->id_perusahaan),
                $this->m_laporan->nama_divisi($key->id_departement),
                $this->l_laporan->jenis_kebutuhan($key->jenis_kebutuhan),
                $this->m_laporan->lokasi($key->lokasi_awal),
                $this->m_laporan->lokasi($key->lokasi_tujuan),
                $key->keterangan
            );
            $no++;
        }
        $file_name = 'Laporan Penggunaan Kendaraan';
        $xls->addWorksheet($file_name, $data);
        $xls->sendWorkbook($file_name . ' - ' . date('d-m-Y') . '.xls');
    }
}

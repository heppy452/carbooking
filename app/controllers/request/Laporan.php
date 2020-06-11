<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public $dir_v = 'request/laporan/';
	public $dir_m = 'request/';
	public $dir_l = 'request/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_laporan');
        $this->load->library($this->dir_l.'l_laporan');
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
        $this->l_skin->main($this->dir_v.'view', $data);
    }

    function data()
    {
        $id_kendaraan   = $this->input->post('id_kendaraan');
        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('id_kendaraan', $id_kendaraan);
        $this->db->where('status_request', 3);
        $this->db->where('tgl_jadwal between"'.$start_date.'"and"'.$end_date.'"','',false);
        $get_all = $this->db->get();
        $data['id'] = $get_all;
        $this->load->view($this->dir_v.'data', $data);
    }
}
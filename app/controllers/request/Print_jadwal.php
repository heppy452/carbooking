<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_jadwal extends CI_Controller {

    public $dir_v = 'request/print_jadwal/';
	public $dir_m = 'request/';
	public $dir_l = 'request/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_print_jadwal');
        $this->load->library($this->dir_l.'l_print_jadwal');
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
            'src/js/request/print_jadwal.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Print Jadwal</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }
}
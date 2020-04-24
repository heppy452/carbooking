<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_driver extends CI_Controller {

    public $dir_v = 'more_data/data_driver/';
	public $dir_m = 'more_data/';
	public $dir_l = 'more_data/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
    }

    function index()
    {
       $data['css'] = array(
            'lib/datepicker/datepicker.min.css',
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/more_data/data_driver.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Driver</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }

    function table()
    {
        $db_hris = $this->load->database('db_hris', TRUE);
        $this->db->select('*');
        $this->db->from('data_driver');
        $get_all = $this->db->get();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            $nik = $id->drv_nik;

            $db_hris -> select('nama_lengkap');
            $db_hris -> from('emp_master');
            $db_hris -> where('nik', $nik);
            $emp = $db_hris->get();
            $dt = $emp->row();
            $data[] = array(
                "DT_RowId" => $id->id_driver,
                "0" => $id->drv_nik,
                "1" => $dt->nama_lengkap,
                "2" => $id->drv_hp
            );
         }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $get_all->num_rows(),
            "recordsFiltered" => $get_all->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    //Form Add
    function add()
    {
        $this->load->view($this->dir_v.'add');
    }

    function act_add()
    {
        $this->form_validation->set_rules('nik', 'Nik Driver', 'trim|required|is_unique[data_driver.drv_nik]');
        $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $data = array(
                    'drv_nik'   => $this->input->post('nik'),
                    'drv_hp'    => $this->input->post('no_hp')
                );
            $this->db->insert('data_driver', $data);
            $notif['notif'] = $this->input->post('nik').' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('data_driver');
        $this->db->where('id_driver', $data_id);
        $get_all = $this->db->get();
        $data['id'] = $get_all->row();
        $this->load->view($this->dir_v.'edit', $data);
    }

    function act_edit(){
        $data_id    = $this->input->post('id_driver');
        $nik        = $this->input->post('nik');
        $nik_lama   = $this->input->post('nik_lama');
        if ($nik==$nik_lama){
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            } else {
                $data = array(
                        'drv_hp'    => $this->input->post('no_hp')
                    );
                $this->db->where('id_driver', $data_id);
                $this->db->update('data_driver', $data);
                $notif['notif'] = $this->input->post('nik').' berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        } else {
            $this->form_validation->set_rules('nik', 'Nik Driver', 'trim|required|is_unique[data_driver.drv_nik]');
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            } else {
                $data = array(
                        'drv_nik'   => $this->input->post('nik'),
                        'drv_hp'    => $this->input->post('no_hp')
                    );
                $this->db->where('id_driver', $data_id);
                $this->db->update('data_driver', $data);
                $notif['notif'] = $this->input->post('nik').' berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        }
    }

    function act_del()
    {
        $data_id = $this->input->post('id');
        $this->db->where('id_driver', $data_id);
        $this->db->delete('data_driver');
        $notif['notif'] = 'Data berhasil dihapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }
}
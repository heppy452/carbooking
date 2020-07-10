<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_kendaraan extends CI_Controller {

    public $dir_v = 'more_data/data_kendaraan/';
	public $dir_m = 'more_data/';
	public $dir_l = 'more_data/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_data_kendaraan');
        $this->load->library($this->dir_l.'l_data_kendaraan');
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
            'src/js/more_data/data_kendaraan.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Kendaraan</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }

    function table()
    {
        $this->db->select('*');
        $this->db->from('data_kendaraan');
        $get_all = $this->db->get();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            
            $data[] = array(
                "DT_RowId" => $id->id_kendaraan,
                "0" => $id->nomor_plat,
                "1" => $id->no_internal,
                "2" => $this->l_data_kendaraan->type_kendaraan($id->type_kendaraan)
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
        $this->form_validation->set_rules('nomor', 'Nomor Plat Kendaraan', 'trim|required|is_unique[data_kendaraan.nomor_plat]');
        $this->form_validation->set_rules('no_internal', 'Nomor Internal', 'trim|required');
        $this->form_validation->set_rules('type', 'Type Kendaraan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $data = array(
                    'nomor_plat'   => $this->input->post('nomor'),
                    'no_internal'    => $this->input->post('no_internal'),
                    'type_kendaraan'    => $this->input->post('type')
                );
            $this->db->insert('data_kendaraan', $data);
            $notif['notif'] = $this->input->post('nomor').' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('data_kendaraan');
        $this->db->where('id_kendaraan', $data_id);
        $get_all = $this->db->get();
        $data['id'] = $get_all->row();
        $this->load->view($this->dir_v.'edit', $data);
    }

    function act_edit(){
        $data_id    = $this->input->post('id_kendaraan');
        $nomor        = $this->input->post('nomor');
        $nomor_lama   = $this->input->post('nomor_lama');
        if ($nomor==$nomor_lama){
            $this->form_validation->set_rules('no_internal', 'Nomor Internal', 'trim|required');
            $this->form_validation->set_rules('type', 'Type Kendaraan', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            } else {
                $data = array(
                        'type_kendaraan'    => $this->input->post('type'),
                        'no_internal'    => $this->input->post('no_internal')
                    );
                $this->db->where('id_kendaraan', $data_id);
                $this->db->update('data_kendaraan', $data);
                $notif['notif'] = $this->input->post('nomor').' berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        } else {
           $this->form_validation->set_rules('nomor', 'Nomor Plat Kendaraan', 'trim|required|is_unique[data_kendaraan.nomor_plat]');
           $this->form_validation->set_rules('no_internal', 'Nomor Internal', 'trim|required');
            $this->form_validation->set_rules('type', 'Type Kendaraan', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            } else {
                $data = array(
                    'nomor_plat'   => $this->input->post('nomor'),
                    'no_internal'    => $this->input->post('no_internal'),
                    'type_kendaraan'    => $this->input->post('type')
                );
                 $this->db->where('id_kendaraan', $data_id);
                $this->db->update('data_kendaraan', $data);
                $notif['notif'] = $this->input->post('nomor').' berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        }
    }

    function act_del()
    {
        $data_id = $this->input->post('id');
        $this->db->where('id_kendaraan', $data_id);
        $this->db->delete('data_kendaraan');
        $notif['notif'] = 'Data berhasil dihapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }

}
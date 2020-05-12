<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller {

    public $dir_v = 'request/request/';
	public $dir_m = 'request/';
	public $dir_l = 'request/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_request');
        $this->load->library($this->dir_l.'l_request');
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
            'src/js/request/request.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Permintaan</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }

    function table()
    {
        $id_user = $this->session->userdata('sess_id');
        $level_user = $this->session->userdata('sess_level');
        $perusahaan = $this->m_request->id_perusahaan($id_user);
        $departement= $this->m_request->id_departement($id_user);
        $get_all = $this->m_request->data_request($id_user,$level_user,$perusahaan,$departement);
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            if ($level_user==5){
                $action='<a href="" title="Finish"><i id="finish_btn" data-id="'.$id->id_request.'" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Detail"><i id="detail_btn" data-id="'.$id->id_request.'" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Edit"><i id="edit_btn" data-id="'.$id->id_request.'" class="fa fa-edit" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Delete"><i id="delete_btn" data-id="'.$id->id_request.'" class="fa fa-trash" style="font-size:15px; color:red;"></i></a>';
            } else if ($level_user==4){
                $action='<a href="" title="Approved"><i id="apr_spv" data-id="'.$id->id_request.'" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Denied"><i id="dined_spv" data-id="'.$id->id_request.'" class="fa fa-times" style="font-size:15px; color:red;"></i></a> &nbsp; <a href="" title="Detail"><i id="detail_btn" data-id="'.$id->id_request.'" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            } else if ($level_user==2){
                $action='<a href="" title="Approved"><i id="apr_ga" data-id="'.$id->id_request.'" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Denied"><i id="dined_ga" data-id="'.$id->id_request.'" class="fa fa-times" style="font-size:15px; color:red;"></i></a> &nbsp; <a href="" title="Detail"><i id="detail_btn" data-id="'.$id->id_request.'" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            }
            
            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $id->tgl_jadwal.' '.$id->jam_jemput,
                "2" => $this->l_request->jenis_kebutuhan($id->jenis_kebutuhan),
                "3" => $this->m_request->lokasi($id->lokasi_awal),
                "4" => $this->m_request->lokasi($id->lokasi_tujuan),
                "5" => $this->l_request->approve($id->apr_spv),
                "6" => $this->l_request->approve($id->apr_ga),
                "7" => $action
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
        $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
        $this->form_validation->set_rules('jam_penjemputan', 'Jam Penjemputan', 'trim|required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'trim|required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor Handphone', 'trim|required');
        $this->form_validation->set_rules('lokasi_penjemputan', 'Lokasi Penjemputan', 'trim|required');
        $this->form_validation->set_rules('lokasi_awal', 'Lokasi Awal', 'trim|required');
        $this->form_validation->set_rules('lokasi_tujuan', 'Lokasi Tujuan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $today = date("Y-m-d H:i:s",time()+60*60*7);
            $id_user  = $this->session->userdata('sess_id');
            $id_perusahaan  = $this->m_request->id_perusahaan($id_user);
            $id_departement = $this->m_request->id_departement($id_user);
            $no_request     = $this->generateCode();
            $data = array(
                    'nomor_request'     => $no_request,
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'tgl_jadwal'        => $this->input->post('tgl_jadwal'),
                    'jam_jemput'        => $this->input->post('jam_penjemputan'),
                    'lokasi_jemput'     => $this->input->post('lokasi_penjemputan'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'nama_pemesan'      => $this->input->post('nama_pemesan'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'lokasi_awal'       => $this->input->post('lokasi_awal'),
                    'lokasi_tujuan'     => $this->input->post('lokasi_tujuan'),
                    'keterangan'        => $this->input->post('keterangan'),
                    'id_perusahaan'     => $id_perusahaan,
                    'id_departement'    => $id_departement,
                    'id_user'           => $id_user,
                    'tgl_jam_input'     => $today
                    
                );
            $this->db->insert('data_request', $data);
            $notif['notif'] = 'Data berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function finish()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v.'finish', $data);
    }

    function save_finish()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('jam_berangkat', 'Jam Berangkat', 'trim|required');
        $this->form_validation->set_rules('jam_tiba', 'Jam Tiba', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $data = array(
                'jam_berangkat'     => $this->input->post('jam_berangkat'),
                'jam_tiba'          => $this->input->post('jam_tiba'),
                'status_request'    => 3
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);
            $notif['notif'] = 'Finish';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request='.$data_id.' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'edit', $data);
    }

    function act_edit()
    {
        $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
        $this->form_validation->set_rules('jam_penjemputan', 'Jam Penjemputan', 'trim|required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'trim|required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor Handphone', 'trim|required');
        $this->form_validation->set_rules('lokasi_penjemputan', 'Lokasi Penjemputan', 'trim|required');
        $this->form_validation->set_rules('lokasi_awal', 'Lokasi Awal', 'trim|required');
        $this->form_validation->set_rules('lokasi_tujuan', 'Lokasi Tujuan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $data_id = $this->input->post('id_request');
            $data = array(
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'tgl_jadwal'        => $this->input->post('tgl_jadwal'),
                    'jam_jemput'        => $this->input->post('jam_penjemputan'),
                    'lokasi_jemput'     => $this->input->post('lokasi_penjemputan'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'nama_pemesan'      => $this->input->post('nama_pemesan'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'lokasi_awal'       => $this->input->post('lokasi_awal'),
                    'lokasi_tujuan'     => $this->input->post('lokasi_tujuan'),
                    'keterangan'        => $this->input->post('keterangan')
                );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);
            $notif['notif'] = 'Data berhasil dirubah !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function act_del()
    {
        $id = $this->input->post('id_request');
        $this->db->where('id_request', $id);
        $this->db->delete('data_request');
        $notif['notif'] = 'Data '.$this->input->post('nomor_request').' berhasil di hapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }

    function tampil()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request='.$data_id.' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'tampil', $data);
    }

    function generateCode()
    {
        $no_request   = 1;
        $year       = date("Y");
        $tahun_tiket= $this->m_request->get_tahun_tiket();
        if ($year != $tahun_tiket){
            $no_request = 1;
        } else{
            $data = $this->m_request->getLastTiket();
            if($data){
                $no_request = $data->tiket_num + 1;
            }
        }
        return $year.str_pad($no_request,6,"0",STR_PAD_LEFT);
    }

    function apr_spv(){
        $data_id    = $this->input->post('id_request');
        $today = date("Y-m-d");
        $data = array(
            'apr_spv'       => 1,
            'apr_spv_tgl'   => $today,
            'apr_spv_ket'   => '',
            'status_request'=> 1,
            'apr_ga'        => 0,
            'apr_ga_tgl'    => 0000-00-00,
            'apr_ga_ket'    => ''
        );
        $this->db->where('id_request', $data_id);
        $this->db->update('data_request', $data);
        $notif['notif'] = 'Approved';
        $notif['status'] = 2;
        echo json_encode($notif);
    }

    function dined_spv()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v.'denied', $data);
    }

    function save_dined_spv()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $today = date("Y-m-d");
            $data = array(
                'apr_spv'       => 2,
                'apr_spv_tgl'   => $today,
                'apr_spv_ket'   => $this->input->post('keterangan'),
                'status_request'=> 2,
                'apr_ga'        => 2,
                'apr_ga_tgl'    => $today,
                'apr_ga_ket'    => 'Tidak disetujui oleh Head Departement'
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);
            $notif['notif'] = 'Denied';
            $notif['status'] = 2;
            echo json_encode($notif);
        }

    }

    function apr_ga()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v.'apr_ga', $data);
    }

    function save_apr_ga()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('id_driver', 'Nama Sopir', 'trim|required');
        $this->form_validation->set_rules('id_kendaraan', 'Plat Kendaraan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $today = date("Y-m-d");
            $data  = array(
                'apr_ga'       => 1,
                'apr_ga_tgl'   => $today,
                'apr_ga_ket'   => '',
                'status_request'=> 1,
                'id_driver'    => $this->input->post('id_driver'),
                'id_kendaraan' => $this->input->post('id_kendaraan')
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);
            $notif['notif'] = 'Approved';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

     function dined_ga()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v.'denied_ga', $data);
    }

    function save_denied_ga()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $today = date("Y-m-d");
            $data = array(
                'status_request'=> 2,
                'apr_ga'        => 2,
                'apr_ga_tgl'    => $today,
                'apr_ga_ket'    => $this->input->post('keterangan')
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);
            $notif['notif'] = 'Denied';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }
}
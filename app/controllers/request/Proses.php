<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proses extends CI_Controller {

    public $dir_v = 'request/proses/';
	public $dir_m = 'request/';
	public $dir_l = 'request/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_proses');
        $this->load->library($this->dir_l.'l_proses');
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
            'src/js/request/proses.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Permintaan Proses</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }

    function table()
    {
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('apr_spv', 1);
        $this->db->where('apr_ga', 1);
        $get_all = $this->db->get();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            $action='<a href="" title="Detail"><i id="detail_btn" data-id="'.$id->id_request.'" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Pilih Sopir"><i id="sopir_btn" data-id="'.$id->id_request.'" class="fa fa-user" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Edit"><i id="edit_btn" data-id="'.$id->id_request.'" class="fa fa-edit" style="font-size:15px; color:#0b7d32;"></i></a>';
            $id_user = $this->session->userdata('sess_id');
            if ($id_user==$id->id_user){
                $finish = '<a href="" title="Finish"><i id="finish_btn" data-id="'.$id->id_request.'" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a>&nbsp;';
            } else {
                $finish ='';
            }

            $id_driver      = $id->id_driver;
            if ($id_driver!=0){
                $nik    =$this->m_proses->nik_driver($id->id_driver);
                $nama   =$this->m_proses->nama_driver($nik);
            }else{
                $nama   = '';
            }

            $id_kendaraan   = $id->id_kendaraan;
            if ($id_kendaraan!=0){
                $id_type   =$this->m_proses->jenis_mobil($id_kendaraan);
                $type      =$this->l_proses->jenis_mobil($id_type);
                $no_plat   =$this->m_proses->plat($id_kendaraan);
            } else {
                $type ='';
                $no_plat ='';
            }
            
            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $id->tgl_jadwal.' '.$id->jam_jemput,
                "2" => $this->l_proses->jenis_kebutuhan($id->jenis_kebutuhan),
                "3" => $type.' '.$no_plat,
                "4" => $nama,
                "5" => $this->l_proses->status($id->status_request),
                "6" => $finish.' '.$action
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
        $this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'trim|required');
        $this->form_validation->set_rules('id_departement', 'Departement', 'trim|required');
        $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
        $this->form_validation->set_rules('jam_penjemputan', 'Jam Penjemputan', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Lama Pemakaian Kendaraan', 'trim|required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'trim|required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor Handphone', 'trim|required');
        $this->form_validation->set_rules('lokasi_penjemputan', 'Lokasi Penjemputan', 'trim|required');
        $this->form_validation->set_rules('lokasi_awal', 'Lokasi Keberangkatan', 'trim|required');
        $this->form_validation->set_rules('lokasi_tujuan', 'Lokasi Tujuan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $today = date("Y-m-d H:i:s",time()+60*60*7);
            $now = date("Y-m-d");
            $id_user  = $this->session->userdata('sess_id');
            $no_request     = $this->generateCode();
            $data = array(
                    'nomor_request'     => $no_request,
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'id_perusahaan'     => $this->input->post('id_perusahaan'),
                    'id_departement'    => $this->input->post('id_departement'),
                    'tgl_jadwal'        => $this->input->post('tgl_jadwal'),
                    'jam_jemput'        => $this->input->post('jam_penjemputan'),
                    'durasi'            => $this->input->post('durasi'),
                    'satuan'            => $this->input->post('satuan'),
                    'lokasi_jemput'     => $this->input->post('lokasi_penjemputan'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'nama_pemesan'      => $this->input->post('nama_pemesan'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'lokasi_awal'       => $this->input->post('lokasi_awal'),
                    'lokasi_tujuan'     => $this->input->post('lokasi_tujuan'),
                    'keterangan'        => $this->input->post('keterangan'),
                    'id_user'           => $id_user,
                    'tgl_jam_input'     => $today,
                    'apr_spv'           => 1,
                    'apr_spv_tgl'       => $now,
                    'apr_ga'            => 1,
                    'apr_ga_tgl'        => $now,
                    'status_request'    => 1
                    
                );
            $this->db->insert('data_request', $data);
            $notif['notif'] = 'Data berhasil disimpan !';
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
        $this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'trim|required');
        $this->form_validation->set_rules('id_departement', 'Departement', 'trim|required');
        $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
        $this->form_validation->set_rules('jam_penjemputan', 'Jam Penjemputan', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Lama Pemakaian Kendaraan', 'trim|required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'trim|required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor Handphone', 'trim|required');
        $this->form_validation->set_rules('lokasi_penjemputan', 'Lokasi Penjemputan', 'trim|required');
        $this->form_validation->set_rules('lokasi_awal', 'Lokasi Keberangkatan', 'trim|required');
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
                    'id_perusahaan'     => $this->input->post('id_perusahaan'),
                    'id_departement'    => $this->input->post('id_departement'),
                    'tgl_jadwal'        => $this->input->post('tgl_jadwal'),
                    'jam_jemput'        => $this->input->post('jam_penjemputan'),
                    'durasi'            => $this->input->post('durasi'),
                    'satuan'            => $this->input->post('satuan'),
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

    function generateCode()
    {
        $no_request   = 1;
        $year       = date("Y");
        $tahun_tiket= $this->m_proses->get_tahun_tiket();
        if ($year != $tahun_tiket){
            $no_request = 1;
        } else{
            $data = $this->m_proses->getLastTiket();
            if($data){
                $no_request = $data->tiket_num + 1;
            }
        }
        return $year.str_pad($no_request,6,"0",STR_PAD_LEFT);
    }

    function tampil()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request='.$data_id.' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'tampil', $data);
    }

    function sopir()
    {
        $data_id = $this->input->get('id_request');
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('id_request', $data_id);
        $get_all = $this->db->get();
        $data['id'] = $get_all->row();
        $this->load->view($this->dir_v.'sopir', $data);
    }

    function act_sopir()
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
}
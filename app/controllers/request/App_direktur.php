<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_direktur extends CI_Controller
{

    public $dir_v = 'request/app_direktur/';
    public $dir_m = 'request/';
    public $dir_l = 'request/';

    public function __construct()
    {
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m . 'm_app_direktur');
        $this->load->library($this->dir_l . 'l_app_direktur');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/request/app_direktur.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Tiket</b>';
        $this->l_skin->main($this->dir_v . 'view', $data);
    }

    function table()
    {
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('(kategori=3 AND jns_booking=2 AND apr_spv=1 AND jenis_lokasi=2)');
        $this->db->or_where('(kategori=2 AND jenis_kebutuhan=2 AND apr_spv=1 AND jenis_lokasi=2)');
        $this->db->or_where('(kategori=1 AND jenis_kebutuhan=2 AND apr_spv=1 AND jenis_lokasi=2)');
        $get_all = $this->db->get();

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach ($get_all->result() as $id) {
            $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; 
                        <a href="" title="Approval"><i id="appoval_btn" data-id="' . $id->id_request . '" class="fa fa-edit" style="font-size:15px; color:#0b7d32;"></i></a>';
            if ($id->sampai_tanggal == '0000-00-00') {
                $sampai_tanggal = '-';
            } else {
                $sampai_tanggal = date('d-m-Y', strtotime($id->sampai_tanggal));
            }

            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $this->m_app_direktur->nama_perusahaan($id->id_perusahaan),
                "2" => $this->m_app_direktur->nama_divisi($id->id_departement),
                "3" => date('d-m-Y', strtotime($id->dari_tanggal)),
                "4" => $sampai_tanggal,
                "5" => $this->l_app_direktur->approve($id->apr_dir),
                "6" => $action
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

    function tampil()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'tampil', $data);
    }

    function approval()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'approval', $data);
    }

    function save_approval()
    {
        $data_id    = $this->input->post('id_request');
        $apr_dir    = $this->input->post('apr_dir');

        $this->form_validation->set_rules('apr_dir', 'Approval', 'trim|required');
        if ($apr_dir == 2) {
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
            $status = 2;
        } else {
            $status = 1;
        }
        if ($this->form_validation->run() == FALSE) {
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $today = date('Y-m-d');
            if ($apr_dir == 1) {
                $keterangan = '';
            } else {
                $keterangan = $this->input->post('keterangan');
            }
            $data1 = array(
                'status_request' => $status,
                'apr_dir'       => $apr_dir,
                'apr_dir_tgl'   => $today,
                'apr_dir_ket'   => $keterangan
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data1);

            $notif['notif'] = 'Proses Selesai';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }
}

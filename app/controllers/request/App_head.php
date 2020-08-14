<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_head extends CI_Controller
{

    public $dir_v = 'request/app_head/';
    public $dir_m = 'request/';
    public $dir_l = 'request/';

    public function __construct()
    {
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m . 'm_app_head');
        $this->load->library($this->dir_l . 'l_app_head');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datepicker/datepicker.min.css',
            'lib/datepicker/bootstrap-datepicker.css',
            'lib/clockpicker/clockpicker.min.css',
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datepicker/datepicker.min.js',
            'lib/datepicker/bootstrap-datepicker.js',
            'lib/clockpicker/clockpicker.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'lib/mask/jquery.mask.min.js',
            'src/js/request/app_head.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Permintaan</b>';
        $this->l_skin->main($this->dir_v . 'view', $data);
    }

    function table()
    {
        $id_user = $this->session->userdata('sess_id');
        $level_user = $this->session->userdata('sess_level');
        $perusahaan = $this->m_app_head->id_perusahaan($id_user);
        $departement = $this->m_app_head->id_departement($id_user);
        $get_all = $this->m_app_head->data_request($id_user, $level_user, $perusahaan, $departement);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach ($get_all->result() as $id) {

            if ($id->apr_spv == 0) {
                $action = '<a href="" title="Approval"><i id="form_approval" data-tanggal="' . $id->dari_tanggal . '" data-departement="' . $id->id_departement . '" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp;<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            } else {
                $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            }

            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $id->dari_tanggal . ' ' . $id->dari_jam,
                "2" => $this->l_app_head->kategori($id->kategori),
                "3" => $this->m_app_head->lokasi($id->lokasi_awal),
                "4" => $this->m_app_head->lokasi($id->lokasi_tujuan),
                "5" => $this->l_app_head->status($id->status_request),
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

    function table_detail()
    {

        $tanggal = $this->input->get('tanggal');
        $departement = $this->input->get('departement');
        $get_all = $this->m_app_head->data_detail($tanggal, $departement);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach ($get_all->result() as $id) {

            if ($id->apr_spv == 0) {
                $action = '<a href="" title="Approval"><i id="form_approval" data-tanggal="' . $id->dari_tanggal . '" data-departement="' . $id->id_departement . '" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp;<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            } else {
                $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            }
            if ($id->dari_jam == '00:00:00') {
                $jam = '-';
            } else {
                $jam = $id->dari_jam;
            }

            $data[] = array(
                "DT_RowId" => $id->id_request . '' . $this->l_app_head->id_request($id->id_request),
                "0" => '<a href="#" id="detail_btn" style="color : red; text-decoration:none" data-id="' . $id->id_request . '">' . $id->nomor_request . '</a>',
                "1" => $this->m_app_head->nama_karyawan($id->nik_karyawan),
                "2" => $jam,
                "3" => $this->m_app_head->lokasi($id->lokasi_awal),
                "4" => $this->m_app_head->lokasi($id->lokasi_tujuan),
                "5" => $this->l_app_head->action_pilihan() . '' . $this->l_app_head->id_request($id->id_request),
                "6" => $this->l_app_head->keterangan(),
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

    function form_approval($tanggal, $departement)
    {
        $data['css'] = array(
            'lib/datepicker/datepicker.min.css',
            'lib/datepicker/bootstrap-datepicker.css',
            'lib/clockpicker/clockpicker.min.css',
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datepicker/datepicker.min.js',
            'lib/datepicker/bootstrap-datepicker.js',
            'lib/clockpicker/clockpicker.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'lib/mask/jquery.mask.min.js',
            'src/js/request/app_head.js'
        );
        $data['tanggal'] = $tanggal;
        $data['departement'] = $departement;
        $this->l_skin->main($this->dir_v . 'form_approval', $data);
    }

    function approve_all()
    {
        $id_request     = $this->input->post('id_request');
        $approved       = $this->input->post('approved');
        $keterangan     = $this->input->post('keterangan');
        $today          = date("Y-m-d");

        $count          = count($id_request);

        for ($i = 0; $i < $count; $i++) {
            if ($approved[$i] == 1) {
                $status = 1;
            } else {
                $status = 2;
            }
            $data[$i] = array(
                'id_request'        => $id_request[$i],
                'apr_spv'           => $approved[$i],
                'apr_spv_ket'       => $keterangan[$i],
                'apr_spv_tgl'       => $today,
                'status_request'    => $status,
            );
            $this->db->where('id_request', $id_request[$i]);
            $this->db->update('data_request', $data[$i]);
        }
        $notif['notif'] = 'Approved';
        $notif['status'] = 2;
        echo json_encode($notif);
    }


    function tampil()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . '  LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'tampil', $data);
    }

    //email ke GA
    function email_to_ga($data_id)
    {
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();

        $email_ga  = $this->m_app_head->email_ga();
        $from_email = "carpool@apps.imip.co.id";

        $config = array(
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://mail.apps.imip.co.id',
            'smtp_user'     => 'carpool@apps.imip.co.id',
            'smtp_pass'     => '84FML4GH3iB=',
            'smtp_port'     => 465,
            'mailtype'      => 'html',
            'smtp_timeout'  => 20,
            'charset'       => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $this->email->from($from_email, 'E-Carpool');
        $this->email->to($email_ga);
        $this->email->subject('Pemesanan Mobil E-Carpool IMIP');

        $message = $this->load->view($this->dir_v . 'email_app_spv', $data, TRUE);

        $this->email->message($message);
        $this->email->send();
    }
}

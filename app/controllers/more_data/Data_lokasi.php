<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_lokasi extends CI_Controller
{

    public $dir_v = 'more_data/data_lokasi/';
    public $dir_m = 'more_data/';
    public $dir_l = 'more_data/';

    public function __construct()
    {
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->library($this->dir_l . 'l_data_lokasi');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/more_data/data_lokasi.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Lokasi</b>';
        $this->l_skin->main($this->dir_v . 'view', $data);
    }

    function table()
    {
        $this->db->select('*');
        $this->db->from('data_lokasi');
        $get_all = $this->db->get();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach ($get_all->result() as $id) {

            $data[] = array(
                "DT_RowId" => $id->id_lokasi,
                "0" => $id->id_lokasi,
                "1" => $id->nama_lokasi,
                "2" => $this->l_data_lokasi->kategori_lokasi($id->kategori_lokasi)
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
        $this->load->view($this->dir_v . 'add');
    }

    function act_add()
    {
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'trim|required|is_unique[data_lokasi.nama_lokasi]');
        $this->form_validation->set_rules('kategori_lokasi', 'Kategori Lokasi', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $data = array(
                'nama_lokasi'   => $this->input->post('nama_lokasi'),
                'kategori_lokasi'   => $this->input->post('kategori_lokasi')
            );
            $this->db->insert('data_lokasi', $data);
            $notif['notif'] = $this->input->post('nama_lokasi') . ' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('data_lokasi');
        $this->db->where('id_lokasi', $data_id);
        $get_all = $this->db->get();
        $data['id'] = $get_all->row();
        $this->load->view($this->dir_v . 'edit', $data);
    }

    function act_edit()
    {
        $data_id         = $this->input->post('id_lokasi');
        $nama_lokasi     = $this->input->post('nama_lokasi');
        $nama_lokasi_old = $this->input->post('nama_lokasi_old');
        if ($nama_lokasi == $nama_lokasi_old) {
            $data = array(
                'kategori_lokasi'   => $this->input->post('kategori_lokasi')
            );
            $this->db->where('id_lokasi', $data_id);
            $this->db->update('data_lokasi', $data);
            $notif['notif'] = $this->input->post('nama_lokasi') . ' berhasil diupdate !';
            $notif['status'] = 2;
            echo json_encode($notif);
        } else {
            $data = array(
                'nama_lokasi'   => $this->input->post('nama_lokasi'),
                'kategori_lokasi'   => $this->input->post('kategori_lokasi')
            );
            $this->db->where('id_lokasi', $data_id);
            $this->db->update('data_lokasi', $data);
            $notif['notif'] = $this->input->post('nama_lokasi') . ' berhasil diupdate !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function act_del()
    {
        $data_id = $this->input->post('id');
        $this->db->where('id_lokasi', $data_id);
        $this->db->delete('data_lokasi');
        $notif['notif'] = 'Data berhasil dihapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }
}

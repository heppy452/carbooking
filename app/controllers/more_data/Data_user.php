<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_user extends CI_Controller {

    public $dir_v = 'more_data/data_user/';
    public $dir_m = 'more_data/';
	public $dir_l = 'more_data/';

    public $dir_v2 = 'admin/user/';
    public $dir_m2 = 'admin/';
    public $dir_l2 = 'admin/';

    public function __construct(){
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m.'m_data_user');
        $this->load->library($this->dir_l.'l_data_user');
        $this->load->model($this->dir_m2.'m_admin');
        $this->load->library($this->dir_l2.'l_admin');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'src/js/more_data/data_user.js'
        );
        $data['panel'] = '<i class="fa fa-users"></i> &nbsp;<b>Data User</b>';
        $this->l_skin->main($this->dir_v.'view', $data);
    }

    function table()
    {
        $this->db->select('*');
        $this->db->from('conf_users');
        $this->db->where("(level='4' OR level='5')");
        $get_all = $this->db->get();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach($get_all->result() as $id) {
            
            $data[] = array(
                "DT_RowId" => $id->id_user,
                "0" => $id->fullname,
                "1" => $id->username,
                "2" => $this->m_data_user->nama_perusahaan($id->id_perusahaan),
                "3" => $this->m_data_user->nama_divisi($id->id_departemen),
                "4" => $this->l_data_user->level($id->level),
                "5" => $this->l_data_user->status($id->status)
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
        $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'trim|required');
        $this->form_validation->set_rules('id_departement', 'Departement', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[conf_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $password = $this->input->post('password');
            $salt = $this->l_admin->rand_str(8, TRUE);
            $encrypt = $this->l_admin->encrypt_pass($password, $salt);
            $data = array(
                    'fullname' => $this->input->post('fullname'),
                    'username' => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                    'password' => $encrypt,
                    'id_perusahaan' => $this->input->post('id_perusahaan'),
                    'id_departemen' => $this->input->post('id_departement'),
                    'salt' => $salt,
                    'level' => $this->input->post('level'),
                    'status' => $this->input->post('status')
                );
            $this->db->insert('conf_users', $data);
            $notif['notif'] = 'Data user '.$this->input->post('fullname').' berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id    = $this->input->get('id_user');
        $result_id  = $this->db->query('SELECT * FROM conf_users WHERE id_user='.$data_id.' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'edit', $data);
    }

    function act_edit()
    {
        $id = $this->input->post('id_user');
        $username = $this->input->post('username');
        $username_old = $this->input->post('username_old');
        if($username === $username_old){
            $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'trim|required');
            $this->form_validation->set_rules('id_departement', 'Departement', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            if ($this->form_validation->run() == FALSE){
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            }else{
                $data = array(
                    'fullname' => $this->input->post('fullname'),
                    'id_perusahaan' => $this->input->post('id_perusahaan'),
                    'id_departemen' => $this->input->post('id_departement'),
                    'email' => $this->input->post('email'),
                    'level' => $this->input->post('level'),
                    'status' => $this->input->post('status')
                );
                $this->db->where('id_user', $id);
                $this->db->update('conf_users', $data);
                $notif['notif'] = 'Data User '.$this->input->post('fullname').' berhasil diubah !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        }else{
            $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('id_perusahaan', 'Perusahaan', 'trim|required');
            $this->form_validation->set_rules('id_departement', 'Departement', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[conf_users.username]');
            if ($this->form_validation->run() == FALSE){
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            }else{
                $data = array(
                    'fullname' => $this->input->post('fullname'),
                    'id_perusahaan' => $this->input->post('id_perusahaan'),
                    'id_departemen' => $this->input->post('id_departement'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    'level' => $this->input->post('level'),
                    'status' => $this->input->post('status')
                );
                $this->db->where('id_user', $id);
                $this->db->update('conf_users', $data);
                $notif['notif'] = 'Data User '.$this->input->post('fullname').' berhasil diubah !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        }
    }

    function act_del()
    {
        $id = $this->input->post('id_user');
        $this->db->where('id_user', $id);
        $this->db->delete('conf_users');
        $notif['notif'] = 'Data user '.$this->input->post('fullname').' berhasil di hapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }

    function reset()
    {
        $data_id = $this->input->get('id_user');
        $result_id = $this->db->query('SELECT id_user,fullname FROM conf_users WHERE id_user='.$data_id);
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v.'reset', $data);
    }
    
    function act_reset()
    {
        $id = $this->input->post('id_user');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        }else{
            $password = $this->input->post('password');
            $salt = $this->l_admin->rand_str(8, TRUE);
            $encrypt = $this->l_admin->encrypt_pass($password, $salt);
            $data = array(
                'password' => $encrypt,
                'salt' => $salt
            );
            $this->db->where('id_user', $id);
            $this->db->update('conf_users', $data);
            $notif['notif'] = 'Data password '.$this->input->post('fullname').' berhasil di reset !';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

}
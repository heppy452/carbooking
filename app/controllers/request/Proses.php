<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Proses extends CI_Controller
{

    public $dir_v = 'request/proses/';
    public $dir_m = 'request/';
    public $dir_l = 'request/';

    public function __construct()
    {
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m . 'm_proses');
        $this->load->library($this->dir_l . 'l_proses');
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
        $this->l_skin->main($this->dir_v . 'view', $data);
    }

    function permintaan_proses()
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
        $this->l_skin->main($this->dir_v . 'view_proses', $data);
    }

    function table()
    {
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('apr_spv', 1);
        $this->db->where('apr_ga', 0);
        $get_all = $this->db->get();
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 0;
        foreach ($get_all->result() as $id) {

            if ($id->kategori == 3 and $id->jns_booking == 2 and $id->apr_dir == 0) {
                $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            } else {
                $action = '<a href="" title="Approval"><i id="form_approval" data-tanggal="' . $id->dari_tanggal . '" data-departement="' . $id->id_departement . '" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp;';
            }

            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $id->dari_tanggal . ' ' . $id->dari_jam,
                "2" => $this->l_proses->kategori($id->kategori),
                "3" => $id->keterangan,
                "4" => $this->m_proses->lokasi($id->lokasi_awal),
                "5" => $this->m_proses->lokasi($id->lokasi_tujuan),
                "6" => $this->m_proses->nama_perusahaan($id->id_perusahaan),
                "7" => $this->m_proses->nama_departemen($id->id_departement),
                "8" => $this->l_proses->status($id->status_request),
                "9" => $action
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

    function table_proses()
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
        $i = 0;
        foreach ($get_all->result() as $id) {

            $nik_driver = $this->l_proses->status($id->status_request);

            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $id->dari_tanggal . ' ' . $id->dari_jam,
                "2" => $this->l_proses->kategori($id->kategori),
                "3" => $this->m_proses->lokasi($id->lokasi_awal),
                "4" => $this->m_proses->lokasi($id->lokasi_tujuan),
                "5" => $this->m_proses->nama_driver($nik_driver) . ' ' . $this->m_proses->no_internal($id->id_kendaraan),
                "6" => $this->l_proses->status($id->status_request),
                "7" => '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> 
                &nbsp; <a href="" title="Pilih Sopir"><i id="sopir_btn" data-id="' . $id->id_request . '" class="fa fa-user" style="font-size:15px; color:#0b7d32;"></i></a>
                &nbsp; <a href="" title="Edit"><i id="edit_btn" data-id="' . $id->id_request . '" class="fa fa-edit" style="font-size:15px; color:#0b7d32;"></i></a>'
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
        $get_all = $this->m_proses->data_detail($tanggal, $departement);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach ($get_all->result() as $id) {

            $driver = '<div class="row">' . $this->driver() . ' ' . $this->kendaraan() . '</div>';

            $data[] = array(
                "DT_RowId" => $id->id_request . '' . $this->l_proses->id_request($id->id_request),
                "0" => '<a href="#" id="detail_btn" style="color : red; text-decoration:none" data-id="' . $id->id_request . '">' . $id->nomor_request . '</a>',
                "1" => $id->dari_tanggal . ' ' . $id->dari_jam,
                "2" => $this->m_proses->lokasi($id->lokasi_awal),
                "3" => $this->m_proses->lokasi($id->lokasi_tujuan),
                "4" => $this->l_proses->action_pilihan() . '' . $this->l_proses->id_request($id->id_request),
                "5" => $this->l_proses->keterangan(),
                "6" => $driver,
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

    function driver()
    {
        return '
        <div class="col-lg">
        <div class="form-group">
        <select class="form-control driver" >
            <option value="0">--- Pilih ---</option>
                ' . $this->m_proses->driver() . '
            </select>
        </div>
        </div>';
    }

    function kendaraan()
    {
        return '
        <div class="col-lg">
        <div class="form-group">
        <select class="form-control kendaraan" >
            <option value="0">--- Pilih ---</option>
                ' . $this->m_proses->kendaraan() . '
            </select>
        </div>
        </div>';
    }

    function data()
    {

        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('status_request', 3);
        $this->db->where('dari_tanggal between"' . $start_date . '"and"' . $end_date . '"', '', false);
        $get_all = $this->db->get();
        $data['id'] = $get_all;
        $this->load->view($this->dir_v . 'data', $data);
    }

    function approve_all()
    {
        $id_request     = $this->input->post('id_request');
        $approved       = $this->input->post('approved');
        $keterangan     = $this->input->post('keterangan');
        $driver         = $this->input->post('driver');
        $kendaraan      = $this->input->post('kendaraan');
        $today          = date("Y-m-d");

        $count          = count($id_request);

        for ($i = 0; $i < $count; $i++) {
            if ($approved[$i] == 1) {
                $data[$i] = array(
                    'id_request'        => $id_request[$i],
                    'apr_ga'            => $approved[$i],
                    'apr_ga_ket'        => $keterangan[$i],
                    'apr_spv_tgl'       => $today,
                    'apr_ga_tgl'        => $today,
                    'id_kendaraan'      => $kendaraan[$i],
                    'id_driver'         => $driver[$i],
                    'status_request'    => 1,
                );

                $this->db->where('id_request', $id_request[$i]);
                $this->db->update('data_request', $data[$i]);
            } else {
                $data1[$i] = array(
                    'id_request'       => $id_request[$i],
                    'apr_ga'           => $approved[$i],
                    'apr_ga_ket'       => $keterangan[$i],
                    'apr_ga_tgl'       => $today,
                    'status_request'    => 2
                );

                //email approve spv ke admin GA
                // $this->email_to_ga($data_id);
                $this->db->where('id_request', $id_request[$i]);
                $this->db->update('data_request', $data1[$i]);
            }
        }

        $notif['notif'] = 'Approved';
        $notif['status'] = 2;
        echo json_encode($notif);
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
            'src/js/request/proses.js'
        );
        $data['tanggal'] = $tanggal;
        $data['departement'] = $departement;
        $this->l_skin->main($this->dir_v . 'form_approval', $data);
    }

    function edit()
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
            'src/js/request/request.js'
        );
        $data_id    = $this->input->get('id_request');
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('id_request', $data_id);
        $this->db->LIMIT(1);
        $result_id = $this->db->get();
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'edit', $data);
    }

    function act_edit()
    {
        $data_id = $this->input->post('id_request');
        $kategori = $this->input->post('kategori');
        $jns_booking = $this->input->post('jns_booking');
        $date = $this->input->post('tgl_jadwal');
        $date2 = $this->input->post('sampai_tanggal');
        $jns_pemesan = $this->input->post('jenis_pemesan');
        if ($jns_pemesan == 1) {
            $this->form_validation->set_rules('nik_input', 'Nomor Induk Karyawan', 'trim|required');
        } else {
            $this->form_validation->set_rules('nm_lengkap', 'Nama Lengkap', 'trim|required');
        }
        $this->form_validation->set_rules('nomor_hp', 'Nomor Telepon', 'trim|required');
        if ($kategori == 3) {
            if ($jns_booking == 1) {
                $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
                $this->form_validation->set_rules('dari_pukul', 'Dari Pukul', 'trim|required');
                $this->form_validation->set_rules('sampai_pukul', 'Sampai Pukul', 'trim|required');
                $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[15]');
                if ($this->form_validation->run() == FALSE) {
                    $notif['notif'] = validation_errors();
                    $notif['status'] = 1;
                    echo json_encode($notif);
                } else {
                    $data = array(
                        'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                        'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                        'jns_pemesan'       => $this->input->post('jenis_pemesan'),
                        'nik_karyawan'      => $this->input->post('nik_input'),
                        'nama_lengkap'      => $this->input->post('nm_lengkap'),
                        'no_hp'             => $this->input->post('nomor_hp'),
                        'jml_penumpang'     => $this->input->post('jml_penumpang'),
                        'dari_tanggal'      => date('Y-m-d', strtotime($date)),
                        'dari_jam'          => $this->input->post('dari_pukul'),
                        'sampai_jam'        => $this->input->post('sampai_pukul'),
                        'keterangan'        => $this->input->post('keterangan')
                    );
                    $this->db->where('id_request', $data_id);
                    $this->db->update('data_request', $data);
                    $notif['notif'] = 'Data berhasil dirubah !';
                    $notif['status'] = 2;
                    echo json_encode($notif);
                }
            } else {
                $this->form_validation->set_rules('tgl_jadwal', 'Dari Tanggal', 'trim|required');
                $this->form_validation->set_rules('sampai_tanggal', 'Sampai Tanggal', 'trim|required');
                $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[15]');
                if ($this->form_validation->run() == FALSE) {
                    $notif['notif'] = validation_errors();
                    $notif['status'] = 1;
                    echo json_encode($notif);
                } else {
                    $data = array(
                        'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                        'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                        'jns_pemesan'       => $this->input->post('jenis_pemesan'),
                        'nik_karyawan'      => $this->input->post('nik_input'),
                        'nama_lengkap'      => $this->input->post('nm_lengkap'),
                        'no_hp'             => $this->input->post('nomor_hp'),
                        'jml_penumpang'     => $this->input->post('jml_penumpang'),
                        'dari_tanggal'      => date('Y-m-d', strtotime($date)),
                        'sampai_tanggal'    => date('Y-m-d', strtotime($date2)),
                        'keterangan'        => $this->input->post('keterangan')
                    );
                    $this->db->where('id_request', $data_id);
                    $this->db->update('data_request', $data);
                    $notif['notif'] = 'Data berhasil dirubah !';
                    $notif['status'] = 2;
                    echo json_encode($notif);
                }
            }
        } else {
            $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
            $this->form_validation->set_rules('dari_pukul', 'Dari Pukul', 'trim|required');
            $this->form_validation->set_rules('sampai_pukul', 'Sampai Pukul', 'trim|required');
            $this->form_validation->set_rules('lokasi_penjemputan', 'Lokasi Penjemputan', 'trim|required');
            $this->form_validation->set_rules('lokasi_awal', 'Lokasi Keberangkatan', 'trim|required');
            $this->form_validation->set_rules('lokasi_tujuan', 'Lokasi Tujuan', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[15]');
            if ($this->form_validation->run() == FALSE) {
                $notif['notif'] = validation_errors();
                $notif['status'] = 1;
                echo json_encode($notif);
            } else {
                $data = array(
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'jns_pemesan'       => $this->input->post('jenis_pemesan'),
                    'nik_karyawan'      => $this->input->post('nik_input'),
                    'nama_lengkap'      => $this->input->post('nm_lengkap'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'dari_tanggal'      => date('Y-m-d', strtotime($date)),
                    'dari_jam'          => $this->input->post('dari_pukul'),
                    'sampai_jam'        => $this->input->post('sampai_pukul'),
                    'lokasi_jemput'     => $this->input->post('lokasi_penjemputan'),
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
    }


    function generateCode()
    {
        $no_request   = 1;
        $year       = date("Y");
        $tahun_tiket = $this->m_proses->get_tahun_tiket();
        if ($year != $tahun_tiket) {
            $no_request = 1;
        } else {
            $data = $this->m_proses->getLastTiket();
            if ($data) {
                $no_request = $data->tiket_num + 1;
            }
        }
        return $year . str_pad($no_request, 6, "0", STR_PAD_LEFT);
    }

    function tampil()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'tampil', $data);
    }

    function sopir()
    {
        $data_id = $this->input->get('id_request');
        $this->db->select('*');
        $this->db->from('data_request');
        $this->db->where('id_request', $data_id);
        $get_all = $this->db->get();
        $data['id'] = $get_all->row();
        $this->load->view($this->dir_v . 'sopir', $data);
    }

    function act_sopir()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('id_driver', 'Nama Sopir', 'trim|required');
        $this->form_validation->set_rules('id_kendaraan', 'Plat Kendaraan', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
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
        $this->load->view($this->dir_v . 'finish', $data);
    }

    function save_finish()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('jam_berangkat', 'Jam Berangkat', 'trim|required');
        $this->form_validation->set_rules('jam_tiba', 'Jam Tiba', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
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

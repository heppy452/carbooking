<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller
{

    public $dir_v = 'request/request/';
    public $dir_m = 'request/';
    public $dir_l = 'request/';

    public function __construct()
    {
        parent::__construct();
        $this->m_auth->check_login();
        $this->load->model($this->dir_m . 'm_request');
        $this->load->library($this->dir_l . 'l_request');
    }

    function index()
    {
        $data['css'] = array(
            'lib/datepicker/datepicker.min.css',
            'lib/datepicker/bootstrap-datepicker.css',
            'lib/datatables/dataTables.bootstrap.min.css'
        );
        $data['js'] = array(
            'lib/datatables/datatables.min.js',
            'lib/datepicker/datepicker.min.js',
            'lib/datepicker/bootstrap-datepicker.js',
            'lib/datatables/dataTables.bootstrap.min.js',
            'lib/mask/jquery.mask.min.js',
            'src/js/request/request.js'
        );
        $data['panel'] = '<i class="fa fa-laptop"></i> &nbsp;<b>Data Permintaan</b>';
        $this->l_skin->main($this->dir_v . 'view', $data);
    }

    function table()
    {
        $id_user = $this->session->userdata('sess_id');
        $level_user = $this->session->userdata('sess_level');
        $perusahaan = $this->m_request->id_perusahaan($id_user);
        $departement = $this->m_request->id_departement($id_user);
        $get_all = $this->m_request->data_request($id_user, $level_user, $perusahaan, $departement);

        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data = array();
        $i = 1;
        foreach ($get_all->result() as $id) {
            if ($level_user == 5) {
                if ($id->status_request == 0) {
                    $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; 
                        <a href="" title="Edit"><i id="edit_btn" data-id="' . $id->id_request . '" class="fa fa-edit" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; 
                        <a href="" title="Delete"><i id="delete_btn" data-id="' . $id->id_request . '" data-nomor="' . $id->nomor_request . '" class="fa fa-trash" style="font-size:15px; color:red;"></i></a>';
                } else if ($id->status_request == 1) {
                    $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Finish"><i id="finish_btn" data-id="' . $id->id_request . '" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; 
                        <a href="" title="Cancel"><i id="cancel_btn" data-id="' . $id->id_request . '" data-nomor="' . $id->nomor_request . '" class="fa fa-times" style="font-size:15px; color:red;"></i></a>';
                } else {
                    $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
                }
            } else if ($level_user == 4) {
                if ($id->apr_spv == 0) {
                    $action = '<a href="" title="Approved"><i id="apr_spv" data-id="' . $id->id_request . '" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Denied"><i id="dined_spv" data-id="' . $id->id_request . '" class="fa fa-times" style="font-size:15px; color:red;"></i></a> &nbsp; <a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
                } else {
                    $action = '<a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
                }
            } else if ($level_user == 2) {
                $action = '<a href="" title="Approved"><i id="apr_ga" data-id="' . $id->id_request . '" class="fa fa-check" style="font-size:15px; color:#0b7d32;"></i></a> &nbsp; <a href="" title="Denied"><i id="dined_ga" data-id="' . $id->id_request . '" class="fa fa-times" style="font-size:15px; color:red;"></i></a> &nbsp; <a href="" title="Detail"><i id="detail_btn" data-id="' . $id->id_request . '" class="fa fa-search" style="font-size:15px; color:#0b7d32;"></i></a>';
            }

            $data[] = array(
                "DT_RowId" => $id->id_request,
                "0" => $id->nomor_request,
                "1" => $id->tgl_jadwal . ' ' . $id->jam_jemput,
                "2" => $this->m_request->lokasi($id->lokasi_awal),
                "3" => $this->m_request->lokasi($id->lokasi_tujuan),
                "4" => $this->l_request->approve($id->apr_spv),
                "5" => $this->l_request->approve($id->apr_ga),
                "6" => $this->l_request->status($id->status_request),
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
    function add($param)
    {
        $data['kategori'] = $param;
        $this->load->view($this->dir_v . 'add', $data);
    }

    function data_karyawan()
    {
        $nik = $this->input->get('id');
        $data = $this->m_request->data_karyawan($nik);
        echo json_encode($data);
    }

    function data_lokasi()
    {
        $data = $this->m_request->select_lokasi($data = NULL);
        echo json_encode($data);
    }

    function act_add()
    {
        $today = date("Y-m-d H:i:s", time() + 60 * 60 * 7);
        $id_user  = $this->session->userdata('sess_id');
        $id_perusahaan  = $this->m_request->id_perusahaan($id_user);
        $id_departement = $this->m_request->id_departement($id_user);
        $jenis_pemesan  = $this->input->post('jenis_pemesan');
        $kategori       = $this->input->post('kategori');
        $jns_booking    = $this->input->post('jns_booking');
        $jns_layanan    = $this->input->post('jns_layanan');
        $pulang         = $this->input->post('pulang');
        $tanggal        = $this->input->post('tgl_jadwal_mlt');
        $penjemputan    = $this->input->post('lokasi_penjemputan_mlt');
        $tanggal_jadwal = $this->input->post('tanggal');

        // untuk kategori nondriver
        if ($kategori == 3) {
            //untuk booking by jam
            if ($jns_booking == 1) {

                $no_request     = $this->generateCode();

                $data = array(
                    'kategori'          => $kategori,
                    'jns_booking'       => $jns_booking,
                    'nomor_request'     => $no_request,
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'nik_karyawan'      => $this->input->post('nik_input'),
                    'nama_lengkap'      => $this->input->post('nm_lengkap'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'dari_tanggal'      => $this->input->post('tgl_jadwal_bkg'),
                    'dari_jam'        => $this->input->post('dari_pukul_bkg'),
                    'sampai_jam'        => $this->input->post('sampai_pukul_bkg'),
                    'keterangan'        => $this->input->post('keterangan_jam'),
                    'id_perusahaan'     => $id_perusahaan,
                    'id_departement'    => $id_departement,
                    'id_user'           => $id_user,
                    'tgl_jam_input'     => $today
                );
                $this->db->insert('data_request', $data);
                $notif['notif'] = 'Data berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);

                //untuk booking by tanggal
            } else if ($jns_booking == 2) {

                $no_request     = $this->generateCode();

                $data = array(
                    'kategori'          => $kategori,
                    'jns_booking'       => $jns_booking,
                    'nomor_request'     => $no_request,
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'nik_karyawan'      => $this->input->post('nik_input'),
                    'nama_lengkap'      => $this->input->post('nm_lengkap'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'dari_tanggal'      => $this->input->post('dari_tgl_bkg'),
                    'sampai_tanggal'      => $this->input->post('sampai_tgl_bkg'),
                    'keterangan'        => $this->input->post('keterangan_tanggal'),
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
            //untuk kategori tidak rutin
        } else if ($kategori == 1) {
            // untuk sekali jalan & multi tujuan
            $no_request     = $this->generateCode();
            $data = array(
                'kategori'          => $kategori,
                'jns_layanan'       => $jns_layanan,
                'nomor_request'     => $no_request,
                'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                'nik_karyawan'      => $this->input->post('nik_input'),
                'nama_lengkap'      => $this->input->post('nm_lengkap'),
                'no_hp'             => $this->input->post('nomor_hp'),
                'jml_penumpang'     => $this->input->post('jml_penumpang'),
                'dari_tanggal'      => $this->input->post('tgl_jadwal'),
                'dari_jam'          => $this->input->post('dari_pukul'),
                'sampai_jam'        => $this->input->post('sampai_pukul'),
                'lokasi_jemput'     => $this->input->post('lokasi_penjemputan'),
                'lokasi_awal'       => $this->input->post('lokasi_awal'),
                'lokasi_tujuan'     => $this->input->post('lokasi_tujuan'),
                'keterangan'        => $this->input->post('keterangan'),
                'id_perusahaan'     => $id_perusahaan,
                'id_departement'    => $id_departement,
                'id_user'           => $id_user,
                'tgl_jam_input'     => $today
            );
            $this->db->insert('data_request', $data);

            //kondisi pulang pergi
            if ($pulang == 1) {
                $last_notiket   = $this->m_request->last_tiket();
                $no_request2    = $this->generateCode();
                $data = array(
                    'kategori'          => $kategori,
                    'jns_layanan'       => $jns_layanan,
                    'nomor_request'     => $no_request2,
                    'alt_nomor_request' => $last_notiket,
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'nik_karyawan'      => $this->input->post('nik_input'),
                    'nama_lengkap'      => $this->input->post('nm_lengkap'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'dari_tanggal'      => $this->input->post('tgl_jadwal_plg'),
                    'dari_jam'          => $this->input->post('dari_pukul_plg'),
                    'sampai_jam'        => $this->input->post('sampai_pukul_plg'),
                    'lokasi_jemput'     => $this->input->post('lokasi_penjemputan_plg'),
                    'lokasi_awal'       => $this->input->post('lokasi_tujuan'),
                    'lokasi_tujuan'     => $this->input->post('lokasi_awal'),
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
                //tambah tujuan
            } else if (isset($tanggal)) {
                $tgl_jadwal     = $this->input->post('tgl_jadwal_mlt');
                if (isset($tgl_jadwal)) {
                    $count      = count($tgl_jadwal);
                } else {
                    $count      = 0;
                }

                $dari_pukul     = $this->input->post('dari_pukul_mlt');
                $sampai_pukul   = $this->input->post('sampai_pukul_mlt');
                $lokasi_penjemputan   = $this->input->post('lokasi_penjemputan_mlt');
                $lokasi_awal    = $this->input->post('lokasi_awal_mlt');
                $lokasi_tujuan  = $this->input->post('lokasi_tujuan_mlt');
                $keterangan     = $this->input->post('keterangan_mlt');

                for ($i = 0; $i < $count; $i++) {

                    $no_request3    = $this->generateCode();
                    $data[$i] = array(
                        'kategori'          => $kategori,
                        'jns_layanan'       => $jns_layanan,
                        'nomor_request'     => $no_request3,
                        'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                        'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                        'nik_karyawan'      => $this->input->post('nik_input'),
                        'nama_lengkap'      => $this->input->post('nm_lengkap'),
                        'no_hp'             => $this->input->post('nomor_hp'),
                        'jml_penumpang'     => $this->input->post('jml_penumpang'),
                        'dari_tanggal'      => $tgl_jadwal[$i],
                        'dari_jam'          => $dari_pukul[$i],
                        'sampai_jam'        => $sampai_pukul[$i],
                        'lokasi_jemput'     => $lokasi_penjemputan[$i],
                        'lokasi_awal'       => $lokasi_awal[$i],
                        'lokasi_tujuan'     => $lokasi_tujuan[$i],
                        'keterangan'        => $keterangan[$i],
                        'id_perusahaan'     => $id_perusahaan,
                        'id_departement'    => $id_departement,
                        'id_user'           => $id_user,
                        'tgl_jam_input'     => $today
                    );
                    $this->db->insert('data_request', $data[$i]);
                }
                $notif['notif'] = 'Data berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            } else {
                $notif['notif'] = 'Data berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
        } else if ($kategori == 2) {

            $MultiDate   = explode(",", $tanggal_jadwal);
            // $last_notiket   = $this->m_request->last_tiket();

            if (isset($MultiDate)) {
                $count      = count($MultiDate);
            } else {
                $count      = 0;
            }

            //perulangan tanggal
            foreach ($MultiDate as $date) {

                $no_request        = $this->generateCode();

                $data = array(
                    'kategori'          => $kategori,
                    'jns_layanan'       => $jns_layanan,
                    'nomor_request'     => $no_request,
                    // 'alt_nomor_request' => $last_notiket,
                    'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                    'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                    'nik_karyawan'      => $this->input->post('nik_input'),
                    'nama_lengkap'      => $this->input->post('nm_lengkap'),
                    'no_hp'             => $this->input->post('nomor_hp'),
                    'dari_jam'          => $this->input->post('dari_pukul'),
                    'sampai_jam'        => $this->input->post('sampai_pukul'),
                    'lokasi_awal'       => $this->input->post('lokasi_tujuan'),
                    'lokasi_tujuan'     => $this->input->post('lokasi_awal'),
                    'jml_penumpang'     => $this->input->post('jml_penumpang'),
                    'dari_tanggal'      => $date,
                    'keterangan'        => $this->input->post('keterangan'),
                    'id_perusahaan'     => $id_perusahaan,
                    'id_departement'    => $id_departement,
                    'id_user'           => $id_user,
                    'tgl_jam_input'     => $today
                );
                $this->db->insert('data_request', $data);
            }
            $notif['notif'] = 'Data berhasil disimpan !';
            $notif['status'] = 2;
            echo json_encode($notif);

            //cek pergi pulang
            if ($pulang == 1) {
                foreach ($MultiDate as $date) {

                    $no_request2    = $this->generateCode();
                    $data = array(
                        'kategori'          => $kategori,
                        'jns_layanan'       => $jns_layanan,
                        'nomor_request'     => $no_request2,
                        // 'alt_nomor_request' => $last_notiket,
                        'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                        'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                        'nik_karyawan'      => $this->input->post('nik_input'),
                        'nama_lengkap'      => $this->input->post('nm_lengkap'),
                        'no_hp'             => $this->input->post('nomor_hp'),
                        'jml_penumpang'     => $this->input->post('jml_penumpang'),
                        'dari_tanggal'      => $date,
                        'dari_jam'          => $this->input->post('dari_pukul_plg'),
                        'sampai_jam'        => $this->input->post('sampai_pukul_plg'),
                        'lokasi_jemput'     => $this->input->post('lokasi_penjemputan_plg'),
                        'lokasi_awal'       => $this->input->post('lokasi_tujuan'),
                        'lokasi_tujuan'     => $this->input->post('lokasi_awal'),
                        'keterangan'        => $this->input->post('keterangan'),
                        'id_perusahaan'     => $id_perusahaan,
                        'id_departement'    => $id_departement,
                        'id_user'           => $id_user,
                        'tgl_jam_input'     => $today
                    );
                    $this->db->insert('data_request', $data);
                }
                $notif['notif'] = 'Data berhasil disimpan !';
                $notif['status'] = 2;
                echo json_encode($notif);
            }
            // cek multi tujuan
            else if (isset($penjemputan)) {

                $lokasi     = $this->input->post('lokasi_penjemputan_mlt');
                if (isset($lokasi)) {
                    $count      = count($lokasi);
                } else {
                    $count      = 0;
                }
                $last_notiket   = $this->m_request->last_tiket();

                $dari_pukul     = $this->input->post('dari_pukul_mlt');
                $sampai_pukul   = $this->input->post('sampai_pukul_mlt');
                $lokasi_penjemputan   = $this->input->post('lokasi_penjemputan_mlt');
                $lokasi_awal    = $this->input->post('lokasi_awal_mlt');
                $lokasi_tujuan  = $this->input->post('lokasi_tujuan_mlt');
                $keterangan     = $this->input->post('keterangan_mlt');
                $tanggal_jadwal = $this->input->post('tanggal');

                // $date = explode(",", $tanggal_jadwal);

                for ($i = 0; $i < $count; $i++) {
                    foreach ($MultiDate as $date) {
                        $no_request2    = $this->generateCode();
                        $data[$i] = array(
                            'kategori'          => $kategori,
                            'jns_layanan'       => $jns_layanan,
                            'nomor_request'     => $no_request2,
                            'jenis_kebutuhan'   => $this->input->post('jenis_kebutuhan'),
                            'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
                            'nik_karyawan'      => $this->input->post('nik_input'),
                            'nama_lengkap'      => $this->input->post('nm_lengkap'),
                            'no_hp'             => $this->input->post('nomor_hp'),
                            'jml_penumpang'     => $this->input->post('jml_penumpang'),
                            'dari_tanggal'      => $date,
                            'dari_jam'          => $dari_pukul[$i],
                            'sampai_jam'        => $sampai_pukul[$i],
                            'lokasi_jemput'     => $lokasi_penjemputan[$i],
                            'lokasi_awal'       => $lokasi_awal[$i],
                            'lokasi_tujuan'     => $lokasi_tujuan[$i],
                            'keterangan'        => $keterangan[$i],
                            'id_perusahaan'     => $id_perusahaan,
                            'id_departement'    => $id_departement,
                            'id_user'           => $id_user,
                            'tgl_jam_input'     => $today
                        );
                        $this->db->insert('data_request', $data[$i]);
                    }
                }
                $notif['notif'] = 'Data berhasil disimpan !';
                $notif['status'] = 2;
            }
        }
    }

    function array()
    {
        $data = "1,2,3";
        $coba = explode(",", $data);
        var_dump($coba);
    }

    // kirim email ke atasan untuk keperluan peminjaman mobil ke GA
    function email_permintaan($data)
    {
        $id_user = $this->session->userdata('sess_id');
        $perusahaan = $this->m_request->id_perusahaan($id_user);
        $departement = $this->m_request->id_departement($id_user);

        $email_spv  = $this->m_request->email($perusahaan, $departement);
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
        $this->email->to($email_spv);
        $this->email->subject('Permintaan Approval Pemesanan Mobil ke GA IMIP');

        $message = $this->load->view($this->dir_v . 'email_permintaan', $data, TRUE);

        $this->email->message($message);
        $this->email->send();
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

    function cancel()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v . 'cancel', $data);
    }

    function save_cancel()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('ket_cancel', 'Keterangan', 'trim|required|min_length[20]');
        if ($this->form_validation->run() == FALSE) {
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $data = array(
                'ket_cancel'     => $this->input->post('ket_cancel'),
                'status_request'    => 4
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);
            $notif['notif'] = 'Cancel';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    function edit()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'edit', $data);
    }

    function act_edit()
    {
        $this->form_validation->set_rules('tgl_jadwal', 'Tanggal Jadwal', 'trim|required');
        $this->form_validation->set_rules('jam_penjemputan', 'Jam Penjemputan', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Lama Pemakaian Kendaraan', 'trim|required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'trim|required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor Handphone', 'trim|required');
        $this->form_validation->set_rules('lokasi_penjemputan', 'Lokasi Penjemputan', 'trim|required');
        $this->form_validation->set_rules('lokasi_awal', 'Lokasi Keberangkatan', 'trim|required');
        $this->form_validation->set_rules('lokasi_tujuan', 'Lokasi Tujuan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[20]');
        if ($this->form_validation->run() == FALSE) {
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $data_id = $this->input->post('id_request');
            $data = array(
                'jenis_lokasi'      => $this->input->post('jenis_lokasi'),
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

    function act_del()
    {
        $id = $this->input->post('id_request');
        $this->db->where('id_request', $id);
        $this->db->delete('data_request');
        $notif['notif'] = 'Data ' . $this->input->post('nomor_request') . 'berhasil di hapus !';
        $notif['status'] = 2;
        echo json_encode($notif);
    }

    function tampil()
    {
        $data_id    = $this->input->get('id_request');
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();
        $this->load->view($this->dir_v . 'tampil', $data);
    }

    function generateCode()
    {
        $no_request   = 1;
        $year       = date("Y");
        $tahun_tiket = $this->m_request->get_tahun_tiket();
        if ($year != $tahun_tiket) {
            $no_request = 1;
        } else {
            $data = $this->m_request->getLastTiket();
            if ($data) {
                $no_request = $data->tiket_num + 1;
            }
        }
        return $year . str_pad($no_request, 6, "0", STR_PAD_LEFT);
    }

    function apr_spv()
    {
        $data_id    = $this->input->post('id_request');
        $today = date("Y-m-d");
        $data = array(
            'apr_spv'       => 1,
            'apr_spv_tgl'   => $today,
            'apr_spv_ket'   => '',
            'status_request' => 1,
            'apr_ga'        => 0,
            'apr_ga_tgl'    => 0000 - 00 - 00,
            'apr_ga_ket'    => ''
        );
        $this->db->where('id_request', $data_id);
        $this->db->update('data_request', $data);

        //email approve spv ke admin GA
        // $this->email_to_ga($data_id);

        $notif['notif'] = 'Approved';
        $notif['status'] = 2;
        echo json_encode($notif);
    }

    //email ke GA
    function email_to_ga($data_id)
    {
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();

        $email_ga  = $this->m_request->email_ga();
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

    function dined_spv()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v . 'denied', $data);
    }

    function save_dined_spv()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[20]');
        if ($this->form_validation->run() == FALSE) {
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $today = date("Y-m-d");
            $data = array(
                'apr_spv'       => 2,
                'apr_spv_tgl'   => $today,
                'apr_spv_ket'   => $this->input->post('keterangan'),
                'status_request' => 2,
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
        $this->load->view($this->dir_v . 'apr_ga', $data);
    }

    function save_apr_ga()
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
                'apr_ga'       => 1,
                'apr_ga_tgl'   => $today,
                'apr_ga_ket'   => '',
                'status_request' => 1,
                'id_driver'    => $this->input->post('id_driver'),
                'id_kendaraan' => $this->input->post('id_kendaraan')
            );
            $this->db->where('id_request', $data_id);
            $this->db->update('data_request', $data);

            // $this->email_apr_ga($data_id);

            $notif['notif'] = 'Approved';
            $notif['status'] = 2;
            echo json_encode($notif);
        }
    }

    //email GA ke Admin
    function email_apr_ga($data_id)
    {
        $result_id  = $this->db->query('SELECT * FROM data_request WHERE id_request=' . $data_id . ' LIMIT 1');
        $data['id'] = $result_id->row();
        $datauser = $result_id->row();


        $perusahaan = $this->m_request->id_perusahaan($datauser->id_user);
        $departement = $this->m_request->id_departement($datauser->id_user);

        $email_admin  = $this->m_request->email_admin($perusahaan, $departement);
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
        $this->email->to($email_admin);
        $this->email->subject('Approve GA untuk Pemesanan Mobil E-Carpool IMIP');

        $message = $this->load->view($this->dir_v . 'email_app_ga', $data, TRUE);

        $this->email->message($message);
        $this->email->send();
    }

    function dined_ga()
    {
        $data['id'] = $this->input->get('id_request');
        $this->load->view($this->dir_v . 'denied_ga', $data);
    }

    function save_denied_ga()
    {
        $data_id    = $this->input->post('id_request');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[20]');
        if ($this->form_validation->run() == FALSE) {
            $notif['notif'] = validation_errors();
            $notif['status'] = 1;
            echo json_encode($notif);
        } else {
            $today = date("Y-m-d");
            $data = array(
                'status_request' => 2,
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

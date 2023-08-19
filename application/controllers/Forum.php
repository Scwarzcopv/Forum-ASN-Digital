<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SweetAlert2_model', 'sa2');
        $this->load->model('Sidebar_model', 'sidebar');
        $this->load->model('InfiniteScroll_model', 'iscroll');
        $this->load->model('Forum_model', 'forum');
        $this->load->model('Time_model', 'time');
        is_log_in();
        // Get data 'user'
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
        // Get session 'role_id'
        $this->role = $this->session->userdata('role_id');
    }

    public function index()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Forum';
        // Active Sidebar
        $data['sidebar'] = 'Forum';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/index', $data);
        $this->load->view('templates/footer');
    }

    function fetch_index()
    {
        if (!$this->input->post('limit')) redirect('forum');
        $output = '';
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $id_user = $this->data['user']['id'];
        $keyword = $this->input->post('keyword');
        $order = $this->input->post('order');
        $data = $this->iscroll->forum($limit, $start, $id_user, $keyword, $order);
        $result_data = $data['3']->result_array();
        $num_rows_1 = $data['num_rows_1'];
        $num_rows_2 = $data['num_rows_2'];
        $num_rows_3 = $data['num_rows_3'];
        $result['user'] = $this->data['user'];
        if ($num_rows_1 > 0) {
            if ($num_rows_3 > 0) {
                foreach ($result_data as $result['row']) {
                    // var_dump($result['row']) $result['row']['id_notulen']
                    $output .= $this->load->view('forum/index/data_forum', $result, true);
                }
            } else {
                $output = 'null2';
            }
        } else {
            $output = 'null';
        }
        echo json_encode(['data' => $output, 'num_rows' => $num_rows_2]);
    }

    function saklar_forum()
    {
        if (!$this->input->post('id_forum')) redirect('forum');
        $id_forum = $this->input->post('id_forum');
        $forum_active = $this->input->post('forum_active');
        $data = array(
            'forum_active' => $forum_active
        );
        $this->db->where('id', $id_forum);
        $this->db->update('forum', $data);
    }
    function saklar_tanya()
    {
        if (!$this->input->post('id_forum')) redirect('forum');
        $id_forum = $this->input->post('id_forum');
        $tanya_active = $this->input->post('tanya_active');
        $data = array(
            'tanya_active' => $tanya_active
        );
        $this->db->where('id', $id_forum);
        $this->db->update('forum', $data);
    }
    function saklar_komentar()
    {
        if (!$this->input->post('id_forum')) redirect('forum');
        $id_forum = $this->input->post('id_forum');
        $komentar_active = $this->input->post('komentar_active');
        $data = array(
            'komentar_active' => $komentar_active
        );
        $this->db->where('id', $id_forum);
        $this->db->update('forum', $data);
    }

    // FORUM DISKUSI
    public function forum_diskusi($id_forum)
    {
        // Session
        $data['user'] = $this->data['user'];
        // Cek Akses
        $this->forum->cek_forum_access($id_forum, $data['user']['id']);
        // Title
        $data['title'] = 'Forum';
        // Active Sidebar
        $data['sidebar'] = 'Forum';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);
        // Get Id forum
        $data['id_forum'] = $id_forum;
        // Get Foto Dokumentasi
        $data['foto_dokumentasi'] = $this->forum->foto_dokumentasi($id_forum)->result_array();
        // Get Info Notulen
        $data['info_notulen'] = $this->forum->info_notulen($id_forum)->row_array();
        $data['info_notulen']['tgl_selesai'] = strtotime($data['info_notulen']['tgl_selesai']);
        $data['info_notulen']['tgl_selesai'] = $this->time->getTimeSince($data['info_notulen']['tgl_selesai']) . ' (' . $this->time->getTimeAgo($data['info_notulen']['tgl_selesai']) . ')';

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/forum_diskusi', $data);
        $this->load->view('templates/footer');
    }
    function fetch_forum_diskusi()
    {
        if (!$this->input->post('limit')) redirect('forum');
        $output = '';
        $next = 'false';
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $id_forum = $this->input->post('id_forum');
        $data_forum = $this->forum->info_forum($id_forum)->row_array();
        $result['komentar_active'] = $data_forum['komentar_active'];
        // $id_user = $this->data['user']['id'];
        // $keyword = $this->input->post('keyword');
        // $order = $this->input->post('order');
        $data = $this->iscroll->forum_diskusi($limit, $start, $id_forum);
        $result_data = $data['2']->result_array();
        $num_rows_1 = $data['num_rows_1'];
        $num_rows_2 = $data['num_rows_2'];
        $result['user'] = $this->data['user'];
        if ($num_rows_1 > 0) {
            if ($num_rows_2 > 0) {
                $index = $start;
                foreach ($result_data as $result['row']) {
                    // var_dump($result['row']) $result['row']['id_notulen']
                    $index++;
                    $result['row']['index'] = $index;
                    $result['row']['id_penanya'] = $this->forum->info_user($result['row']['id_user_tanya']);
                    $result['row']['id_penjawab'] = $this->forum->info_user($result['row']['id_admin']);
                    // created_at_fp
                    $created_at_fp = strtotime($result['row']['created_at_fp']);
                    // $result['row']['created_at_fp_carbon'] = $this->time->getTimeSince($created_at_fp) . ' (' . $this->time->getTimeAgo($created_at_fp) . ')';
                    $result['row']['created_at_fp_carbon'] = $this->time->getTimeAgo($created_at_fp);
                    // answered_at
                    $answered_at = strtotime($result['row']['answered_at']);
                    $result['row']['answered_at_carbon'] = $this->time->getTimeAgo($answered_at);
                    // updated_at_fp
                    $updated_at_fp = strtotime($result['row']['updated_at_fp']);
                    $result['row']['updated_at_fp_carbon'] = $this->time->getTimeAgo($updated_at_fp);
                    $output .= $this->load->view('forum/forum_diskusi/data_forum_diskusi', $result, true);
                }
            } else {
                $output = 'null2';
            }
        } else {
            $output = 'null';
        }
        // Buat cek apakah masih ada data selanjutnya
        $data_next =  $this->iscroll->forum_diskusi($limit + 1, $start, $id_forum);
        if ($data_next['num_rows_2'] != $data['num_rows_2']) $next = 'true';
        echo json_encode(['data' => $output, 'num_rows' => $num_rows_1, 'next' => $next]);
    }
    function fetch_forum_diskusi_komentar()
    {
        if (!$this->input->post('id_forum')) redirect('forum');

        $result['id_forum'] = $this->input->post('id_forum');
        $result['id_fp'] = $this->input->post('id_fp');
        $result['id_user_tanya'] = $this->input->post('id_user_tanya');
        $result['user'] = $this->forum->info_user($this->input->post('user_id'));

        $output = '';
        $next = 'false';
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $id_forum = $result['id_forum'];
        $id_forum_pertanyaan = $result['id_fp'];

        $data = $this->iscroll->data_komentar($limit, $start, $id_forum, $id_forum_pertanyaan);
        $result_data = $data['2']->result_array();
        $num_rows_1 = $data['num_rows_1'];
        $num_rows_2 = $data['num_rows_2'];

        $data_forum = $this->forum->info_forum($result['id_forum'])->row_array();
        $result['komentar_active'] = $data_forum['komentar_active'];
        $result['nama_user_tanya'] = $this->input->post('nama_user_tanya');

        if ($num_rows_1 > 0) {
            if ($num_rows_2 > 0) {
                $index = $start;
                foreach ($result_data as $result['row']) {
                    $index++;
                    // var_dump($result['row']) $result['row']['id_notulen']
                    $result['data_user_komen'] = $this->forum->info_user($result['row']['id_user']);
                    $result['data_user_parent'] = $this->forum->info_user($result['row']['id_parent']);
                    // created_at
                    $created_at = strtotime($result['row']['created_at']);
                    $result['row']['created_at_carbon'] = $this->time->getTimeAgo($created_at);
                    // updated_at_fp
                    $updated_at = strtotime($result['row']['updated_at']);
                    $result['row']['updated_at_carbon'] = $this->time->getTimeAgo($updated_at);

                    $output .= $this->load->view('forum/forum_diskusi/data_balasan', $result, true);
                }
            } else {
                $output = 'null2';
            }
        } else {
            $output = 'null';
        }
        // Buat cek apakah masih ada data selanjutnya
        $data_next =  $this->iscroll->data_komentar($limit + 1, $start, $id_forum, $id_forum_pertanyaan);
        if ($data_next['num_rows_2'] != $data['num_rows_2']) $next = 'true';
        echo json_encode(['data' => $output, 'num_rows' => $num_rows_1, 'next' => $next]);
    }
    function fetch_modal()
    {
        if (!$this->input->post('id_fp')) redirect('forum');

        $data['id_forum'] = $this->input->post('id_forum');
        $data['user_id'] = $this->data['user'];
        $this->forum->cek_forum_active($data['id_forum'], $data['user_id']['id']);
        $this->forum->cek_forum_tanya_active($data['id_forum'], $data['user_id']['role_id']);
    }
    function fetch_balas()
    {
        if (!$this->input->post('id_fp')) redirect('forum');

        $output = '';
        $data['id_fp'] = $this->input->post('id_fp');
        $data['fp'] = $this->forum->info_forum_pertanyaan($data['id_fp'])->row_array();
        $data['id_fc'] = $this->input->post('id_fc');
        $data['id_forum'] = $this->input->post('id_forum');
        $data['parent_anonim'] = $this->input->post('parent_anonim');
        $data['nama_user_tanya'] = null;
        $data['index_user_tanya'] = null;
        // $data['user_id'] = $this->forum->info_user($this->input->post('user_id'));
        $data['user_id'] = $this->data['user'];
        $this->forum->cek_forum_active($data['id_forum'], $data['user_id']['id']);
        $this->forum->cek_forum_komentar_active($data['id_forum'], $data['user_id']['role_id']);

        // Balas Pertanyaan
        if (empty($this->input->post('id_fc')) && empty($this->input->post('id_user_admin'))) {
            $data['id_user_parent'] = $this->forum->info_user($this->input->post('id_user_tanya'));
            $data['nama_user_tanya'] = $this->input->post('nama_user_tanya');
            $data['index_user_tanya'] = $this->input->post('index_user_tanya');
            $output = $this->load->view('forum/forum_diskusi/data_form_balas', $data, true);
        }
        // Balas Jawaban Pertanyaan
        else if (empty($this->input->post('id_fc')) && !empty($this->input->post('id_user_admin'))) {
            $data['id_user_parent'] = $this->forum->info_user($this->input->post('id_user_admin'));
            // $data['nama_user_parent'] = $data['id_user_parent']['name'];
            $output = $this->load->view('forum/forum_diskusi/data_form_balas', $data, true);
        }
        // Balas Komentar
        else {
            $data['id_user_parent'] = $this->forum->info_user($this->input->post('id_user_fc'));
            // $data['nama_user_parent'] = $data['id_user_parent']['name'];
            $output = $this->load->view('forum/forum_diskusi/data_form_balas', $data, true);
        }
        // if (!$this->input->post('limit')) redirect('forum');
        // $output = '';
        // $limit = $this->input->post('limit');
        // $start = $this->input->post('start');
        echo $output;
    }
    function fetch_tampilkan_balasan()
    {
        // id_fp = Id tabel Forum Pertanyaan
        if (!$this->input->post('id_fp')) redirect('forum');
        $output = '';
        $result['id_forum'] = $this->input->post('id_forum');
        $result['id_fp'] = $this->input->post('id_fp');
        $result['id_user_tanya'] = $this->input->post('id_user_tanya');
        $result['user'] = $this->forum->info_user($this->input->post('user_id'));
        $data = $this->forum->data_komentar($result['id_forum'], $result['id_fp']);
        $result_data = $data->result_array();
        $data_forum = $this->forum->info_forum($result['id_forum'])->row_array();
        $result['komentar_active'] = $data_forum['komentar_active'];
        $result['nama_user_tanya'] = $this->input->post('nama_user_tanya');

        // $output = $this->load->view('forum/data_balas_pertanyaan', $data, true);
        // if (!$this->input->post('limit')) redirect('forum');
        // $output = '';
        // $limit = $this->input->post('limit');
        // $start = $this->input->post('start');
        if ($data->num_rows() > 0) {
            foreach ($result_data as $result['row']) {
                // var_dump($result['row']) $result['row']['id_notulen']
                $result['data_user_komen'] = $this->forum->info_user($result['row']['id_user']);
                $result['data_user_parent'] = $this->forum->info_user($result['row']['id_parent']);
                // created_at
                $created_at = strtotime($result['row']['created_at']);
                $result['row']['created_at_carbon'] = $this->time->getTimeAgo($created_at);
                // updated_at_fp
                $updated_at = strtotime($result['row']['updated_at']);
                $result['row']['updated_at_carbon'] = $this->time->getTimeAgo($updated_at);

                $output .= $this->load->view('forum/forum_diskusi/data_balasan', $result, true);
            }
        }
        echo json_encode(['data' => $output, 'total_komentar' => $data->num_rows()]);
    }















    public function pertanyaan_tertunda()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Pertanyaan Tertunda';
        // Active Sidebar
        $data['sidebar'] = 'Pertanyaan Tertunda';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/pertanyaan_tertunda', $data);
        $this->load->view('templates/footer');
    }

    public function pertanyaan()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Pertanyaan';
        // Active Sidebar
        $data['sidebar'] = 'Pertanyaan';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/pertanyaan', $data);
        $this->load->view('templates/footer');
    }
}

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
                    $output .= $this->load->view('forum/data_forum', $result, true);
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
        // Get Foto Dokumentasi
        $data['foto_dokumentasi'] = $this->forum->foto_dokumentasi($id_forum)->result_array();
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

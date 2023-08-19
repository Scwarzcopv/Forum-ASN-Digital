<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Sidebar_model', 'sidebar');
        $this->load->model('InfiniteScroll_model', 'iscroll');
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
        $data['title'] = 'Hasil Rapat';
        // Active Sidebar
        $data['sidebar'] = 'Hasil Rapat';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Infinite Scroll
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('event/index', $data);
        $this->load->view('templates/footer', $data);
    }

    function fetch()
    {
        if (!$this->input->post('limit')) redirect('event');
        $output = '';
        $next = 'false';
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $id_user = $this->data['user']['id'];
        $keyword = $this->input->post('keyword');
        $order = $this->input->post('order');
        $data = $this->iscroll->notulen_peserta($limit, $start, $id_user, $keyword, $order);
        $result = $data['3']->result_array();
        $num_rows_1 = $data['num_rows_1'];
        $num_rows_2 = $data['num_rows_2'];
        $num_rows_3 = $data['num_rows_3'];
        if ($num_rows_1 > 0) {
            if ($num_rows_3 > 0) {
                foreach ($result as $result['row']) {
                    // var_dump($result['row']) $result['row']['id_notulen']
                    $output .= $this->load->view('event/data_event', $result, true);
                }
            } else {
                $output = 'null2';
            }
        } else {
            $output = 'null';
        }
        // Buat cek apakah masih ada data selanjutnya
        $data_next =  $this->iscroll->notulen_peserta($limit + 1, $start, $id_user, $keyword, $order);
        if ($data_next['num_rows_3'] != $data['num_rows_3']) $next = 'true';
        echo json_encode(['data' => $output, 'num_rows' => $num_rows_2, 'next' => $next]);
    }
}

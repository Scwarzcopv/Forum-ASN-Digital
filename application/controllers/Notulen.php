<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notulen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('SweetAlert2_model', 'sa2');
        $this->load->model([
            'Dt_notulen'
        ]);
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'List Notulen';
        // Active Sidebar
        $data['sidebar'] = 'List Notulen';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        }
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notulen/index', $data);
        $this->load->view('templates/footer');
    }
    public function persetujuan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'Persetujuan Notulen';
        // Active Sidebar
        $data['sidebar'] = 'Persetujuan Notulen';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        }
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notulen/persetujuan', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Datatables Notulen
     *
     * @AclName Datatables Notulen
     */
    public function get_list_notulen()
    {
        $notulens = $this->Dt_notulen->get_datatables();
        $no         = $this->input->post('start');

        foreach ($notulens as $notulen) {
            $no++;
            $notulen->no = $no . '. ';
        }

        $output = [
            "draw"              => $this->input->post('draw'),
            "recordsTotal"      => $this->Dt_notulen->count_all(),
            "recordsFiltered"   => $this->Dt_notulen->count_filtered(),
            "data"              => $notulens,
        ];

        echo json_encode($output);
    }

    /**
     * Simpan notulen
     *
     * @AclName Simpan notulen
     */
    public function simpan()
    {
        $user_id = $this->session->userdata('id');
        if ($this->input->post('id_notulen')) {
            $notulen_id = $this->input->post('id_notulen');
            $data_notulen = [
                'no_surat' => $this->input->post('no_surat'),
                'agenda_rapat' => $this->input->post('agenda_rapat'),
                'penyelenggara' => $this->input->post('penyelenggara'),
                'tempat_rapat' => $this->input->post('tempat_rapat'),
                'tgl_mulai' => $this->input->post('tanggal_mulai'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'tgl_selesai' => $this->input->post('tanggal_selesai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
                'pimpinan_rapat' => $this->input->post('nip_pj'),
                'nama_notulis' => $this->input->post('nama_notulis'),
                'nip_notulis' => $this->input->post('nip_notulis'),
                'hasil_rapat' => $this->input->post('isi_notulen'),
                'list_peserta' => $this->input->post('list_peserta'),
                'cek_peserta' => $this->input->post('cek_peserta'),
                'cek_pimpinan' => $this->input->post('cek_pimpinan'),
                'materi' => $this->input->post('materi'),
                'updated_at' => date("Y-m-d")
            ];
            $this->db->where(['id' =>  $notulen_id])->update('notulen_hasil_rapat', $data_notulen);
        } else {
            $data_notulen = [
                'no_surat' => $this->input->post('no_surat'),
                'agenda_rapat' => $this->input->post('agenda_rapat'),
                'penyelenggara' => $this->input->post('penyelenggara'),
                'tempat_rapat' => $this->input->post('tempat_rapat'),
                'tgl_mulai' => $this->input->post('tanggal_mulai'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'tgl_selesai' => $this->input->post('tanggal_selesai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
                'pimpinan_rapat' => $this->input->post('nip_pj'),
                'nama_notulis' => $this->input->post('nama_notulis'),
                'nip_notulis' => $this->input->post('nip_notulis'),
                'id_notulis' => $user_id,
                'hasil_rapat' => $this->input->post('isi_notulen'),
                'list_peserta' => $this->input->post('list_peserta'),
                'cek_peserta' => $this->input->post('cek_peserta'),
                'cek_pimpinan' => $this->input->post('cek_pimpinan'),
                'materi' => $this->input->post('materi'),
                'skpd_id' => $this->Mskpdkode->get_skpd_id($user['skpd_id']),
                'created_at' => date("Y-m-d"),
                '_active' => 1,
            ];
            $this->db->insert('notulen_hasil_rapat', $data_notulen);
            $notulen_id = $this->db->insert_id();
        }
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './upload/notulen_foto/';
            $config['allowed_types'] = 'jpg|jpeg';
            $config['max_size'] = '5000'; // max_size in kb
            $config['file_ext_tolower'] = TRUE;
            $this->upload->initialize($config);
            $fotoLength = count($_FILES['foto']['name']);
            for ($i = 0; $i < $fotoLength; $i++) {
                if (!empty($_FILES['foto']['name'][$i])) {
                    $dname = explode(".", $_FILES['foto']['name'][$i]);
                    $ext = end($dname);

                    // Define new $_FILES array - $_FILES['file']
                    $this->load->library('upload');
                    $_FILES['file']['name'] = sprintf("%05d", $notulen_id) . '_foto_' . md5($_FILES['foto']['name'][$i]) . '.' . $ext;
                    $_FILES['file']['type'] = $_FILES['foto']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['foto']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['foto']['size'][$i];


                    //Load upload library
                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        echo json_encode($uploadData);

                        $resizedDestination =  $uploadData['file_path'] . $uploadData['file_name'] . "_RESIZED.jpg";

                        copy($uploadData['full_path'], $resizedDestination);

                        $imageSize = getImageSize($uploadData['full_path']);
                        $imageWidth = $imageSize[0];
                        $imageHeight = $imageSize[1];

                        if ($imageWidth > $imageHeight) {
                            $DESIRED_WIDTH = 1280;
                            $proportionalHeight = round(($DESIRED_WIDTH * $imageHeight) / $imageWidth);

                            $originalImage = imageCreateFromJPEG($uploadData['full_path']);

                            $resizedImage = imageCreateTrueColor($DESIRED_WIDTH, $proportionalHeight);

                            imageCopyResampled($resizedImage, $originalImage, 0, 0, 0, 0, $DESIRED_WIDTH + 1, $proportionalHeight + 1, $imageWidth, $imageHeight);
                        } else {
                            $DESIRED_HEIGHT = 1280;
                            $proportionalWidth = round(($DESIRED_HEIGHT * $imageWidth) / $imageHeight);

                            $originalImage = imageCreateFromJPEG($uploadData['full_path']);

                            $resizedImage = imageCreateTrueColor($proportionalWidth, $DESIRED_HEIGHT);

                            imageCopyResampled($resizedImage, $originalImage, 0, 0, 0, 0, $proportionalWidth + 1, $DESIRED_HEIGHT + 1, $imageWidth, $imageHeight);
                        }

                        imageJPEG($resizedImage, $resizedDestination);
                        $foto['rapat'] = $notulen_id;
                        $foto['_active'] = 1;
                        $foto['path'] = $uploadData['file_name'] . "_RESIZED.jpg";
                        $this->db->insert('notulen_foto', $foto);
                        unlink(FCPATH . "upload/notulen_foto/$filename");
                        imageDestroy($filename);
                    } else {
                        // $data['totalFiles'][] = $filename;
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode($error);
                    }
                }
            }
        }
        $persetujuan = $this->db->from('notulen_hasil_rapat')->where(['id'=>$this->input->post('id_notulen')])->get()->row();
        if($persetujuan->kirim == 1){
            redirect('persetujuan_notulen');
        }
        else{
            redirect('notulen');
        }
    }

    /**
     * Preview notulen
     *
     * @AclName Preview notulen
     */
    public function preview_notulen($id)
    {
        //preview_notulen sebelum diajukan atau ditandatangani oleh pimpinan
        $data_notulen = $this->db->select('not.*')
            ->from('notulen_hasil_rapat not')
            ->where(['not.id' => $id])->get()->row();
        $images = $this->db->select('foto.path')
            ->from('notulen_foto foto')
            ->where(['_active' => 1, 'rapat' => $id])->get()->result_array();
        $get_skpd_user = $this->db->select('skpd.id')->from('users u')->join('ref_skpd skpd', 'u.skpd_id=skpd.id', 'left')->where(['u.id' => $data_notulen->id_notulis])->get()->row();
        $skpd_id = $this->Mskpdkode->get_skpd_id($data_notulen->skpd_id);
        $skpd = $this->Mskpdkode->get_by_id($skpd_id);
        // echo json_encode($peserta);die;
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        // $mpdf->AddPage('P');
        if ($data_notulen->cek_peserta == 1) {
            $peserta = $data_notulen->list_peserta;
        } else {
            $peserta = $this->Dt_peserta->get_peserta($id);
        }
        $data = [
            'OPD' => $skpd->name,
            'alamat' => $skpd->address,
            'telp' => $skpd->phone,
            'fax' => $skpd->fax,
            'no_surat' => $data_notulen->no_surat,
            'opd_pengundang' => $data_notulen->penyelenggara,
            'tgl_pelaksanaan' => $data_notulen->tgl_mulai == $data_notulen->tgl_selesai ? fdateindo($data_notulen->tgl_mulai) : fdateindo($data_notulen->tgl_mulai) . " - " . fdateindo($data_notulen->tgl_selesai),
            'waktu_pelaksanaan' => $data_notulen->jam_mulai . " - " . $data_notulen->jam_selesai,
            'tempat' => $data_notulen->tempat_rapat,
            'agenda' => $data_notulen->agenda_rapat,
            'hasil_rapat' => $data_notulen->hasil_rapat,
            'tgl_buat' => fdateindo($data_notulen->tgl_selesai),
            'nama_notulis' => $data_notulen->nama_notulis,
            'nip_notulis' => $data_notulen->nip_notulis,
            'materi' => $data_notulen->materi,
            'cek_peserta' => $data_notulen->cek_peserta,
            'peserta' => $peserta,
            'fotos' => $images
        ];
        $path_notulen = '/pdf/notulen/pdf/' . md5($data_notulen->id . $data_notulen->id_notulis) . ".pdf";
        // $this->load->view('notulen/v_cetak_notulen', $data);
        $mpdf->WriteHTML($this->load->view('notulen/v_cetak_notulen', $data, TRUE));
        $mpdf->Output("." . $path_notulen, "F");
        $path_output = base_url($path_notulen);
        echo json_encode($path_output);
    }
}

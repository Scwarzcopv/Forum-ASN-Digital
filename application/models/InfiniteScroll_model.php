<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InfiniteScroll_model extends CI_Model
{
    function notulen_peserta($limit, $start, $id_user, $keyword, $order)
    {
        // Total Seluruh Data
        $this->db->select('*')
            ->from('notulen_peserta a')
            ->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left')
            ->join('user c', 'a.users_id = c.id', 'left')
            ->where('c.id', $id_user);
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Search
        $this->db->select('*')
            ->from('notulen_peserta a')
            ->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left')
            ->join('user c', 'a.users_id = c.id', 'left')
            ->where('c.id', $id_user)
            ->group_start()
            ->like('no_surat', $keyword)
            ->or_like('agenda_rapat', $keyword)
            ->or_like('penyelenggara', $keyword)
            ->or_like('pimpinan_rapat', $keyword)
            ->or_like('tgl_mulai', $keyword)
            ->group_end();
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();

        // Total Data Search + Limit
        $this->db->select('*')
            ->from('notulen_peserta a')
            ->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left')
            ->join('user c', 'a.users_id = c.id', 'left')
            ->where('c.id', $id_user)
            ->group_start()
            ->like('no_surat', $keyword)
            ->or_like('agenda_rapat', $keyword)
            ->or_like('penyelenggara', $keyword)
            ->or_like('pimpinan_rapat', $keyword)
            ->or_like('tgl_mulai', $keyword)
            ->group_end()
            ->order_by('a.id', $order)
            ->limit($limit, $start);
        $query['3'] = $this->db->get();
        $query['num_rows_3'] = $query['3']->num_rows();
        return $query;
    }

    function forum($limit, $start, $id_user, $keyword, $order)
    {
        // Info user
        $this->db->select('*')
            ->from('user')
            ->where('id', $id_user);
        $user = $this->db->get()->row_array();
        // Jika user adalah admin
        if ($user['role_id'] <= 2) {
            // Total Seluruh Data
            $this->db->select('*')
                ->from('forum a')
                ->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left')
                ->where('b.id_notulis', $id_user);
            $query['1'] = $this->db->get();
            $query['num_rows_1'] = $query['1']->num_rows();

            // Total Data Search
            $this->db->select('*')
                ->from('forum a')
                ->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left')
                ->where('b.id_notulis', $id_user)
                ->group_start()
                ->like('no_surat', $keyword)
                ->or_like('agenda_rapat', $keyword)
                ->or_like('penyelenggara', $keyword)
                ->or_like('pimpinan_rapat', $keyword)
                ->or_like('tgl_mulai', $keyword)
                ->group_end();
            $query['2'] = $this->db->get();
            $query['num_rows_2'] = $query['2']->num_rows();

            // Total Data Search + Limit
            $this->db->select('*')
                ->from('forum a')
                ->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left')
                ->where('b.id_notulis', $id_user)
                ->group_start()
                ->like('no_surat', $keyword)
                ->or_like('agenda_rapat', $keyword)
                ->or_like('penyelenggara', $keyword)
                ->or_like('pimpinan_rapat', $keyword)
                ->or_like('tgl_mulai', $keyword)
                ->group_end()
                ->order_by('a.id', $order)
                ->limit($limit, $start);
            $query['3'] = $this->db->get();
            $query['num_rows_3'] = $query['3']->num_rows();
            return $query;
        } else { // Jika user selain admin
            // Total Seluruh Data
            $this->db->select('*')
                ->from('forum_access a')
                ->join('forum b', 'a.id_forum = b.id', 'left')
                ->where('b.forum_active', 1)
                ->join('notulen_hasil_rapat c', 'a.id_forum = c.id', 'left')
                ->where('a.id_user', $id_user);
            $query['1'] = $this->db->get();
            $query['num_rows_1'] = $query['1']->num_rows();

            // Total Data Search
            $this->db->select('*')
                ->from('forum_access a')
                ->join('forum b', 'a.id_forum = b.id', 'left')
                ->where('b.forum_active', 1)
                ->join('notulen_hasil_rapat c', 'a.id_forum = c.id', 'left')
                ->where('a.id_user', $id_user)
                ->group_start()
                ->like('no_surat', $keyword)
                ->or_like('agenda_rapat', $keyword)
                ->or_like('penyelenggara', $keyword)
                ->or_like('pimpinan_rapat', $keyword)
                ->or_like('tgl_mulai', $keyword)
                ->group_end();
            $query['2'] = $this->db->get();
            $query['num_rows_2'] = $query['2']->num_rows();

            // Total Data Search + Limit
            $this->db->select('*')
                ->from('forum_access a')
                ->join('forum b', 'a.id_forum = b.id', 'left')
                ->where('b.forum_active', 1)
                ->join('notulen_hasil_rapat c', 'a.id_forum = c.id', 'left')
                ->where('a.id_user', $id_user)
                ->group_start()
                ->like('no_surat', $keyword)
                ->or_like('agenda_rapat', $keyword)
                ->or_like('penyelenggara', $keyword)
                ->or_like('pimpinan_rapat', $keyword)
                ->or_like('tgl_mulai', $keyword)
                ->group_end()
                ->order_by('a.id', $order)
                ->limit($limit, $start);
            $query['3'] = $this->db->get();
            $query['num_rows_3'] = $query['3']->num_rows();
            return $query;
        }
    }

    function forum_diskusi($limit, $start, $id_forum)
    {
        // Total Seluruh Data
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.narasumber', 'a.created_at AS created_at_fp', 'a.approved', 'a.valid', 'a.deleted', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban',
                // Tabel Forum
                'b.*',
                // Tabel Forum Komen
                // 'c.*'
            ]
        );
        $this->db->from('forum_pertanyaan a');
        $this->db->join('forum b', 'a.id_forum = b.id', 'left');
        // $this->db->join('forum_comment c', 'a.id_forum = c.id_forum', 'left');
        $this->db->where('a.id_forum', $id_forum);
        $this->db->where('a.approved', 1);
        $this->db->where('a.valid', 1);
        $this->db->where('a.deleted', null);
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();
        // Total Data Limit
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.narasumber', 'a.created_at AS created_at_fp', 'a.approved', 'a.valid', 'a.deleted', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban',
                // Tabel Forum
                'b.*',
                // Tabel Forum Komen
                // 'c.*'
            ]
        );
        $this->db->from('forum_pertanyaan a');
        $this->db->join('forum b', 'a.id_forum = b.id', 'left');
        // $this->db->join('forum_comment c', 'a.id_forum = c.id_forum', 'left');
        $this->db->where('a.id_forum', $id_forum);
        $this->db->where('a.approved', 1);
        $this->db->where('a.valid', 1);
        $this->db->where('a.deleted', null);
        $this->db->order_by('a.total_like', 'DESC');
        $this->db->limit($limit, $start);
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();
        return $query;
    }

    function data_komentar($limit, $start, $id_forum, $id_forum_pertanyaan, $id_user, $role_id, $hidden_com, $del_com)
    {
        // Select id_user['role_id']
        $role_id = (int)$role_id;

        // Total Seluruh Data
        $this->db
            ->select('*')
            ->from('forum_comment')
            ->where('id_forum', $id_forum)
            ->where('id_forum_pertanyaan', $id_forum_pertanyaan);
        if ($role_id < 3) {
            if ($hidden_com === 'false') $this->db->where('forum_comment_hidden', null);
            if ($del_com === 'false') $this->db->where('forum_comment_del_by_user', null);
        }
        if ($role_id > 2) {
            $this->db
                ->where('forum_comment_hidden', null)
                ->where('forum_comment_del_by_user', null)
                ->or_where("(id_user ='" . $id_user . "' AND forum_comment_hidden = 1 AND id_forum = '" . $id_forum . "' AND id_forum_pertanyaan = '" . $id_forum_pertanyaan . "')", null, false);
        }
        $this->db->order_by('id', 'ASC');
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Limit
        $this->db
            ->select('*')
            ->from('forum_comment')
            ->where('id_forum', $id_forum)
            ->where('id_forum_pertanyaan', $id_forum_pertanyaan);
        if ($role_id < 3) {
            if ($hidden_com === 'false') $this->db->where('forum_comment_hidden', null);
            if ($del_com === 'false') $this->db->where('forum_comment_del_by_user', null);
        }
        if ($role_id > 2) {
            $this->db
                ->where('forum_comment_hidden', null)
                ->where('forum_comment_del_by_user', null)
                ->or_where("(id_user = '" . $id_user . "' AND forum_comment_hidden = 1 AND id_forum = '" . $id_forum . "' AND id_forum_pertanyaan = '" . $id_forum_pertanyaan . "')", null, false);
        }
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit, $start);
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();

        return $query;
    }

    function data_pertanyaan_pending($limit, $start, $id_forum, $narasumber_key, $admin_notulen, $id_user)
    {
        // Total Seluruh Data
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.narasumber', 'a.created_at AS created_at_fp', 'a.approved', 'a.valid', 'a.deleted', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban', 'a.id_anonim',
                // Tabel Forum
                'b.*',
                // Tabel Forum Komen
                // 'c.*'
            ]
        );
        $this->db->from('forum_pertanyaan a');
        $this->db->join('forum b', 'a.id_forum = b.id', 'left');
        // $this->db->join('forum_comment c', 'a.id_forum = c.id_forum', 'left');
        $this->db->where('a.id_forum', $id_forum);
        $this->db->where('a.approved', null);
        $this->db->where('a.valid', null);
        $this->db->where('a.deleted', null);
        $this->db->where('a.narasumber', $narasumber_key);
        if ($admin_notulen == false) {
            $this->db->where('a.id_user_tanya', $id_user);
        }
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Limit
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.narasumber', 'a.created_at AS created_at_fp', 'a.approved', 'a.valid', 'a.deleted', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban', 'a.id_anonim',
                // Tabel Forum
                'b.*',
                // Tabel Forum Komen
                // 'c.*'
            ]
        );
        $this->db->from('forum_pertanyaan a');
        $this->db->join('forum b', 'a.id_forum = b.id', 'left');
        // $this->db->join('forum_comment c', 'a.id_forum = c.id_forum', 'left');
        $this->db->where('a.id_forum', $id_forum);
        $this->db->where('a.approved', null);
        $this->db->where('a.valid', null);
        $this->db->where('a.deleted', null);
        $this->db->where('a.narasumber', $narasumber_key);
        if ($admin_notulen == false) {
            $this->db->where('a.id_user_tanya', $id_user);
        }
        $this->db->order_by('a.id', 'ASC');
        $this->db->limit($limit, $start);
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();
        return $query;
    }
    function data_pertanyaan_excPending($limit, $start, $id_forum, $pane, $admin_notulen, $id_user)
    {
        // =========== Total Seluruh Data ===========
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.narasumber', 'a.created_at AS created_at_fp', 'a.approved', 'a.valid', 'a.deleted', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban', 'a.id_anonim',
                // Tabel Forum
                'b.*',
            ]
        );
        $this->db->from('forum_pertanyaan a');
        $this->db->join('forum b', 'a.id_forum = b.id', 'left');
        $this->db->where('a.id_forum', $id_forum);
        // Data Approved
        if ($pane == 'approved') {
            $this->db->where('a.approved', 1)
                ->where('a.valid', null)
                ->where('a.deleted', null);
            if ($admin_notulen == false) {
                $this->db->where('a.id_user_tanya', $id_user);
            }
        }
        // Data Published
        if ($pane == 'published') {
            $this->db->where('a.valid', 1)
                ->where('a.deleted', null);
            if ($admin_notulen == false) {
                $this->db->where('a.id_user_tanya', $id_user);
            }
        }
        // Data Deleted
        if ($pane == 'deleted') {
            $this->db->where('a.deleted', 1);
            if ($admin_notulen == false) {
                $this->db->where('a.id_user_tanya', $id_user);
            }
        }
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // =========== Total Data Limit ===========
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.narasumber', 'a.created_at AS created_at_fp', 'a.approved', 'a.valid', 'a.deleted', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban', 'a.id_anonim',
                // Tabel Forum
                'b.*',
            ]
        );
        $this->db->from('forum_pertanyaan a');
        $this->db->join('forum b', 'a.id_forum = b.id', 'left');
        $this->db->where('a.id_forum', $id_forum);
        // Data Approved
        if ($pane == 'approved') {
            $this->db->where('a.approved', 1)
                ->where('a.valid', null)
                ->where('a.deleted', null);
            if ($admin_notulen == false) {
                $this->db->where('a.id_user_tanya', $id_user);
            }
        }
        // Data Published
        if ($pane == 'published') {
            $this->db->where('a.valid', 1)
                ->where('a.deleted', null);
            if ($admin_notulen == false) {
                $this->db->where('a.id_user_tanya', $id_user);
            }
        }
        // Data Deleted
        if ($pane == 'deleted') {
            $this->db->where('a.deleted', 1);
            if ($admin_notulen == false) {
                $this->db->where('a.id_user_tanya', $id_user);
            }
        }
        $this->db->order_by('a.id', 'ASC');
        $this->db->limit($limit, $start);
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();
        return $query;
    }
}

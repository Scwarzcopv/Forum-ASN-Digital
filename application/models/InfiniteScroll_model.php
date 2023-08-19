<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InfiniteScroll_model extends CI_Model
{
    function notulen_peserta($limit, $start, $id_user, $keyword, $order)
    {
        // Total Seluruh Data
        $this->db->select('*');
        $this->db->from('notulen_peserta a');
        $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
        $this->db->join('user c', 'a.users_id = c.id', 'left');
        $this->db->where('c.id', $id_user);
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Search
        $this->db->select('*');
        $this->db->from('notulen_peserta a');
        $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
        $this->db->join('user c', 'a.users_id = c.id', 'left');
        $this->db->where('c.id', $id_user);
        $this->db->group_start();
        $this->db->like('no_surat', $keyword);
        $this->db->or_like('agenda_rapat', $keyword);
        $this->db->or_like('penyelenggara', $keyword);
        $this->db->or_like('pimpinan_rapat', $keyword);
        $this->db->or_like('tgl_mulai', $keyword);
        $this->db->group_end();
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();

        // Total Data Search + Limit
        $this->db->select('*');
        $this->db->from('notulen_peserta a');
        $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
        $this->db->join('user c', 'a.users_id = c.id', 'left');
        $this->db->where('c.id', $id_user);
        $this->db->group_start();
        $this->db->like('no_surat', $keyword);
        $this->db->or_like('agenda_rapat', $keyword);
        $this->db->or_like('penyelenggara', $keyword);
        $this->db->or_like('pimpinan_rapat', $keyword);
        $this->db->or_like('tgl_mulai', $keyword);
        $this->db->group_end();
        $this->db->order_by('a.id', $order);
        $this->db->limit($limit, $start);
        $query['3'] = $this->db->get();
        $query['num_rows_3'] = $query['3']->num_rows();
        return $query;
    }

    function forum($limit, $start, $id_user, $keyword, $order)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id_user);
        $user = $this->db->get()->row_array();
        if ($user['role_id'] <= 2) {
            // Total Seluruh Data
            $this->db->select('*');
            $this->db->from('forum a');
            $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
            $query['1'] = $this->db->get();
            $query['num_rows_1'] = $query['1']->num_rows();

            // Total Data Search
            $this->db->select('*');
            $this->db->from('forum a');
            $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
            $this->db->group_start();
            $this->db->like('no_surat', $keyword);
            $this->db->or_like('agenda_rapat', $keyword);
            $this->db->or_like('penyelenggara', $keyword);
            $this->db->or_like('pimpinan_rapat', $keyword);
            $this->db->or_like('tgl_mulai', $keyword);
            $this->db->group_end();
            $query['2'] = $this->db->get();
            $query['num_rows_2'] = $query['2']->num_rows();

            // Total Data Search + Limit
            $this->db->select('*');
            $this->db->from('forum a');
            $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
            $this->db->group_start();
            $this->db->like('no_surat', $keyword);
            $this->db->or_like('agenda_rapat', $keyword);
            $this->db->or_like('penyelenggara', $keyword);
            $this->db->or_like('pimpinan_rapat', $keyword);
            $this->db->or_like('tgl_mulai', $keyword);
            $this->db->group_end();
            $this->db->order_by('a.id', $order);
            $this->db->limit($limit, $start);
            $query['3'] = $this->db->get();
            $query['num_rows_3'] = $query['3']->num_rows();
            return $query;
        } else {
            // Total Seluruh Data
            $this->db->select('*');
            $this->db->from('forum_access a');
            $this->db->join('forum b', 'a.id_forum = b.id', 'left');
            $this->db->where('b.forum_active', 1);
            $this->db->join('notulen_hasil_rapat c', 'a.id_forum = c.id', 'left');
            $this->db->where('a.id_user', $id_user);
            $query['1'] = $this->db->get();
            $query['num_rows_1'] = $query['1']->num_rows();

            // Total Data Search
            $this->db->select('*');
            $this->db->from('forum_access a');
            $this->db->join('forum b', 'a.id_forum = b.id', 'left');
            $this->db->where('b.forum_active', 1);
            $this->db->join('notulen_hasil_rapat c', 'a.id_forum = c.id', 'left');
            $this->db->where('a.id_user', $id_user);
            $this->db->group_start();
            $this->db->like('no_surat', $keyword);
            $this->db->or_like('agenda_rapat', $keyword);
            $this->db->or_like('penyelenggara', $keyword);
            $this->db->or_like('pimpinan_rapat', $keyword);
            $this->db->or_like('tgl_mulai', $keyword);
            $this->db->group_end();
            $query['2'] = $this->db->get();
            $query['num_rows_2'] = $query['2']->num_rows();

            // Total Data Search + Limit
            $this->db->select('*');
            $this->db->from('forum_access a');
            $this->db->join('forum b', 'a.id_forum = b.id', 'left');
            $this->db->where('b.forum_active', 1);
            $this->db->join('notulen_hasil_rapat c', 'a.id_forum = c.id', 'left');
            $this->db->where('a.id_user', $id_user);
            $this->db->group_start();
            $this->db->like('no_surat', $keyword);
            $this->db->or_like('agenda_rapat', $keyword);
            $this->db->or_like('penyelenggara', $keyword);
            $this->db->or_like('pimpinan_rapat', $keyword);
            $this->db->or_like('tgl_mulai', $keyword);
            $this->db->group_end();
            $this->db->order_by('a.id', $order);
            $this->db->limit($limit, $start);
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
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.created_at AS created_at_fp', 'a.valid', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban',
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
        $this->db->where('a.valid', 1);
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();
        // Total Data Limit
        $this->db->select(
            [
                // Tabel Forum Pertanyaan
                'a.id AS id_fp', 'a.id_forum', 'a.id_user_tanya', 'a.isi_pertanyaan', 'a.created_at AS created_at_fp', 'a.valid', 'a.id_admin', 'a.isi_jawaban', 'a.answered_at', 'a.updated_at AS updated_at_fp', 'a.total_like AS total_like_fp', 'a.total_like_jawaban',
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
        $this->db->where('a.valid', 1);
        $this->db->order_by('a.total_like', 'DESC');
        $this->db->limit($limit, $start);
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();
        return $query;
    }

    function data_komentar($limit, $start, $id_forum, $id_forum_pertanyaan)
    {
        // Total Seluruh Data
        $this->db->select('*');
        $this->db->from('forum_comment');
        $this->db->where('id_forum', $id_forum);
        $this->db->where('id_forum_pertanyaan', $id_forum_pertanyaan);
        $this->db->order_by('id', 'ASC');
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Limit
        $this->db->select('*');
        $this->db->from('forum_comment');
        $this->db->where('id_forum', $id_forum);
        $this->db->where('id_forum_pertanyaan', $id_forum_pertanyaan);
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit, $start);
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();

        return $query;
    }
}

<?php
function is_forum_active()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('login');
    } else {
        // $role_id = $ci->session->userdata('role_id');
        $id_forum = $ci->uri->segment(3);
        $id_forum = (int)$id_forum;

        $queryForum = $ci->db->get_where('forum', ['id' => $id_forum]);

        if ($queryForum->num_rows() > 0) {
            $forumAccess = $queryForum->row_array();
            if ($forumAccess['forum_active'] != 1) {
                redirect('login/blocked');
            }
        } else {
            // redirect('login/notfound');
        }
    }
}

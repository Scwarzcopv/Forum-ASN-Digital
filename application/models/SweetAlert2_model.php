<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SweetAlert2_model extends CI_Model
{
    public function sweetAlert2Toast($title, $icon)
    {
        $this->session->set_flashdata('message', '
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                // didOpen: (toast) => {
                //     toast.addEventListener("mouseenter", Swal.stopTimer)
                //     toast.addEventListener("mouseleave", Swal.resumeTimer)
                // }
            })

            Toast.fire({
                title: "' . $title . '",
                icon: "' . $icon . '"
            })
        </script>
        ');
    }
}

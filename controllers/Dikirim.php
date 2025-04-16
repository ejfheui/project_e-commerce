<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dikirim extends CI_Controller
{
    public function di_kirim()
    {
        $data['title'] = 'Barang Dikemas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/di_kirim', $data);
        $this->load->view('templates/footer');
    }

}



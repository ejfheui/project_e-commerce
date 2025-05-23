<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaStok extends CI_Controller
{
    
    public function kelola_stok()
    {
        $data['title'] = 'Kelola stok';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManagementProduk/kelola_stok', $data);
        $this->load->view('templates/footer');
    }

}
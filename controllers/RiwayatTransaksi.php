<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RiwayatTransaksi extends CI_Controller
{

    public function riwayat_transaksi()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('seller/riwayat_transaksi', $data);
        $this->load->view('templates/footer');
    }

}



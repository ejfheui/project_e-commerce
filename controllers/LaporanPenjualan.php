<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPenjualan extends CI_Controller
{
    public function laporan_penjualan()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporan_penjualan', $data);
        $this->load->view('templates/footer');
    }

}

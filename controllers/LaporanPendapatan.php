<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPendapatan extends CI_Controller
{
    public function laporan_pendapatan()
    {
        $data['title'] = 'Laporan Pendapatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporan_pendapatan', $data);
        $this->load->view('templates/footer');
    }

}

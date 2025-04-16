<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email') || $this->session->userdata('role_id') != 3) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard Seller';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('seller/index', $data);
        $this->load->view('templates/footer');
    }
}

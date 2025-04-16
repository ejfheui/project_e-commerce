<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataUser extends CI_Controller
{
    public function data_user()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('MenuLainya/data_user', $data);
        $this->load->view('templates/footer');
    }

}

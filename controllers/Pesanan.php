<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pesanan_model');
    }

    public function pesanan_for_user()
    {
        $data['title'] = 'Pesanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->Pesanan_model->get_all_pesanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('MenuLainya/pesanan_for_user', $data);
        $this->load->view('templates/footer');
    }

    public function approve($id_checkout)
    {
        // Cek apakah id_checkout valid
        if (!$id_checkout) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">ID Checkout tidak valid!</div>');
            redirect('Pesanan/pesanan_for_user');
        }

        // Update status di database lewat model
        $this->db->where('id_checkout', $id_checkout);
        $this->db->update('checkout', ['status' => 'diterima']); // atau 'approved' sesuai kebutuhanmu

        // Flash message
        $this->session->set_flashdata('message', '<div class="alert alert-success">Pesanan berhasil disetujui!</div>');

        // Redirect balik ke halaman pesanan
        redirect('Pesanan/pesanan_for_user');
    }

}


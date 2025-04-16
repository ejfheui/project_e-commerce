<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TambahAlamat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TambahAlamat_model');
        $this->load->model('Checkout_model');
    }

    public function tambah_alamat()
    {
        $data['title'] = 'Tambah Alamat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['alamat'] = $this->TambahAlamat_model->get_all_alamat();
        $data['checkout'] = $this->db->get('checkout')->row_array(); // Ambil data checkout

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tambah_alamat', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data = [
            'alamat' => $this->input->post('alamat'),
            'alamat_rumah' => $this->input->post('alamat_rumah'),
            'detail_alamat' => $this->input->post('detail_alamat'),
            'id_checkout' => $this->input->post('id_checkout')
        ];

        $this->TambahAlamat_model->insert_alamat($data);
        $this->session->set_flashdata('message', 'Alamat berhasil ditambahkan!');
        redirect('TambahAlamat/tambah_alamat');
    }

    public function hapus($id)
    {
        $this->TambahAlamat_model->delete_alamat($id);
        $this->session->set_flashdata('message', 'Alamat berhasil dihapus!');
        redirect('TambahAlamat/tambah_alamat');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarProduk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KelolaProduk_model');
        $this->load->model('KategoriProduk_model');
    }
   
    public function daftar_produk()
    {
        $data['title'] = 'Daftar Produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['produk'] = $this->KelolaProduk_model->get_all_KelolaProduk();
        $data['kategori'] = $this->KategoriProduk_model->getAllKategori(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManagementProduk/daftar_produk', $data);
        $this->load->view('templates/footer');
    }

}
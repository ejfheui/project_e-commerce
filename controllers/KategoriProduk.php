<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriProduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KategoriProduk_model');
    }

    public function kategori_produk()
    {
        $data['title'] = 'Kategori Produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->KategoriProduk_model->getAllKategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Menu/kategori_produk', $data);
        $this->load->view('templates/footer');
    }

    public function addKategori()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori'),
        ];
        $this->KategoriProduk_model->addKategori($data);
        
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data produk berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('KategoriProduk/kategori_produk');
    }

    public function editKategori()
    {
        $id_kategori = $this->input->post('id_kategori');
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];
        $this->KategoriProduk_model->editKategori($id_kategori, $data);

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-3"></i> Data kategori berhasil diupdate!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('KategoriProduk/kategori_produk');
    }


    public function deleteKategori($id)
    {
        $this->KategoriProduk_model->deleteKategori($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-3"></i> Data produk berhasil dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('KategoriProduk/kategori_produk');
    }

}

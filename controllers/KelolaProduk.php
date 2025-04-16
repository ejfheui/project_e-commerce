<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaProduk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KelolaProduk_model');
        $this->load->model('KategoriProduk_model');
    }

    public function kelola_produk()
    {
        $data['title'] = 'Tambah Produk Baru';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->KelolaProduk_model->getAllProduk();
        $data['kategori'] = $this->KategoriProduk_model->getAllKategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManagementProduk/kelola_produk', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $config['upload_path']   = './assets/img/gambarProduk/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('foto')) {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi'),
                'foto' => $this->upload->data('file_name'),
                'id_kategori' => $this->input->post('id_kategori'),
                'tanggal' => date('Y-m-d')
            ];
    
            $varian = $this->input->post('varian');
            $stok_varian = $this->input->post('stok_varian');
            $varian_tambahan = $this->input->post('varian_tambahan');             
            $harga_varian = $this->input->post('harga_varian');
            $stok_warna_varian = $this->input->post('stok_warna_varian');

            $this->KelolaProduk_model->addProduk($data, $varian, $stok_varian, $varian_tambahan, $harga_varian, $stok_warna_varian);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-3"></i> Data produk berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }
        redirect('KelolaProduk/kelola_produk');
    }
    
    public function edit($id)
    {
        $config['upload_path']   = './assets/img/gambarProduk/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);
    
        if (!empty($_FILES['foto']['name']) && $this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
        } else {
            $foto = $this->input->post('foto'); 
        }
        
        // Data produk yang akan diupdate
        $data = [
            'nama_produk' => $this->input->post('nama_produk'),
            'harga' => $this->input->post('harga'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto' => $foto,  // Gunakan foto yang baru atau lama
            'id_kategori' => $this->input->post('id_kategori'),
            'tanggal' => date('Y-m-d') // opsional, bisa disesuaikan
        ];
    
        // Data varian
        $varian = $this->input->post('varian');
        $stok_varian = $this->input->post('stok_varian');
        $varian_tambahan = $this->input->post('varian_tambahan');
        $harga_varian = $this->input->post('harga_varian');
        $stok_warna_varian = $this->input->post('stok_warna_varian');
    
        // Update produk dan varian
        $this->KelolaProduk_model->updateProduk($id, $data);
        $this->KelolaProduk_model->updateVarianProduk($id, $varian, $stok_varian, $varian_tambahan, $harga_varian, $stok_warna_varian);
    
        // Set pesan sukses
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data produk berhasil diperbarui!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        
        redirect('KelolaProduk/kelola_produk');
    }
    
    public function delete($id)
    {
        $deleted = $this->KelolaProduk_model->deleteProduk($id);
    
        if ($deleted) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk.');
        }
    
        redirect('KelolaProduk/kelola_produk');
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data berhasil terhapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ');
    }    

    public function filterProduk()
    {
        $kategori_id = $this->input->post('id_kategori');
        $produk = $this->KelolaProduk_model->getProdukByKategori($kategori_id);

        $data['produk'] = $produk;
        $this->load->view('ManagementProduk/produk_list', $data); // Buat file partial view untuk menampilkan produk
    }

}
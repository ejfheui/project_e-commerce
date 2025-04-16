<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Checkout_model');
        $this->load->model('JasaKirim_model');
    }

    public function checkout_barang()
    {
        $data['title'] = 'Checkout';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil hanya produk yang dipilih
        $data['checkout_cart'] = $this->session->userdata('checkout_cart');
        $data['jasa_kirim'] = $this->JasaKirim_model->getAllJasaKirim();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/checkout_barang', $data);
        $this->load->view('templates/footer');
    }

    public function proses_checkout()
    {
        $data_checkout = [
            'nama_lengkap' => $this->input->post('nama_lengkap', true),
            'alamat'       => $this->input->post('alamat', true),
            'detail_alamat'=> $this->input->post('detail_alamat', true),
            'alamat_rumah' => $this->input->post('alamat_rumah', true),
            'no_telepon'   => $this->input->post('no_telepon', true),
            'id_kelola'    => $this->input->post('id_kelola', true)
        ];

        // Simpan ke tabel checkout
        $this->db->insert('checkout', $data_checkout);
        $id_checkout = $this->db->insert_id(); // ambil ID checkout barusan

        // Masukkan ke tabel pesanan
        $data_pesanan = [
            'id_checkout'   => $id_checkout,
            'id_kelola'     => $data_checkout['id_kelola'],
            'nama_lengkap'  => $data_checkout['nama_lengkap'],
            'alamat'        => $data_checkout['alamat'],
            'detail_alamat' => $data_checkout['detail_alamat'],
            'alamat_rumah'  => $data_checkout['alamat_rumah'],
            'no_telepon'    => $data_checkout['no_telepon'],
            'status'        => 'pending' 
        ];

        $this->db->insert('pesanan', $data_pesanan);

        // Simpan data sementara di session kalau perlu
        $this->session->set_userdata('checkout', $data_checkout);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Checkout berhasil. Menunggu konfirmasi dari seller.</div>');

        redirect('Checkout/checkout_barang'); 
    }
}
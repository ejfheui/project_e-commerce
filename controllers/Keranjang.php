<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KelolaProduk_model');
        $this->load->model('KategoriProduk_model');
    }

   
    public function keranjang_pembelian()
    {
        $data['title'] = 'Keranjang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->KategoriProduk_model->getAllKategori();
        $data['produk'] = $this->KelolaProduk_model->getAllProduk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/keranjang_pembelian', $data);
        $this->load->view('templates/footer');
    }

    public function add_to_cart()
    {
        // Ambil data dari POST request
        $id_produk   = $this->input->post('id_produk');
        $nama_produk = $this->input->post('nama_produk');
        $harga       = $this->input->post('harga');
        $qty         = $this->input->post('qty') ?? 1;

        // Validasi data
        if (!$id_produk || !$nama_produk || !$harga) {
            echo json_encode(['status' => 'error', 'message' => 'Data produk tidak lengkap.']);
            return;
        }

        // Ambil data produk dari database (misalnya untuk mengambil foto)
        $produk = $this->KelolaProduk_model->get_product_by_id($id_produk);
        $foto   = $produk ? $produk['foto'] : null;

        // Siapkan data produk baru
        $new_product = [
            'id_produk'   => $id_produk,
            'nama_produk' => $nama_produk,
            'harga'       => $harga,
            'foto'        => $foto,
            'qty'         => $qty
        ];

        // Ambil keranjang dari session
        $cart = $this->session->userdata('cart') ?? [];

        // Cek apakah produk sudah ada di keranjang
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id_produk'] == $id_produk) {
                $item['qty'] += $qty;
                $found = true;
                break;
            }
        }

        // Jika belum ada, tambahkan ke keranjang
        if (!$found) {
            $cart[] = $new_product;
        }

        // Simpan kembali ke session
        $this->session->set_userdata('cart', $cart);

        // Hitung total item
        $cart_total = array_sum(array_column($cart, 'qty'));

        // Kirim respons JSON
        echo json_encode([
            'status'     => 'success',
            'message'    => 'Produk berhasil ditambahkan ke keranjang.',
            'cart_total' => $cart_total
        ]);
    }

    public function remove_from_cart()
    {
        // Ambil data ID produk dari POST
        $id_produk = $this->input->post('id_produk');

        // Ambil data keranjang dari session
        $cart = $this->session->userdata('cart');

        // Jika keranjang ada
        if ($cart) {
            foreach ($cart as $key => $item) {
                // Cari produk berdasarkan ID
                if ($item['id_produk'] == $id_produk) {
                    unset($cart[$key]); // Hapus produk dari keranjang
                    break;
                }
            }

            // Simpan kembali data keranjang ke session
            $this->session->set_userdata('cart', $cart);

            // Hitung total item di keranjang
            $cart_total = array_sum(array_column($cart, 'qty'));

            echo json_encode(['status' => 'success', 'message' => 'Produk berhasil dihapus.', 'cart_total' => $cart_total]);
            return;
        }

        echo json_encode(['status' => 'error', 'message' => 'Keranjang kosong atau produk tidak ditemukan.']);
    }

    public function proses_checkout()
    {
        $selected_items = $this->input->post('selected_items');

        if (!$selected_items) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Pilih minimal satu produk untuk checkout.</div>');
            redirect('Keranjang/keranjang_pembelian');
        }

        $cart = $this->session->userdata('cart');
        $checkout_items = [];

        foreach ($cart as $item) {
            if (in_array($item['id_produk'], $selected_items)) {
                $checkout_items[] = $item;
            }
        }

        // Simpan produk yang dipilih ke session untuk checkout
        $this->session->set_userdata('checkout_cart', $checkout_items);

        // Arahkan ke halaman checkout
        redirect('Checkout/checkout_barang');
    }

}
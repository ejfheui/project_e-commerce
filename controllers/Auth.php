<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    // Halaman login
    public function index() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Mohon alamat email harus terisi!',
            'valid_email' => 'Format email tidak valid!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Mohon kata sandi harus terisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // Jika validasi sukses, jalankan fungsi login
            $this->_login();
        }
    }

    private function _login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Ambil data user berdasarkan email
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) { // Cek apakah akun aktif
                if (password_verify($password, $user['password'])) { // Cek password
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    // Redirect berdasarkan role
                    switch ($user['role_id']) {
                        case 1: redirect('admin'); break;
                        case 2: redirect('user'); break;
                        case 3: redirect('seller'); break;
                        default: redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Akun belum aktif. Silakan aktivasi terlebih dahulu!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    // Pendaftaran user
    public function registration() {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim', ['required' => 'Nama harus diisi!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Format email tidak valid!',
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Kata sandi tidak cocok!',
            'min_length' => 'Kata sandi minimal 6 karakter!',
            'required' => 'Kata sandi harus diisi!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran User';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2, // User
                'is_active' => 0, // Butuh aktivasi
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Pendaftaran berhasil! Silakan login.</div>');
            redirect('auth');
        }
    }

    // Pendaftaran Seller
    public function registration_seller() {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim', ['required' => 'Nama harus diisi!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Format email tidak valid!',
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Kata sandi tidak cocok!',
            'min_length' => 'Kata sandi minimal 4 karakter!',
            'required' => 'Kata sandi harus diisi!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('ktp', 'Nomor KTP', 'required|trim|min_length[10]|max_length[10]', [
            'required' => 'Nomor KTP harus diisi!',
            'min_length' => 'Nomor KTP harus 10 digit!',
            'max_length' => 'Nomor KTP harus 10 digit!'
        ]);
        $this->form_validation->set_rules('toko', 'Nama Toko', 'required|trim', ['required' => 'Nama toko harus diisi!']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran Seller';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration_seller');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3, // Seller
                'is_active' => 0, // Butuh verifikasi admin
                'date_created' => time(),
                'ktp' => htmlspecialchars($this->input->post('ktp', true)),
                'toko' => htmlspecialchars($this->input->post('toko', true))
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Pendaftaran berhasil! Tunggu verifikasi admin.</div>');
            redirect('auth');
        }
    }

    // Logout
    public function logout() {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-info">Anda telah logout.</div>');
        redirect('auth');
    }

    // Halaman akses ditolak
    public function blocked() {
        $this->load->view('auth/blocked');
    }
}

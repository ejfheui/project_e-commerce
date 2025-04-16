<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KelolaProduk_model');
        $this->load->model('KategoriProduk_model');
    }
   
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['produk'] = $this->KelolaProduk_model->getAllProduk();
        $data['kategori'] = $this->KategoriProduk_model->getAllKategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_beranda', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
    
            // Cek apakah ada gambar baru yang diunggah
            $upload_image = $_FILES['image']['name'];
    
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile/';
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('image')) {
                    // Hapus gambar lama jika bukan default
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    // Simpan nama gambar baru
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
    
                    // **Perbarui session agar sidebar juga ikut berubah**
                    $this->session->set_userdata('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
    
            // Update nama di database
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
    
            // **Perbarui session agar sidebar juga ikut berubah**
            $this->session->set_userdata('name', $name);
    
            $this->session->set_flashdata('message', '<div class="alert alert-success">Profile updated successfully!</div>');
            redirect('user/edit');
        }
    }    

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function update_avatar()
    {
        $avatar = $this->input->post('avatar');
        
        if ($avatar) {
            $this->db->set('image', $avatar);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');
    
            $this->session->set_userdata('image', $avatar);  // Update session image
        }
    }    

}
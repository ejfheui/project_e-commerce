<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditProfileSeller extends CI_Controller
{
    public function edit_profile_seller()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('seller/edit_profile_seller', $data);
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
            redirect('EditProfileSeller/edit_profile_seller');
        }
    }    
}
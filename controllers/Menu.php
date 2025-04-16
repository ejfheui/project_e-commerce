<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-3"></i> Data berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('menu');
        }
    }

    public function editMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i> gagal mengedit menu!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('menu');
        } else {
            $data = ['menu' => $this->input->post('menu')];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_menu', $data);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> berhasil mengedit menu!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }
    }

    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> Data berhasil terhapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('menu');
    }



    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> berhasil menambahkan data submenu!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('menu/submenu');
        }
    }

    public function editSubMenu()
    {
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);

        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> berhasil mengedit menu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('menu/submenu');
    }

    public function deleteSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> berhasil menghapus menu!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('menu/submenu');
    }    

    public function getDataMenu(){
        $data = $this->menuModel->getMenu();
        echo json_encode(['data' => $data]);
    }
}
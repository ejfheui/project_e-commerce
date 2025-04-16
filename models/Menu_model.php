<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    public function getSubMenu1()
    {
        $this->db->select('user_sub_menu.*, user_menu.menu');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
        return $this->db->get()->result_array();
    }
    
}
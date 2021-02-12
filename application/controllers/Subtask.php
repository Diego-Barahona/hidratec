<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subtask extends CI_Controller
{
    public function adminSubtask()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('admin/header');
            $this->load->view('admin/adminSubtask');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Component extends CI_Controller
{
    public function adminComponent()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('admin/header');
            $this->load->view('admin/adminComponent');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }
}

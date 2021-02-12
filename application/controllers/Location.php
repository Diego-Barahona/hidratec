<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location extends CI_Controller
{
    public function adminLocation()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('admin/header');
            $this->load->view('admin/adminLocation');
            $this->load->view('admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }
}

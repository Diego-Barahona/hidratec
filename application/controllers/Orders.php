<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function adminOrders()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/super_admin/header');
            $this->load->view('admin/adminOrders');
            $this->load->view('shared/super_admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }


    public function newOrder()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/super_admin/header');
            $this->load->view('admin/registerOrder');
            $this->load->view('shared/super_admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }





    public function stagesOrder()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/super_admin/header');
            $this->load->view('admin/stagesOrder');
            $this->load->view('shared/super_admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }
}


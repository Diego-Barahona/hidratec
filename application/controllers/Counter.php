<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Counter extends CI_Controller
{
    public function counterOrders()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/super_admin/header');
            $this->load->view('admin/counterOrders');
            $this->load->view('shared/super_admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }


    public function getData()
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('CounterModel');
            $datos = $this->CounterModel->getDataCounter();
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kpi extends CI_Controller
{
    public function menuKpi()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerSuperAdmin');
            $this->load->view('admin/menu_kpi');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }


    public function kpiQuotation()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerSuperAdmin');
            $this->load->view('admin/kpiQuotation');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }



    }

    public function kpiProduction()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerSuperAdmin');
            $this->load->view('admin/kpiProduction');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }

    }

    public function periodFilterQuotation()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            $this->load->model('KpiModel');
            if($res=$this->KpiModel->kpiQuotation($data)){
                $this->response->sendJSONResponse($res);
            }else{
                $this->response->sendJSONResponse(array('err'=>"No se ha encontrado la información."), 400);
            }
        } else {
            redirect('Home/login', 'refresh');
        }

    }

    public function periodFilterProduction()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            $this->load->model('KpiModel');
            if($res=$this->KpiModel->kpiProduction($data)){
                $this->response->sendJSONResponse($res);
            }else{
                $this->response->sendJSONResponse(array('err'=>"No se ha encontrado la información."), 400);
            }
        } else {
            redirect('Home/login', 'refresh');
        }

    }


    










    



    







    
}

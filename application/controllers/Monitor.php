<?php


defined('BASEPATH') or exit('No direct script access allowed');
class Monitor extends CI_Controller {

public function __construct(){
    parent:: __construct(); 
}

   public function viewProjector()

    { 
    
        if ($this->accesscontrol->checkAuth()['correct']) {
 
            $this->load->view('admin/projector');
 
        } else {
           redirect('Home/login', 'refresh');
        }
    }




    public function chartQuotation(){

        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('ProjectorModel');
            $datos = $this->ProjectorModel->getKpiQuotation();
            $this->response->sendJSONResponse($datos);

        } else {

            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }


    public function chartProduction(){
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('ProjectorModel');
            $datos = $this->ProjectorModel->getKpiProduction();
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    public function getOrders(){
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('ProjectorModel');
            $orders = $this->ProjectorModel->getOrders();
       
            $this->response->sendJSONResponse($orders);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }












}

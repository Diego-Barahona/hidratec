<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TechnicalMaster extends CI_Controller
{


    public function adminHydraulicTest()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerTechnicalMaster');
            $this->load->view('TechnicalMaster/HydraulicTestList');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function hydraylicTestForm()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $url = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url['query'], $params);
            $id = $params['ot'];
            $this->load->view('shared/headerTechnicalMaster');
            $this->load->view('TechnicalMaster/hydraulicTest.php',array ('id'=> $id));
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }


    public function  getHydraulicTestEnable() { 
       
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('TechnicalMasterModel');
         if($res=$this->TechnicalMasterModel->getHydraulicTestEnable()){
             $this->response->sendJSONResponse($res); 
           }else{
             $this->response->sendJSONResponse(array('msg' => 'No se ha podido obtener los datos.'), 400); 
           }
           }else{
             $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
           }
    }
    
}

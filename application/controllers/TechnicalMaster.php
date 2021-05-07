<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TechnicalMaster extends CI_Controller
{
    public function __construct(){
		parent:: __construct(); 
		$this->load->model('TechnicalMasterModel');
	}

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

    public function adminTechnicalReport()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerTechnicalMaster');
            $this->load->view('TechnicalMaster/technicalReportList');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function getTechnicalReports() { 
       
        if ($this->accesscontrol->checkAuth()['correct']) {
            if($res=$this->TechnicalMasterModel->getTechnicalReports()){
                $this->response->sendJSONResponse($res); 
            }else{
                //No hay informes tecnicos asociados al tecnico master
                $this->response->sendJSONResponse(false); 
            }
        }else{
             $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    }   

    public function adminViewTechnicalReport($number_ot)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $order['number_ot'] = $number_ot;
            $this->load->view('shared/headerTechnicalMaster');
            $this->load->view('TechnicalMaster/technicalReport', $order);
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function DetailsTechnicalReport($id)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            if($report=$this->TechnicalMasterModel->getTechnicalReportByOrder($id)){
                $this->response->sendJSONResponse($report); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'Esta orden no tiene configurado un reporte técnico.'), 400); 
            }
        }else {
			redirect('Home/login', 'refresh');
        }
    }

    public function EditTechnicalReport()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            if($report=$this->TechnicalMasterModel->getTechnicalReportByOrder($id)){
                $this->response->sendJSONResponse($report); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'Esta orden no tiene configurado un reporte técnico.'), 400); 
            }
        }else {
			redirect('Home/login', 'refresh');
        }
    }

    public function adminReparation()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerTechnicalMaster');
            $this->load->view('TechnicalMaster/reparationList');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function  getReparations() { 
       
        if ($this->accesscontrol->checkAuth()['correct']) {
            if($res=$this->TechnicalMasterModel->getReparations()){
                $this->response->sendJSONResponse($res); 
            }else{
                //No hay reparaciones asociados al tecnico master
                $this->response->sendJSONResponse(false); 
            }
        }else{
             $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
        }
    }

    public function approveReparation()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data');
            if($report=$this->TechnicalMasterModel->approveReparation($data)){
                $this->response->sendJSONResponse($report); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'No se pudo actualizar la reparación.'), 400); 
            }
        }else {
			redirect('Home/login', 'refresh');
        }
    }


}

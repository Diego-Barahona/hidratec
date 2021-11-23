<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Techinformation extends CI_Controller
{

    public function __construct(){
		parent:: __construct(); 
		
	}

    public function viewInfoTech()
    {     
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->view('shared/headerSuperAdmin');
            $this->load->view('admin/informationTechnical');
            $this->load->view('shared/footer');
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function getTechnical(){
           
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('TechinformationModel');
            if($data= $this->TechinformationModel->getTechnical()){
                $this->response->sendJSONResponse(array($data));
            }else {
                $this->response->sendJSONResponse(array('msg' => 'No se ha podido cargar la información'), 400);
            }
            
        } else {
            redirect('Home/login', 'refresh');
        }
        

    }
    public function selectTech(){
        if ($this->accesscontrol->checkAuth()['correct']) {
            $technical =  $this->input->post('data');
            $this->load->model('TechinformationModel');
            if($data= $this->TechinformationModel-> selectTech($technical['technical'])){
                $this->response->sendJSONResponse(array($data));
            }else {
                $this->response->sendJSONResponse(array('msg' => 'No se ha podido cargar la información'), 400);
            }
            
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function getAssistent(){
           
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('TechinformationModel');
            if($data= $this->TechinformationModel->getAssistent()){
                $this->response->sendJSONResponse(array($data));
            }else {
                $this->response->sendJSONResponse(array('msg' => 'No se ha podido cargar la información'), 400);
            }
            
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function getOrdersWorked(){
           
        if ($this->accesscontrol->checkAuth()['correct']) {
            $user =  $this->input->post('data');
            $this->load->model('TechinformationModel');
            if($data= $this->TechinformationModel-> getOrdersWorked($user['user'])){
                $this->response->sendJSONResponse(array($data));
            }else {
                $this->response->sendJSONResponse(array('msg' => 'No se ha podido cargar la información'), 400);
            }
            
        } else {
            redirect('Home/login', 'refresh');
        }
    }

    public function getOrdersWorkedAT(){
           
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data =  $this->input->post('data');
            $this->load->model('TechinformationModel');
            if($data= $this->TechinformationModel-> getOrdersWorkedAT($data)){
                $this->response->sendJSONResponse(array($data));
            }else {
                $this->response->sendJSONResponse(array('msg' => 'No se ha podido cargar la información'), 400);
            }
            
        } else {
            redirect('Home/login', 'refresh');
        }
    }
}
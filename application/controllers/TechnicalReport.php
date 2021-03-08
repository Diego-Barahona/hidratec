<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TechnicalReport extends CI_Controller
{
    public function __construct(){
		parent:: __construct(); 
		$this->load->model('TechnicalReportModel');
	}

    public function getTechnicalReportByOrder($id)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            if($report=$this->TechnicalReportModel->getTechnicalReportByOrder($id)){
                $technicals = $this->TechnicalReportModel->getTechnicals();
                $this->response->sendJSONResponse(array($report, $technicals)); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'Esta orden no tiene configurado un reporte técnico.'), 400); 
            }
        }else {
            redirect(base_url() . 'home/login', 'refresh');
        }
    }

    public function getImagesByTechnicalReport()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data'); 
            if($res=$this->TechnicalReportModel->getImagesByTechnicalReport($data)){
                $this->response->sendJSONResponse($res); 
            }else{
                $msg['msg'] = "La órden de trabajo no tiene mas imagenes asociadas.";
                $this->response->sendJSONResponse($msg);
                $this->output->set_status_header(405);
            }
        }else {
            redirect(base_url() . 'home/login', 'refresh');
        }
    }

    public function editTechnicalReport()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            /* Datos de formulario*/
			$data = $this->input->post('data');

            /*Update technical report*/
            /*Success*/
            $id = $_SESSION['id'];
            if($this->TechnicalReportModel->editTechnicalReport($data)){
                $msg['msg'] = "Reporte técnico actualizado con éxito.";
                $this->response->sendJSONResponse($msg);
            /*Fail */
            }else{
                $msg['msg'] = "No se pudo encontrar el recurso.";
                $this->response->sendJSONResponse($msg);
                $this->output->set_status_header(405);
            } 	
        }else {
            redirect(base_url() . 'home/login', 'refresh');
        }
    }
}

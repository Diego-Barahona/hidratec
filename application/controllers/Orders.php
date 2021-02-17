<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct(){
		parent:: __construct(); 
		$this->load->model('Orders_model');
        $this->load->helper('ot_rules');
	}
	
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

    public function createOrder()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
			/* Datos de formulario*/
			$data = $this->input->post('data');
            $ot_number = $data['ot_number'];
            $id_technical = $data['technical'];
            $check_evaluation = $data['check_evaluation'];
            $check_report_technical = $data['check_report_technical'];
            $check_hydraulic_test = $data['check_hydraulic_test'];

			/* Cargar datos para la validación de formulario*/
			$rules = get_rules_ot_create();
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_data($data);
			$this->form_validation->set_rules($rules);
	
			/*Validación de formulario
			Si el formulario no es valido*/
			if($this->form_validation->run() == FALSE){
				if(form_error('ot_number')) $msg['ot_number'] = form_error('ot_number');
                if(form_error('enterprise')) $msg['enterprise'] = form_error('enterprise');
                if(form_error('service')) $msg['service'] = form_error('service');
                if(form_error('component')) $msg['component'] = form_error('component');
                if(form_error('priority')) $msg['priority'] = form_error('priority');
                if(form_error('date_admission')) $msg['date_admission'] = form_error('date_admission');
                if(form_error('days_quotation')) $msg['days_quotation'] = form_error('days_quotation');
				$this->response->sendJSONResponse($msg);
				$this->output->set_status_header(400); 
			}else{
			/*Si el formulario es valido*/
				/*Crear ot*/
                /*Ingresada correctamente*/
                $id = $_SESSION['id'];
                if($this->Orders_model->createOrder($data, $id)){
				/*Crear los informes de ser necesario*/
                    if($check_evaluation){
                        $this->Orders_model->createEvaluation($ot_number, $id_technical);
                    }

                    if($check_report_technical){
                        $this->Orders_model->createTechnicalReport($ot_number);
                    }

                    if($check_hydraulic_test){
                        $this->Orders_model->createHydraulicTest($ot_number);
                    }
                    $msg['msg'] = "OT registrado con éxito.";
                    $this->response->sendJSONResponse($msg);
                /*Fallo en el ingreso */
				}else{
					$msg['msg'] = "La OT ya se encuentra registrada.";
					$this->response->sendJSONResponse($msg);
					$this->output->set_status_header(405);
				} 	
			}     
        } else {
			redirect('Home/login', 'refresh');
        }
    }

    public function getOrders()
    { 
		$orders = $this->Orders_model->getOrders();
        $this->response->sendJSONResponse($orders);
    }

    public function getFieldsOrder()
    { 
        $components = $this->Orders_model->getComponents();
        $enterprises = $this->Orders_model->getEnterprises();
		$technicals = $this->Orders_model->getTechnicals();
        $this->response->sendJSONResponse(array($components, $enterprises, $technicals));
    }

    public function stagesOrder()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $url = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url['query'], $params);
            $id = $params['ot'];
            $order = $this->Orders_model->getOrder($id);
            $order['states'] = $this->Orders_model->getStates();
            
            $this->load->view('shared/super_admin/header');
            $this->load->view('admin/stagesOrder', $order);
            $this->load->view('shared/super_admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }

 /*    public function stagesOrderSearch()
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $data = $this->input->post('data_ot');
            $id = $data['ot_number'];
            $order = $this->Orders_model->getOrder($id);
            $this->response->sendJSONResponse($clients, $roles, $enterprises, $sellers));
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    } */
}


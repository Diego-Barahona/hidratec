<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent:: __construct(); 
	}
	
	//Funcion para cargar la vista del login
    public function login()
	{
		$this->load->view('login');
	}

	//Funcion para redirigir a los usuarios logeados segun privilegios
	public function load_page()
	{
		/*Verificar que el usuario esta logeado*/
		if ($this->accesscontrol->checkAuth()['correct']) {
			$rango = $this->session->rango;
			if($this->session->usuario == "user"){
				//SuperAdmin
				if ($rango == 1) $this->load_page_role("super_admin");
				//Admin
				else if ($rango == 2) $this->load_page_role("");
				//técnico master
				else if ($rango == 3) $this->load_page_role("");
				//ayudante técnico
				else if ($rango == 4) $this->load_page_role("");
				//vendedor
				else if ($rango == 5) $this->load_page_role("");
				//cliente
				else if ($rango == 6) $this->load_page_role("");
			}else if($this->session->usuario == "client"){
				//Cliente Read
				if ($rango == 1) $this->load_page_role("super_admin");
				//Cliente Edir
				else if ($rango == 2) $this->load_page_role("");
			}else{
				redirect(base_url() . 'home/login', 'refresh');
			}
        } else {
			redirect('Home/login', 'refresh');
        }
	}

	public function load_page_role($path)
	{
		$this->load->view('shared/'.$path.'/header');
		$this->load->view('shared/'.$path.'/index');
		$this->load->view('shared/'.$path.'/footer');
	}
}

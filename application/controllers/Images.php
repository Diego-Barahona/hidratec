
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Images extends CI_Controller
{   

    public function adminImages()
    { 
        
        if ($this->accesscontrol->checkAuth()['correct']) {
            $url = parse_url($_SERVER['REQUEST_URI']);
            parse_str($url['query'], $params);
            $id = $params['ot'];
            $this->load->view('shared/super_admin/header');
            $this->load->view('admin/adminImages', array ('id'=> $id));
            $this->load->view('shared/super_admin/footer');
        } else {
            redirect(base_url() . 'login', 'refresh');
        }
    }


    public function getImagesByOrder($id)
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('ImageModel');
            $datos = $this->ImageModel->getImagesByOT($id);
            $this->response->sendJSONResponse($datos);
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }

    public function addImage()
	{
		if ($this->accesscontrol->checkAuth()['correct']) {
			$imagen = $this->input->post("data");
			$this->load->model('ImageModel');
			$err = "";
			$err_image="";
			$valid = true;
			$image=0;
			$name=0;
			
			if (empty($imagen['name'])) {
				$err = "Ingrese un nombre";
				$valid = false;
				
			}
			
			if ($imagen['file'] == 0) {
				$err_image= "Debe seleccionar una foto";
				$valid = false;
			
			}
			
			
			if (!$valid) {
				$this->response->sendJSONResponse(array('status' => "fail", "err" => $err ,"err_i"=>$err_image), 500);
			} else {
				$s = $this->ImageModel->insertImage($imagen);
				if ($s['status'] == "success") {
					$this->response->sendJSONResponse(array('status' => $s['status'], "id" => $s['id']));
				} else {
					$this->response->sendJSONResponse(array('status' => $s['status']), 500);
				}
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
	}



	public function editImage($id)
	{
		
		if ($this->accesscontrol->checkAuth()['correct']) {
			$imagen = $this->input->post("data");
			$this->load->model('ImageModel');
		
			$valid = true;
			
			if (empty($imagen['name'])) {
				$err = "Ingrese un nombre";
				$valid = false;
			}
			
			if ($imagen['file'] == 0) {
				$err_image= "Debe seleccionar una foto";
				$valid = false;
			}
			
			if (!$valid) {
				$this->response->sendJSONResponse(array('status' => "fail", "err" => "Ingrese nombre"), 500);

			} else {
				$s = $this->ImageModel->editImagen($imagen,$id);
				if ($s['status'] == "success") {
					$this->response->sendJSONResponse(array('status' => $s['status'],"id" => $s['id']));
				} else {
					$this->response->sendJSONResponse(array('status' => $s['status'], "err" => $err), 500);
				}
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
	}



    public function upImage($id)
	{
		if ($this->accesscontrol->checkAuth()['correct']) {
			$config['upload_path'] = "./assets/upload/";
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10000000';

			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("file")) {
				$data = array('upload_data' => $this->upload->data());
				$image = $data['upload_data']['file_name'];
				$this->load->model('ImageModel');
				$s = $this->ImageModel->imageUpload($id, $image);
            
				if ($s == "success") {
					$this->response->sendJSONResponse(array("id" => $id, "i" => $image));
				} else {
					$this->response->sendJSONResponse(array('status' => "error"), 500);
				}
			} else {
				$this->response->sendJSONResponse(array(
					"id" => $id, "i" => $this->upload->display_errors(),
					"c" => $config['upload_path']
				));
			}
		} else {
			$this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
		}
	}






}






<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HydraulicTest extends CI_Controller
{
    public function getHydraulicTestByOrder($id)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('HydraulicTestModel');
            if($res=$this->HydraulicTestModel->getHydraulicTestByOrder($id)){
                $this->response->sendJSONResponse($res); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'Esta orden no tiene configurada una prueba hidraulica.'), 400); 
            }
            }else{
                
                $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
    }


    public function get_info_ht($id)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('HydraulicTestModel');
            if($res=$this->HydraulicTestModel->get_info_ht($id)){
                $this->response->sendJSONResponse($res); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'Esta orden no tiene configurada una prueba hidraulica.'), 400); 
            }
            }else{
                
                $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
    }


    public function editHydraulicTest($id){

        if($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post('data');
        $date_ht = $data['date_ht'];
        $conclusion = $data['conclusion'];
        $notes = $data['notes'];
        $technical = $data['technical'];
        
        $ok=true;

        if ($date_ht== "") { $ok = false;  $err['date_ht']  = "Ingrese fecha de evaluación";  }
        if ($conclusion == "") { $ok = false;  $err['conclusion']  = "Ingrese description.";  }
        if ($notes == "") { $ok = false;  $err['notes']  = "Ingrese un notas.";  }
        if ($technical == "") { $ok = false;  $err['technical']  = "Ingrese un tecnico";  }
  
        if($ok){ 
            $this->load->model('HydraulicTestModel');
            if($this->HydraulicTestModel->editHydraulicTest($id,$data)){
            $this->response->sendJSONResponse( array("msg"=>"Se ha editado con éxito "));
            }else{ 
            $this->response->sendJSONResponse( array("msg" => "No se han podido editar los datos "),400); 
            }
            
        }else { $this->response->sendJSONResponse( array("msg" => "Complete todos los campos de la evaluación. ", "err"=> $err),400); }

        }else {
            $this->response->sendJSONResponse( array("msg" => "No tiene los permisos suficientes "),400);
        }
    }


    public function editInfoHt($id){

        if($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post('data');
        $ok=true;
        if($ok){ 
            $this->load->model('HydraulicTestModel');
            if($this->HydraulicTestModel->editInfoHt($id,$data)){
            $this->response->sendJSONResponse( array("msg"=>"Se ha editado con éxito "));
            }else{ 
            $this->response->sendJSONResponse( array("msg" => "No se han podido editar los datos "),400); 
            }
            
        }else { $this->response->sendJSONResponse( array("msg" => "Complete todos los campos de la evaluación. ", "err"=> $err),400); }

        }else {
            $this->response->sendJSONResponse( array("msg" => "No tiene los permisos suficientes "),400);
        }
    }




    public function editPdf($id)
    {   
      
        
        
        $config['upload_path'] = "./assets/upload/";
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload("pdf")) {
            $data = array('upload_data' => $this->upload->data());
            $pdf = $data['upload_data']['file_name'];
            $array = explode(".", $pdf); //divide string y convierte en array 
           
            $formato =  $array[1];// selecciona el indice 1 igual a pdf 
        
            if($formato == "pdf") {
            $this->load->model('HydraulicTestModel');
                 if ( $res = $this->HydraulicTestModel->uploadPdf($id, $pdf)) {
                     $this->response->sendJSONResponse(array('msg' => "Archivo subido con éxito."));
                     } else {
                       $this->response->sendJSONResponse(array('msg' => "error"), 500);
                      }
            }else { $this->response->sendJSONResponse(array('msg' => "Cargue un formato correcto por favor"), 500); } 
        } else {
            $this->response->sendJSONResponse(array(
                "msg" => "error",
                "id" => $id, "i" => $this->upload->display_errors(),
                "c" => $config['upload_path']
            ));
        }
    }


    public function getPdf($id)
    { 

        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('HydraulicTestModel');
            if($res=$this->HydraulicTestModel->getPdf($id)){
                $this->response->sendJSONResponse($res); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'No se han podido traer los datos del archivo'), 400); 
            }
            }else{
                
                $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
    }




    public function deletePdf($id)
    {
        if ($this->accesscontrol->checkAuth()['correct']) {
            
            $data = $this->input->post('data');
            $name = $data['pdf'];
            $this->load->model('HydraulicTestModel');
            if ( $response = $this->HydraulicTestModel->deletePdf($id)) {
                unlink('./assets/upload/' . $name);
                $this->response->sendJSONResponse(array("msg" => "El archivo fue eliminado con éxito"));
            } else {
                $this->response->sendJSONResponse(array('status' => "error"), 500);
            }
        } else {
            $this->response->sendJSONResponse(array('msg' => 'Permisos insuficientes'), 400);
        }
    }
}




    


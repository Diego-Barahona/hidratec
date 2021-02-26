<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluation extends CI_Controller
{
    public function getEvaluationByOrder($id)
    { 
        if ($this->accesscontrol->checkAuth()['correct']) {
            $this->load->model('EvaluationModel');
            if($res=$this->EvaluationModel->getEvaluationByOrder($id)){
                $this->response->sendJSONResponse($res); 
            }else{
                $this->response->sendJSONResponse(array('msg' => 'Esta orden no tiene configurada una evaluación.'), 400); 
            }
            }else{
                
                $this->response->sendJSONResponse(array('msg' => 'No tiene permisos suficientes.'), 400);
            }
    }


    public function editEvaluation($id){

        if($this->accesscontrol->checkAuth()['correct']) {
        $data = $this->input->post('data');
        $date_evaluation = $data['date_evaluation'];
        $description = $data['description'];

        $notes = $data['notes'];
        $technical = $data['technical'];
        $ok=true;

        if ($date_evaluation== "") { $ok = false;  $err['date_evaluation']  = "Ingrese fecha de evaluación";  }
        if ($description == "") { $ok = false;  $err['description']  = "Ingrese description.";  }
        if ($notes == "") { $ok = false;  $err['notes']  = "Ingrese un notas.";  }
        if ($technical == "") { $ok = false;  $err['technical']  = "Ingrese un tecnico";  }
  
        if($ok){ 
            $this->load->model('EvaluationModel');
            if($this->EvaluationModel->editEvaluation($id,$data)){
            $this->response->sendJSONResponse( array("msg"=>"Se ha editado con éxito "));
            }else{ 
            $this->response->sendJSONResponse( array("msg" => "No se han podido editar los datos "),400); 
            }
            
        }else { $this->response->sendJSONResponse( array("msg" => "Complete todos los campos de la evaluación. ", "err"=> $err),400); }

        }else {
            $this->response->sendJSONResponse( array("msg" => "No tiene los permisos suficientes "),400);
        }
    }



    
}

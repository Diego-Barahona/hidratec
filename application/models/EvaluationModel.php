<?php

class EvaluationModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEvaluationByOrder($id){
        
        
        $query= "SELECT e.details , u.full_name , e.user_assignment,e.state,e.export,e.user_interaction
        FROM evaluation e
        LEFT JOIN user_role ur ON ur.user_id = e.user_assignment
        LEFT JOIN user u ON u.id = ur.user_id
        WHERE e.ot_id = ? AND e.state = ? ";
        
        return $this->db->query($query, array($id,true))->result(); 

           
      
    }

    public function editEvaluation($id,$data){

        $user= $_SESSION['full_name'];
        $date=  date('Y-m-d H:i:s');

        $date_approve="";
        $user_approve="";
        $user_create="";
        $date_create="";
        
        $technical = $data['technical'];

        if($data['approve_technical'] == "true" && $data['check_technical_old'] == "false"){
      
            $date_create= $date;
            $user_create= $user;
           
        }else  if($data['approve_technical'] == "true" &&  $data['check_technical_old'] == "true"){
                  
                     $date_create= $data['date_create'];
                     $user_create= $data['user_create'];
                    }else {
 
                    $date_create="";
                    $user_create="";

                        }


      
        if($data['approve_admin'] == "true" && $data['check_admin_old'] == "false"){
      
            $date_approve= $date;
            $user_approve= $user;
           
        }else  if($data['approve_admin'] == "true" &&  $data['check_admin_old'] == "true"){
                  
                     $date_approve= $data['date_approve'];
                     $user_approve= $data['user_approve'];
                    }else {
 
                    $date_approve="";
                    $user_approve="";
                        }

        
        $details= json_encode ( array( 
            "ot"=>$id,
            "date_evaluation"=> $data['date_evaluation'],
            "description"=> $data['description'],
            "notes" => $data['notes'],
            "approve_technical" => $data['approve_technical'],
            "approve_admin" => $data['approve_admin']
             )
        );

        $user_interaction= json_encode ( array( 
        
            "user_create"=> $user_create,
            "date_create"=> $date_create,
            "user_modify"=> $user,
            "date_modify"=> $date,
            "user_approve"=> $user_approve,
            "date_approve"=> $date_approve,
            )
        );


        $query = "UPDATE evaluation SET details = ? , user_assignment = ? , user_interaction = ? WHERE ot_id = ?";
            return $this->db->query($query, array($details,$technical,$user_interaction,$id));  
    }  


    public function pdfEvaluation($id,$new){
  //  unlink('./'.$old);
    $query = "UPDATE evaluation SET export = ? WHERE ot_id = ?";
    return $this->db->query($query, array($new,$id));  
    }


}
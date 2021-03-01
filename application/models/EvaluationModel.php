<?php

class EvaluationModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEvaluationByOrder($id){
        
        
        $query= "SELECT e.details , u.full_name , e.user_assignment,e.state
        FROM evaluation e
        LEFT JOIN user_role ur ON ur.user_id = e.user_assignment
        LEFT JOIN user u ON u.id = ur.user_id
        WHERE e.ot_id = ? AND e.state = ? ";
        
        return $this->db->query($query, array($id,true))->result(); 

           
      
    }

    public function editEvaluation($id,$data){

        $technical = $data['technical'];
        $details= json_encode ( array( 
            "ot"=>$id,
            "date_evaluation"=> $data['date_evaluation'],
            "description"=> $data['description'],
            "notes" => $data['notes'] )
        );

        $query = "UPDATE evaluation SET details = ? , user_assignment = ? WHERE ot_id = ?";
            return $this->db->query($query, array($details,$technical,$id));  
    }  

    


}
<?php

class EvaluationModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEvaluationByOrder($id){

        $query= "SELECT * FROM evaluation WHERE ot_id = ? AND  evaluation.state = 1 ";
        $result= $this->db->query($query, array($id));

        if($result->num_rows() > 0){
            
            $query= "SELECT details , full_name , user_assignment
                     FROM evaluation e
                     JOIN user_role ur ON ur.user_id = e.user_assignment
                     JOIN user u ON u.id = ur.user_id
                     WHERE ot_id = ?";
            var_dump($this->db->query($query, array($id))->result()); 

        }else { 
            return false;
        }
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
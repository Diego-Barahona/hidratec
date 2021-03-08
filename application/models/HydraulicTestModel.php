<?php

class HydraulicTestModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getHydraulicTestByOrder($id){

        
        
        $query= "SELECT ht.details , u.full_name , ht.user_assignment, ht.state
        FROM hydraulic_test ht
        LEFT JOIN user_role ur ON ur.user_id = ht.user_assignment
        LEFT JOIN user u ON u.id = ur.user_id
        WHERE ht.ot_id = ? AND ht.state = ? ";
        
        return $this->db->query($query, array($id,true))->result(); 

           
      

    }
    public function get_info_ht($id){
        $query= "SELECT extra_info FROM hydraulic_test WHERE ot_id = ? ";
         return $this->db->query($query, array($id))->result(); 

    }


    public function editHydraulicTest($id,$data){

        $technical = $data['technical'];

        $details= json_encode ( array( 
            "ot"=>$id,
            "date_ht"=> $data['date_ht'],
            "conclusion"=> $data['conclusion'],
            "notes" => $data['notes'],
            "approve_technical" => $data['approve_technical'],
            "approve_admin" => $data['approve_admin'],)
        );

        $query = "UPDATE hydraulic_test SET details = ? , user_assignment = ? WHERE ot_id = ?";
            return $this->db->query($query, array($details,$technical,$id));  
    } 


    public function editInfoHt($id,$data){

        $query = "UPDATE hydraulic_test SET extra_info = ?  WHERE ot_id = ?";
            return $this->db->query($query, array($data,$id));  

    } 


    public function uploadPdf($id, $pdf)
    {   
        $sql = "UPDATE  hydraulic_test SET hydraulic_test.file_ht  = ? WHERE ot_id = ?"; //crear campo file en base de datos phpmyadmin
        return $this->db->query($sql, array($pdf, $id));
        
    }


    public function getPdf($id)
    {   
        $sql= "SELECT file_ht FROM hydraulic_test WHERE ot_id = ? ";
        return $this->db->query($sql, array($id))->result();
        
    }

    public function deletePdf($id)
    {   
        $sql= "UPDATE  hydraulic_test SET hydraulic_test.file_ht  = ? WHERE ot_id = ?";
        return $this->db->query($sql, array(null,$id));
        
    }
    



    
}
<?php

class HydraulicTestModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getHydraulicTestByOrder($id){

        
        
        $query= "SELECT ht.details , u.full_name , ht.user_assignment, ht.state , ht.user_interaction
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
        
        $user= $_SESSION['full_name'];
        $date=  date('Y-m-d H:i:s');

        $date_approve="";
        $user_approve="";
        
        $technical = $data['technical'];
      
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
            "date_ht"=> $data['date_ht'],
            "conclusion"=> $data['conclusion'],
            "notes" => $data['notes'],
            "approve_technical" => $data['approve_technical'],
            "approve_admin" => $data['approve_admin'],)
        );

        $user_interaction= json_encode ( array( 
        
            "user_create"=> $data['user_create'],
            "date_create"=> $data['date_create'],
            "user_modify"=> $user,
            "date_modify"=> $date,
            "user_approve"=> $user_approve,
            "date_approve"=> $date_approve,
            )
        );

        $query = "UPDATE hydraulic_test SET details = ? , user_assignment = ? , user_interaction = ? WHERE ot_id = ?";
            return $this->db->query($query, array( $details, $technical, $user_interaction , $id));  
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
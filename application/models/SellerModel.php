<?php
class SellerModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function  getApproveTechnicalReport () { 
        

        $query = "SELECT ot.id number_ot, ot.date_admission date, ot.priority priority, ot.description description, ot.type_service service, e.name enterprise, c.name component, s.name state ,tr.details,tr.user_interaction
        FROM ot
        JOIN enterprise e ON ot.enterprise_id = e.id
        JOIN component c ON ot.component_id = c.id
        JOIN ot_state os ON ot.id = os.ot_id
         JOIN technical_report tr ON ot.id = tr.ot_id
        JOIN state s ON os.state_id = s.id
        WHERE s.id=3 OR s.id=4 OR s.id=5 OR s.id=6 OR s.id=7 AND os.id = (
            SELECT f.id 
            FROM ot_state f 
            WHERE f.ot_id = ot.id AND f.date_update = (
                  SELECT MAX(j.date_update)
                  FROM ot_state j
                  WHERE j.ot_id = ot.id
                ) 
          ) 
        "; 

     return  $this->db->query($query)->result(); 
    
     }
     
     public function getOrdersQuotation () { 
        
        $query = "SELECT ot.id number_ot, ot.date_admission date, ot.priority priority, ot.description description, ot.type_service service, e.name enterprise, c.name component, s.name state, approve_client
        FROM ot
        JOIN enterprise e ON ot.enterprise_id = e.id
        JOIN component c ON ot.component_id = c.id
        JOIN ot_state os ON ot.id = os.ot_id
        JOIN quotation q ON ot.id = q.ot_id
        JOIN state s ON os.state_id = s.id
        WHERE s.id=3 AND os.id = (
            SELECT f.id 
            FROM ot_state f 
            WHERE f.ot_id = ot.id AND f.date_update = (
                  SELECT MAX(j.date_update)
                  FROM ot_state j
                  WHERE j.ot_id = ot.id
                ) 
          ) 
        "; 

     var_dump($this->db->query($query)->result()); 
    
     }
 
     public function changeState($id, $state)
    {   
       $query = "UPDATE quotation SET approve_client = ? WHERE ot_id = ?";
       return $this->db->query($query, array($state, $id));
    }

    public function uploadOC($id, $pdf)
    {   
        $sql = "UPDATE  quotation SET quotation .correlative_oc  = ? WHERE ot_id = ?"; //crear campo file en base de datos phpmyadmin
        return $this->db->query($sql, array($pdf, $id));
        
    }


    public function getOC($id)
    {   
        $sql= "SELECT correlative_oc FROM quotation  WHERE ot_id = ? ";
        return $this->db->query($sql, array($id))->result();
        
    }

    public function deleteOC($id)
    {   
        $sql= "UPDATE  quotation  SET quotation .correlative_oc  = ? WHERE ot_id = ?";
        return $this->db->query($sql, array(null,$id));
        
    }

}


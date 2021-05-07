<?php
class TechnicalMasterModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function  getHydraulicTestEnable () { 
        
        $user= $_SESSION['id'];
       
        $query = "SELECT ot.id number_ot, ot.date_admission date, ot.priority priority, 
        ot.description description, ot.type_service service, e.name enterprise,
         c.name component, s.name state ,ht.details,ht.user_interaction,ht.extra_info,ht.file_ht,ht.config,ht.state
        FROM ot
        JOIN enterprise e ON ot.enterprise_id = e.id
        JOIN component c ON ot.component_id = c.id
        JOIN ot_state os ON ot.id = os.ot_id
        JOIN hydraulic_test ht ON ot.id = ht.ot_id
        JOIN state s ON os.state_id = s.id
        WHERE  ht.state = ? AND ht.user_assignment = ? AND os.id = (
            SELECT f.id 
            FROM ot_state f 
            WHERE f.ot_id = ot.id AND f.date_update = (
                  SELECT MAX(j.date_update)
                  FROM ot_state j
                  WHERE j.ot_id = ot.id
                ) 
          ) 
        "; 

     return  $this->db->query($query,array(true,$user))->result(); 
    
     }



     public function  getEvaluationEnable () { 
        
        $user= $_SESSION['id'];

      
       
        $query = "SELECT ot.id number_ot, ot.date_admission date, ot.priority priority, 
        ot.description description, ot.type_service service, e.name enterprise,
         c.name component, s.name state ,ev.details,ev.user_interaction , ev.state
        FROM ot
        JOIN enterprise e ON ot.enterprise_id = e.id
        JOIN component c ON ot.component_id = c.id
        JOIN ot_state os ON ot.id = os.ot_id
        JOIN evaluation ev ON ot.id = ev.ot_id
        JOIN state s ON os.state_id = s.id
        WHERE  ev.state = ? AND ev.user_assignment = ? AND os.id = (
            SELECT f.id 
            FROM ot_state f 
            WHERE f.ot_id = ot.id AND f.date_update = (
                  SELECT MAX(j.date_update)
                  FROM ot_state j
                  WHERE j.ot_id = ot.id
                ) 
          ) 
        "; 

     return  $this->db->query($query,array(true,$user))->result(); 
    
     }




     

    }
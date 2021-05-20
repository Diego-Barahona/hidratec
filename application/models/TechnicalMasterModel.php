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

    
     public function  getTechnicalReports () 
    { 
        $user= $_SESSION['id'];
    
        $query = "SELECT tr.ot_id number_ot, ot.priority ,tr.user_interaction , tr.details details, e.name client, c.name component, ot.type_service service
        FROM technical_report tr 
        JOIN ot ON tr.ot_id = ot.id
        JOIN enterprise e ON ot.enterprise_id = e.id
        JOIN component c ON ot.component_id = c.id
        JOIN ot_state os ON ot.id = os.ot_id
        JOIN state s ON os.state_id = s.id
        WHERE  tr.state = ? AND tr.user_assignment = ? AND os.id = (
            SELECT f.id 
            FROM ot_state f 
            WHERE f.ot_id = ot.id AND f.date_update = (
                  SELECT MAX(j.date_update)
                  FROM ot_state j
                  WHERE j.ot_id = ot.id
                ) 
            ) 
        "; 

        $res = $this->db->query($query,array(true,$user))->result(); 

        if(sizeof($res) != 0){
            return $res;
        }else{
            return false;
        }
    }

    public function getReparations () 
    { 
        $user= $_SESSION['id'];
    
        $query = "SELECT r.ot_id number_ot, r.user_interaction ,r.date_reparation date , r.check_adm, r.check_technical, e.name client, c.name component, ot.type_service service
        FROM reparation r 
        JOIN ot ON r.ot_id = ot.id
        JOIN enterprise e ON ot.enterprise_id = e.id
        JOIN component c ON ot.component_id = c.id
        JOIN ot_state os ON ot.id = os.ot_id
        JOIN state s ON os.state_id = s.id
        WHERE r.user_assignment = ? AND os.id = (
            SELECT f.id 
            FROM ot_state f 
            WHERE f.ot_id = ot.id AND f.date_update = (
                  SELECT MAX(j.date_update)
                  FROM ot_state j
                  WHERE j.ot_id = ot.id
                ) 
            ) 
        "; 

        $res = $this->db->query($query,array($user))->result(); 

        if(sizeof($res) != 0){
            return $res;
        }else{
            return false;
        }
    }

    public function getTechnicalReportByOrder($id){
        $query= "SELECT tr.details data, tr.details_images data_images
        FROM technical_report tr
        WHERE tr.ot_id = ?";
        return $this->db->query($query, $id)->result_array(); 
    } 

    public function approveReparation($data){
        $name = $_SESSION['full_name'];
        date_default_timezone_set("America/Santiago");
        $date_update = date("Y-m-d G:i:s");

        $query= "SELECT r.user_interaction
        FROM reparation r
        WHERE r.ot_id = ?";
        $result= $this->db->query($query, $data['ot_id'])->result_Array(); 
        /* var_dump(json_decode($interaction, true)); */
        $interaction = json_decode($result[0]['user_interaction'], true);

        $datos_reparation = array(
            'check_technical' => 1,
            'date_reparation' => $date_update,
            'user_interaction' => json_encode(array(
                'technical_assignment' => $name,
                'date_reparation' => $date_update,
                'user_modify' => $name,
                'date_modify' => $date_update,
                'user_approve' =>  $interaction['user_approve'],
                'date_approve' =>  $interaction['date_approve']

            )),
        );


        $this->db->where('ot_id', $data['ot_id']);
        if($this->db->update('reparation', $datos_reparation)) return true; else return false;
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

     
    public function getSubstaksReparation($id){
        $query = "SELECT sr.id, sr.state, sr.ot_id number_ot, sr.date_assigment date, sr.check_tm, sr.check_at, u.full_name technical_assistant, s.name substask
        FROM subtask_reparation sr
        JOIN user u ON sr.user_id = u.id
        JOIN subtask s ON sr.subtask_id = s.id
        WHERE sr.ot_id = ?"; 
        return $this->db->query($query,array($id))->result();  
    } 

    public function getSubstaksEvaluation($id){
        $query = "SELECT se.id, se.state, se.ot_id number_ot, se.date_assigment date, se.check_tm, se.check_at, u.full_name technical_assistant, s.name substask
        FROM subtask_evaluation se
        JOIN user u ON se.user_id = u.id
        JOIN subtask s ON se.subtask_id = s.id
        WHERE se.ot_id = ?"; 
        return $this->db->query($query,array($id))->result();  
    } 


    public function getTechnicalAssistans(){  //query de los tecnicos master 
        $query = "SELECT u.id id, u.full_name name
        FROM user u
        JOIN user_role ur ON ur.user_id = u.id
        WHERE u.state = ? AND ur.role_id = ?"; 
        return $this->db->query($query,array(1, 4))->result_array();  
    }

    public function getSubstaks(){  // query recursos subtareas activas 
        return $query = $this->db->get_where('subtask', array('state' => 1))->result_array();
    }

    public function createSubstakReparation($data){
 
        $this->db->select('*'); $this->db->from('subtask_reparation'); 
        $this->db->where('subtask_id', $data['subtask_id']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('ot_id', $data['ot_id']);
        $query = $this->db->get();
        if(sizeof($query->result()) > 0){
            return false;
        }else{
            $datos_substask = array(
                'subtask_id' => $data['subtask_id'],
                'ot_id' => $data['ot_id'],
                'check_tm' => 0,
                'check_at' => 0,
                'date_assigment' => $data['date_assignment'],
                'user_id' => $data['user_id'],
                'state' => 1,
            );
            if($this->db->insert('subtask_reparation', $datos_substask )) return true; else return false;
        }
    }

  
    public function createSubstakEvaluation($data){
 
        $this->db->select('*'); $this->db->from('subtask_evaluation'); 
        $this->db->where('subtask_id', $data['subtask_id']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('ot_id', $data['ot_id']);
        $query = $this->db->get();
        if(sizeof($query->result()) > 0){
            return false;
        }else{
            $datos_substask = array(
                'subtask_id' => $data['subtask_id'],
                'ot_id' => $data['ot_id'],
                'check_tm' => 0,
                'check_at' => 0,
                'date_assigment' => $data['date_assignment'],
                'user_id' => $data['user_id'],
                'state' => 1,
            );
            if($this->db->insert('subtask_evaluation', $datos_substask )) return true; else return false;
        }
    }  

    public function updateSubstakReparation($data){
        $this->db->select('*'); 
        $this->db->from('subtask_reparation'); 
        $this->db->where('subtask_id', $data['subtask_id']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('ot_id', $data['ot_id']);
        $this->db->where('id !=', $data['id']);
        $query = $this->db->get();

        if(sizeof($query->result()) > 0){
            return false;
        }else{
            $datos_substask = array(
                'subtask_id' => $data['subtask_id'],
                'ot_id' => $data['ot_id'],
                'check_tm' => $data['check_tm'],
                'check_at' => $data['check_at'],
                'date_assigment' => $data['date_assignment'],
                'user_id' => $data['user_id'],
            );

            $this->db->where('id', $data['id']);
            if($this->db->update('subtask_reparation', $datos_substask)) return true; else return false;
        }
    }

 
    public function updateSubstakEvaluation($data){
        $this->db->select('*'); 
        $this->db->from('subtask_evaluation'); 
        $this->db->where('subtask_id', $data['subtask_id']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('ot_id', $data['ot_id']);
        $this->db->where('id !=', $data['id']);
        $query = $this->db->get();

        if(sizeof($query->result()) > 0){
            return false;
        }else{
            $datos_substask = array(
                'subtask_id' => $data['subtask_id'],
                'ot_id' => $data['ot_id'],
                'check_tm' => $data['check_tm'],
                'check_at' => $data['check_at'],
                'date_assigment' => $data['date_assignment'],
                'user_id' => $data['user_id'],
            );

            $this->db->where('id', $data['id']);
            if($this->db->update('subtask_evaluation', $datos_substask)) return true; else return false;
        }
    }   



    public function desHabSubstakReparation($data){
        $this->db->where('id', $data['id']);
        $query = $this->db->update('subtask_reparation', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function desHabSubstakEvaluation($data){
        $this->db->where('id', $data['id']);
        $query = $this->db->update('subtask_evaluation', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    
}
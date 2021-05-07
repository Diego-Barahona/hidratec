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
    
        $query = "SELECT tr.ot_id number_ot, tr.user_interaction , tr.details details, e.name client, c.name component, ot.type_service service
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

    public function  getReparations () 
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
                'date_approve' =>  $interaction['date_approve'],

            )),
        );

        $this->db->where('ot_id', $data['ot_id']);
        if($this->db->update('reparation', $datos_reparation)) return true; else return false;
    } 
}
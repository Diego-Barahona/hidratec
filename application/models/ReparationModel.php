<?php

class ReparationModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getReparationByOrder($ot_id){
        $query= "SELECT r.check_adm check_adm, r.check_technical check_technical, r.user_assignment user, r.date_reparation date, ot.days_reparation days
        FROM reparation r
        LEFT JOIN ot ON ot.id = r.ot_id
        WHERE r.ot_id = ? ";
        if($reparation = $this->db->query($query, array($ot_id))->result_array()) return $reparation; else return false;
    } 

    public function getTechnicals()
    {
        $this->db->select('u.id, u.full_name' );
        $this->db->from('user u'); 
        $this->db->join('user_role ur', 'ur.user_id = u.id','left');
        $this->db->where('ur.role_id', 3);
        $this->db->where('u.state', 1);
        return $query = $this->db->get()->result_array();
    }

    public function editReparation($data){
        $technical = null;
        $op = 0;
        date_default_timezone_set("America/Santiago");
        $date = date("Y-m-d G:i:s");
        if($data['user_assignment']){
            $technical =$data['user_assignment'];
            $op = 1;
        }else{
            $technical = null;
            $op = 2;
        }
        $datos_r = array(
            'user_assignment' => $data['user_assignment'],
            'check_adm' => $data['check_adm'],   
            'check_technical' => $data['check_technical'],   
            'user_assignment' => $technical,
            'date_reparation' => $data['date_reparation'],
        );
     
        $this->db->where('ot_id', $data['ot_id']);
        if($this->db->update('reparation', $datos_r)){

            //update OT
            $datos_ot = array(
                'date_reparation' => $data['date_reparation'],
                'days_reparation' => $data['days_reparation']
            );
            $this->db->where('id', $data['ot_id']);
            $this->db->update('ot', $datos_ot);

            //insert/update or delete row ot_user
            $this->db->select('*'); $this->db->from('ot_user'); 
            $this->db->where('ot_id', $data['ot_id']);
            $this->db->where('state_id', 4);
            $query = $this->db->get();
            if($op == 1){
                $datos_ot_user = array(
                    'ot_id' => $data['ot_id'],
                    'user_id' => $technical,
                    'state_id' => 4,
                    'date_assignment' => $date,
                );
                if(sizeof($query->result()) == 0){
                    $this->db->insert('ot_user', $datos_ot_user );
                    return true; 
                }else if (sizeof($query->result()) == 1){
                    $this->db->where('ot_id', $data['ot_id']);
                    $this->db->where('state_id', 4);
                    $this->db->update('ot_user', $datos_ot_user );
                    return true;  
                }else{
                    return false;
                }

            }else if($op == 2){
                if(sizeof($query->result()) == 1){
                    $this->db->where('ot_id', $data['ot_id']);
                    $this->db->where('state_id', 4);
                    $this->db->delete('ot_user');
                }
            }
            return true;
        }  else return false;
    }
}
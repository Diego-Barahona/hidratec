<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOrder($id)
    {
        $this->db->select('ot.id number_ot, ot.date_admission date, ot.priority priority, ot.description description, ot.type_service service, e.name enterprise, c.name component, s.id state, s.name state' );
        $this->db->from('ot'); 
        $this->db->join('enterprise e', 'e.id = ot.enterprise_id','left');
        $this->db->join('component c', 'c.id = ot.component_id','left');
        $this->db->join('ot_state os', 'os.ot_id = ot.id','left');
        $this->db->join('state s', 's.id = os.state_id','left');
        $this->db->where('ot.id', $id);
        return $query = $this->db->get()->row_array();
    }

    public function getStates()
    {
        return $query=$this->db->get('state')->result_array();
    }

    public function getOrders()
    {
        $this->db->select('ot.id number_ot, ot.date_admission date, ot.priority priority, ot.description description, ot.type_service service, e.name enterprise, c.name component, s.name state' );
        $this->db->from('ot'); 
        $this->db->join('enterprise e', 'e.id = ot.enterprise_id','left');
        $this->db->join('component c', 'c.id = ot.component_id','left');
        $this->db->join('ot_state os', 'os.ot_id = ot.id','left');
        $this->db->join('state s', 's.id = os.state_id','left');
        return $query = $this->db->get()->result();
    }
    
    public function getComponents(){
        return $query=$this->db->get('component')->result();
    }

    public function getEnterprises(){
        return $query=$this->db->get('enterprise')->result();
    }

    public function getTechnicals()
    {
        $this->db->select('u.id, u.full_name' );
        $this->db->from('user u'); 
        $this->db->join('user_role ur', 'ur.user_id = u.id','left');
        $this->db->where('ur.role_id', 3);
        return $query = $this->db->get()->result();
    }

    public function createOrder($data, $user_id){
        $this->db->select('*'); $this->db->from('ot'); $this->db->where('id', $data['ot_number']);
        $query = $this->db->get();
        if(sizeof($query->result()) != 0){
            return false;
        }else{
            $datos_ot = array(
                'id' => $data['ot_number'],
                'date_admission' => $data['date_admission'],
                'days_quote'=> $data['days_quotation'],
                'description' => $data['description'],
                'type_service' => $data['service'],
                'priority' => $data['priority'],
                'component_id' => $data['component'],
                'enterprise_id' => $data['enterprise'],
                'config' => json_encode(array(
                    'evaluation' => $data['check_evaluation'],
                    'technical_report' => $data['check_report_technical'],
                    'hydraulic_test' => $data['check_hydraulic_test'],
                )),
            );

            if($this->db->insert('ot', $datos_ot)) {
                $datos_ot_state = array(
                    'ot_id' => $data['ot_number'],
                    'state_id' => 1,
                    'user_id' => $user_id,
                );
                $this->db->insert('ot_state', $datos_ot_state);

                if($data['technical']){
                    $datos_ot_user = array(
                        'ot_id' => $data['ot_number'],
                        'state_id' => 1,
                        'user_id' => $data['technical'],
                    );
                    $this->db->insert('ot_user', $datos_ot_user);
                }
                return true;
            }else{
                return false;
            }
        }
    }

    public function createEvaluation($id_ot, $id_technical){
        $datos_ev = array(
            'ot_id' => $id_ot,
            'user_assignment'=> $id_technical,
        );
        if($this->db->insert('evaluation', $datos_ev)) return true; else return false; 
    }

    public function createTechnicalReport($id_ot){
        $datos_tr = array(
            'ot_id' => $id_ot,
        );
        if($this->db->insert('technical_report', $datos_tr)) return true; else return false;
    }

    public function createHydraulicTest($id_ot){
        $datos_ht = array(
            'ot_id' => $id_ot,
        );
        if($this->db->insert('hydraulic_test', $datos_ht)) return true; else return false;
    }

}


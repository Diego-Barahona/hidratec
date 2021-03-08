<?php

class TechnicalReportModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getTechnicalReportByOrder($id){
        $query= "SELECT tr.details data, tr.details_images data_images, u.id user
        FROM technical_report tr
        LEFT JOIN user u ON u.id = tr.user_assignment
        WHERE tr.ot_id = ? AND tr.state = ? ";
        return $this->db->query($query, array($id,true))->result_array(); 
    } 

    public function getImagesByTechnicalReport($data){

        $id_ot = $data['ot_id'];
        $images_seleccionadas = $data['images'];
        $var = "";
        $cont = 1;
        if($images_seleccionadas){
            foreach ($images_seleccionadas as &$valor) {
                if($cont == count($images_seleccionadas)){
                    $var = $var." i.id != ".$valor;
                }else{
                    $var = $var." i.id != ".$valor." AND";
                }
                $cont++;
            }
            $query= "SELECT * FROM images i WHERE .$var. AND i.ot_id = $id_ot";
            if($res = $this->db->query($query, array($id_ot))->result()) return $res; else return false;
        }else{
            $query= "SELECT * FROM images i WHERE i.ot_id = $id_ot";
            if($res = $this->db->query($query, array($id_ot))->result()) return $res; else return false;
        }

    } 

    public function getTechnicals()
    {
        $this->db->select('u.id, u.full_name' );
        $this->db->from('user u'); 
        $this->db->join('user_role ur', 'ur.user_id = u.id','left');
        $this->db->where('ur.role_id', 3);
        $this->db->where('u.state', 1);
        return $query = $this->db->get()->result();
    }

    public function editTechnicalReport($data){
        
        $technical = null;
        if($data['technical']){
            $technical = $data['technical'];
        }
        $imagenes = $data['details_images'];

        $datos_tr = array(
            'user_assignment' => $technical,
            'details' => json_encode(array(
                'date_technical_report' => $data['date_technical_report'],
                'image_header' => $data['image_header'],
                'details' => $data['details'],
                'notes' => $data['notes'],
                'check_adm' => $data['check_adm'],
                'check_technical' => $data['check_technical'],
                'conclusion' => $data['conclusion'],
                'recommendation' => $data['recommendation'],
            )),
            'details_images' => json_encode($data['details_images']),
        );
        
        $this->db->where('ot_id', $data['ot_id']);
        if($this->db->update('technical_report', $datos_tr)) return true; else return false;
    }
}
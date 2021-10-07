<?php
class KpiModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function kpiQuotation ($data) { 
       
       if( $data['period'] == 2) { // month by year 
             
        $this->db->select(' month, kpi_quotation');
        $this->db->from('record');
        $this->db->where('year', $data['year'] );
        $this->db->where('month', $data['month'] );
        $query = $this->db->get(); 
        return $query->result();

       }else {// by year 

        $this->db->select_avg('kpi_quotation');
        $this->db->from('record');
        $this->db->where('year', $data['year']);
        $query = $this->db->get(); 
        $kpi = $query->row_array();
        if($kpi['kpi_quotation']){
            return $query->result();
        }else { 
            return false;
        }

       }
  

    }


    public function kpiProduction($data) { 
       
        if( $data['period'] == 2) { // month by year 
              
         $this->db->select(' month, kpi_production');
         $this->db->from('record');
         $this->db->where('year', $data['year'] );
         $this->db->where('month', $data['month'] );
         $query = $this->db->get(); 
         return $query->result();
 
        }else {// by year 
 
         $this->db->select_avg('kpi_production');
         $this->db->from('record');
         $this->db->where('year', $data['year']);
         $query = $this->db->get(); 
         $kpi = $query->row_array();
         if($kpi['kpi_production']){
             return $query->result();
         }else { 
             return false;
         }
 
        }
   
 
     }
   
 
}
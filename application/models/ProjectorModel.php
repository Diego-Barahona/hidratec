<?php
class ProjectorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function getKpiQuotation() { 


        // date_admission -> ingreso data 
        // date_quotation -> fecha de cotizacion 
        // date _reparation -> fecha reparacion 
        // date_cellar -> fecha de bodega 
        // days_quotation y days_reparation 
       
        
        $query1 = "SELECT  AVG(5 * (DATEDIFF( ot.date_quotation,ot.date_admission) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(ot.date_admission) + WEEKDAY(ot.date_quotation) + 1, 1)) as kpi_quotation
                   FROM ot
                   WHERE  ot.date_quotation IS NOT NULL 
                   ";

        $value = $this->db->query($query1)->row_array();
         

        return $value ;
        
    
         // suma todas las condiciones  sera el valor final 

    }




    public function getKpiProduction() { 

        $a = date('m');
        // date_admission -> ingreso data 
        // date_quotation -> fecha de cotizacion 
        // date _reparation -> fecha reparacion 
        // date_cellar -> fecha de bodega 
        $query1 = "SELECT  AVG(5 * (DATEDIFF( ot.date_cellar,ot.date_reparation) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(ot.date_reparation) + WEEKDAY(ot.date_cellar) + 1, 1)) as kpi_reparation
                   FROM ot
                   WHERE  ot.date_cellar IS NOT NULL AND ot.date_cellar IS NOT NULL AND MONTH(ot.date_cellar) = $a
                   ";

        $value = $this->db->query($query1)->row_array();
        return $value ;
         // suma todas las condiciones  sera el valor final 

    }

    public function getOrders(){
        $query = "SELECT ot.id number_ot, u.full_name technical, ot.type_service service, ot.days_reparation dias_rep, ot.date_reparation fecha_rep ,c.name component 
            FROM ot
            LEFT JOIN component c ON ot.component_id = c.id
            LEFT JOIN ot_state os ON ot.id = os.ot_id
            LEFT JOIN reparation r ON ot.id = r.ot_id
            LEFT JOIN user u ON r.user_assignment = u.id
            LEFT JOIN state s ON os.state_id = s.id
            WHERE r.check_adm = 0 AND os.state_id = 4 AND os.id = (
                SELECT f.id 
                FROM ot_state f 
                WHERE f.ot_id = ot.id AND f.date_update = (
                      SELECT MAX(j.date_update)
                      FROM ot_state j
                      WHERE j.ot_id = ot_id
                    ) 
              )    
            "; 
            return $this->db->query($query)->result();
    }

}

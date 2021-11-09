<?php
class ProjectorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function getKpiQuotation() { 
        $a = date('m');
        $query1 = "SELECT  AVG(5 * (DATEDIFF( ot.date_quotation,ot.date_admission) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(ot.date_admission) + WEEKDAY(ot.date_quotation) + 1, 1)) as kpi_quotation
                   FROM ot
                   WHERE  ot.date_quotation IS NOT NULL and ot.date_admission  IS NOT NULL and MONTH(ot.date_quotation) = $a
                   ";

        $value = $this->db->query($query1)->row_array();
        return $value ;
        
    }




    public function getKpiProduction() { 

        $a = date('m');
        // date_admission -> ingreso data 
        // date_quotation -> fecha de cotizacion 
        // date _reparation -> fecha reparacion 
        // date_cellar -> fecha de bodega 
        $query1 = "SELECT  AVG(5 * (DATEDIFF( ot.date_cellar, ot.date_reparation) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(ot.date_reparation) + WEEKDAY(ot.date_cellar) + 1, 1)) as kpi_reparation
                   FROM ot
                   WHERE  ot.date_cellar IS NOT NULL AND ot.date_reparation IS NOT NULL AND MONTH(ot.date_cellar) = $a
                   ";

        $value = $this->db->query($query1)->row_array();
        return $value ;
         // suma todas las condiciones  sera el valor final 

    }

    public function getOrders(){
        date_default_timezone_set("America/Santiago");
        $a = date("Y-m-d");
        $query = "SELECT r.date_reparation, ot.id number_ot, u.full_name technical, ot.type_service service, ot.days_reparation dias_rep, r.date_assignment date_assignment ,c.name component,
            5 * (DATEDIFF( '$a' , r.date_assignment) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(r.date_assignment) + WEEKDAY('$a') + 1, 1) as days_passed
            FROM ot
            JOIN component c ON ot.component_id = c.id
            JOIN reparation r ON ot.id = r.ot_id
            JOIN user u ON r.user_assignment = u.id
            WHERE r.check_adm = 0 AND r.user_assignment IS NOT NULL 
            "; 
            return $this->db->query($query)->result();
    }

}

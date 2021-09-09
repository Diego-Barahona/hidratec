<?php
class ProjectorModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function getKpiQuotation($month) { 
        
        $query1 = "SELECT  AVG(5 * (DATEDIFF( ot.date_quotation,ot.date_admission) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(ot.date_admission) + WEEKDAY(ot.date_quotation) + 1, 1)) as kpi_quotation
                   FROM ot
                   WHERE  ot.date_quotation IS NOT NULL and ot.date_admission  IS NOT NULL and MONTH(ot.date_quotation) = $month
                   ";

        $value = $this->db->query($query1)->row_array();
        return $value ;
        
    }




    public function getKpiReparation() { 

        // date_admission -> ingreso data 
        // date_quotation -> fecha de cotizacion 
        // date _reparation -> fecha reparacion 
        // date_cellar -> fecha de bodega 
        $query1 = "SELECT  AVG(5 * (DATEDIFF( ot.date_cellar,ot.date_reparation) DIV 7) + MID('0123455401234434012332340122123401101234000123450', 7 * WEEKDAY(ot.date_reparation) + WEEKDAY(ot.date_cellar) + 1, 1)) as kpi_reparation
                   FROM ot
                   WHERE  ot.date_quotation IS NOT NULL 
                   ";

        $value = $this->db->query($query1)->row_array();
        return $value ;
         // suma todas las condiciones  sera el valor final 

    }






 
}

<?php

class EvaluationModel extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEvaluationByOrder($id){
        
        
        $query= "SELECT e.details , u.full_name , e.user_assignment,e.state,e.export,e.user_interaction,e.priority,e.location
        FROM evaluation e
        LEFT JOIN user_role ur ON ur.user_id = e.user_assignment
        LEFT JOIN user u ON u.id = ur.user_id
        WHERE e.ot_id = ? AND e.state = ? ";
        
        return $this->db->query($query, array($id,true))->result(); 

           
      
    }

    public function editEvaluation($id,$data){

        $user= $_SESSION['full_name'];
        $date=  date('Y-m-d H:i:s');

        $date_approve="";
        $user_approve="";
        $user_create="";
        $date_create="";
        $priority = $data['priority'];
        $location = $data['location'];
        $technical = $data['technical'];

        if($data['approve_technical'] == "true" && $data['check_technical_old'] == "false"){
             $this->setTimeEnd($id);
            $date_create= $date;
            $user_create= $user;
           
        }else  if($data['approve_technical'] == "true" &&  $data['check_technical_old'] == "true"){
                   
                     $date_create= $data['date_create'];
                     $user_create= $data['user_create'];
                    }else {
 
                    $date_create="";
                    $user_create="";

                        }


      
        if($data['approve_admin'] == "true" && $data['check_admin_old'] == "false"){
      
            $date_approve= $date;
            $user_approve= $user;
           
        }else  if($data['approve_admin'] == "true" &&  $data['check_admin_old'] == "true"){
                  
                     $date_approve= $data['date_approve'];
                     $user_approve= $data['user_approve'];
                    }else {
 
                    $date_approve="";
                    $user_approve="";
                        }

        
        $details= json_encode ( array( 
            "ot"=>$id,
            "date_evaluation"=> $data['date_evaluation'],
            "description"=> $data['description'],
            "notes" => $data['notes'],
            "approve_technical" => $data['approve_technical'],
            "approve_admin" => $data['approve_admin']
             )
        );

        $user_interaction= json_encode ( array( 
        
            "user_create"=> $user_create,
            "date_create"=> $date_create,
            "user_modify"=> $user,
            "date_modify"=> $date,
            "user_approve"=> $user_approve,
            "date_approve"=> $date_approve,
            )
        );


        $query = "UPDATE evaluation SET details = ? , user_assignment = ? , user_interaction = ? , priority = ? , evaluation.location = ?  WHERE ot_id = ?";
            return $this->db->query($query, array($details,$technical,$user_interaction,$priority,$location,$id));  
    }  


    public function pdfEvaluation($id,$new){
  //  unlink('./'.$old);
    $query = "UPDATE evaluation SET export = ? WHERE ot_id = ?";
    return $this->db->query($query, array($new,$id));  
    }

    public function setTimeEnd($ot_id){
        date_default_timezone_set("America/Santiago");
        $date_end = date("Y-m-d G:i:s");
        $date1 = new DateTime($date_end);
       
    
        $query= "SELECT ev.time_init, ev.hours
        FROM evaluation ev
        WHERE ev.ot_id = ?";
        $evaluation = $this->db->query($query, array($ot_id))->result_array(); 
    
        $hoursData = $evaluation [0]['hours'];
    
    
        $date_init = $evaluation [0]['time_init'];
        $date2 = new DateTime($date_init);
    
        $interval = $date1->diff($date2);
    
        $year = (int)$interval->format('%y');
        $month = (int)$interval->format('%m');
        $day = (int)$interval->format('%d');
        $hour = (int)$interval->format('%h');
        $minute = (int)$interval->format('%i');
        $second = (int)$interval->format('%s seconds');
    
        if($minute != 0){
            $minute = $minute * 60;
        }
    
        if($hour != 0){
            $hour = $hour * 3600;
        }
    
        if($day != 0){
            $day = $day * 86400;
        }
    
        $meses = 0;
        if($month != 0){ 
        /*     $month = $day * 86400; */
            $año = date("Y", strtotime($date_init));
            $mes = date("m", strtotime($date_init));
    
            for($i=0; $i<$month; $i++){
                $aux = (int)$mes + $i;
                $cantDays = date('t', strtotime($año.'-'.$aux.'-05'));
                $meses = $meses + ($cantDays*86400);
            }
        }
    
        $suma = $minute + $hour + $day + $meses + $second;
        $hoursTotal = ($suma/3600) + $hoursData;
    
        $datos = array(
            'time_end' => $date_end,
            'time_init' => null,
            'aux' => null,
            'hours' => $hoursTotal,
        );
        $this->db->where('ot_id', $ot_id);
        if($this->db->update('evaluation', $datos)) return true; else return false;
    }
          





}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . '/third_party/FPDF/fpdf.php';

class Fpdf_lib extends FPDF
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    
    public function pdfEvaluation($data)
    {
        $pdf = new FPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Image(base_url() . "/assets/img/team/2927262.jpg", 70, 8, 60);
        $pdf->Ln(40);
        $pdf->SetFillColor(250, 250, 250);
        $pdf->SetFont('Arial', 'B', 26);
        $pdf->Cell(60);
        $pdf->Cell(60, 10,  utf8_decode('Hidratec Evaluación'), 0, 1, 'C', 1);
     
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60);
        $pdf->Cell(70, 5, utf8_decode('Sistemas Oleohidráulicos'), 0, 1, 'C', 1);
        $pdf->Ln(10);

        //BODY PDF
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->Cell(40, 6, 'Fecha', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'OT', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Notas', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Tecnico', 1, 1, 'C', 1);
      //date('Y-m-d H:i:s') sacar datos de fecha
        $pdf->SetFillColor(250, 250, 250);
        $pdf->Cell(40, 6, date('Y-m-d H:i:s'), 1, 0, 'C', 1);
       // $pdf->Cell(50, 6, $dataTicket[0]->nombreempresa, 1, 0, 'C', 1);
        //$pdf->Cell(50, 6, $dataTicket[0]->nombrecliente, 1, 0, 'C', 1);
        //$pdf->Cell(50, 6, $dataTicket[0]->correo, 1, 1, 'C', 1);

        $pdf->SetFillColor(232, 232, 232);
        $pdf->Cell(40, 6, 'Telefono', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, utf8_decode('Dirección'), 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Presupuesto', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Vigencia', 1, 1, 'C', 1);

        //footer PDF
        $pdf->SetY(-15);

        $random = rand(0,100000);
        $name = "assets/upload/evaluation" . $random . ".pdf";
        $pdf->output("F", $name);
        return $name;
    }


    public function pdfTechnicalReport($ot_id, $report)
    {
     
        $enterprise = $report[0]['enterprise'];
        $component = $report[0]['component'];
        $data = json_decode($report[0]['data'],true);
        $data_images = json_decode($report[0]['data_images'],true);
        $data_interaction = json_decode($report[0]['data_interaction'],true);

        $details = $data['details'];
        $conclusion = $data['conclusion'];
        $recommendation = $data['recommendation'];

        $technical = $data_interaction['user_create'];
        $head_service = $data_interaction['user_approve'];

        $pdf = new FPDF();
        $this->tr_header($pdf, $ot_id);
        
        /*Body*/
        $pdf->Image('http://localhost/hidrat/assets/upload/technicalReport/cabecera.jpg',110,70,90); 
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->SetTextColor(19,66,115);
        $pdf->Cell(200, 5,  utf8_decode('Antecedentes Generales'), 0, 0, 'C');     
        $pdf->Ln(10);


        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(70, 5,  utf8_decode('Cliente'), 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetLineWidth(0.5);
        $pdf->SetDrawColor(19,66,115);
        $pdf->MultiCell(92.6, 1, '________________________________', 0,'L',0);
            $pdf->Ln(7);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetLineWidth(0.2);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(255,255,255);
            $pdf->MultiCell(90,10,utf8_decode($enterprise),1,'C',1);
        
        $pdf->Ln(20);
        

        $pdf->SetTextColor(19,66,115);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(70, 5,  utf8_decode('Servicio'), 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetLineWidth(0.5);
        $pdf->SetDrawColor(19,66,115);
        $pdf->MultiCell(92.6, 1, '________________________________', 0,'L',0);
            $pdf->Ln(7);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetLineWidth(0.2);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(255,255,255);
            $pdf->Cell(30,10, utf8_decode('Jefe de Servicio'),1,0,'C',1);
            $pdf->MultiCell(60,10, utf8_decode($head_service),1,'C',1);
            $pdf->Cell(30,10, utf8_decode('Técnico Evaluador'),1,0,'C',1);
            $pdf->MultiCell(60,10, utf8_decode($technical),1,'C',1);
       
        $pdf->Ln(20);

        $pdf->SetTextColor(19,66,115);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(70, 5,  utf8_decode('Componente'), 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetLineWidth(0.5);
        $pdf->SetDrawColor(19,66,115);
        $pdf->MultiCell(92.6, 1, '________________________________', 0,'L',0);
            $pdf->Ln(7);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetLineWidth(0.2);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(255,255,255);
            $pdf->MultiCell(90,10, utf8_decode($component),1,'C',1);
        
        $pdf->Ln(20);

        $pdf->SetTextColor(19,66,115);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(70, 5,  utf8_decode('Detalles'), 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetLineWidth(0.5);
        $pdf->SetDrawColor(19,66,115);
        $pdf->MultiCell(92.6, 1, '________________________________', 0,'L',0);
            $pdf->Ln(7);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetLineWidth(0.2);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(255,255,255);
            $pdf->MultiCell(90,10, utf8_decode($details),1,'C',1);

        //footer PDF
        $this->tr_footer($pdf, $ot_id);

        $name = "assets/upload/technicalReport/technical_report_" . $ot_id . ".pdf";


        /* Página Detalles informe técnico*/
        $cont = 1;

        /* for($i=1; $i<= count($data_images); $i++){
            list($x1, $y1) = getimagesize('http://localhost/hidrat/assets/upload/'.$data_images[$i]['image']);
            $x = 0;
            $y = 0;
            $x_image = 0;
            if($x1 > $y1) {
                $x = 60;
                $y = 0;
                $x_image = 20;
            } else {
                $x = 0;
                $y = 55;
                $x_image = 30;
            }
            if($cont == 1){
                $this->tr_header($pdf, $ot_id);

                $pdf->SetFont('Arial', 'B', 15);
                $pdf->SetTextColor(19,66,115);
                $pdf->Cell(200, 5,  utf8_decode('Detalle Informe Técnico'), 0, 0, 'C');     
                $pdf->Ln(10); */

                /* $charactersName = strlen($recommendation);
                $total = ceil($charactersName/50); */

/* 
                $pdf->MultiCell(80, 59, $pdf->Image('http://localhost/hidrat/assets/upload/'.$data_images[$i]['image'],$x_image,52,$x, $y) , 1, 'C');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetY(50);
                $pdf->SetX(90);
                
                $pdf->MultiCell(120,10, $data_images[$i]['name'], 1, 'L');
    
    
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetY(60);
                $pdf->SetX(90);
                $pdf->MultiCell(120,10, $data_images[$i]['description'], 1, 'L');
                $pdf->SetY(60);
                $pdf->SetX(90); 
                $pdf->MultiCell(120, 49, '' , 1, 'J'); 
                $pdf->Ln(5);
            }else if($cont == 2){ */
              /*   $pdf->MultiCell(80, 58, $pdf->Image('http://localhost/hidrat/assets/upload/'.$data_images[$i]['image'],$x_image,115,$x, $y) , 1, 'C');
                
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetY(114);
                $pdf->SetX(90);
                $pdf->MultiCell(120,10, $data_images[$i]['name'] , 1, 'L');
        
        
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetY(124);
                $pdf->SetX(90);
                $pdf->MultiCell(0,6, $data_images[$i]['description'] , 0, 'L');
                $pdf->SetY(114);
                $pdf->SetX(90);
                $pdf->MultiCell(120, 58, '' , 1, 'J');
                $pdf->Ln(5); */
          /*   }else if($cont == 3){ */
               /*  $pdf->MultiCell(80, 58, $pdf->Image('http://localhost/hidrat/assets/upload/'.$data_images[$i]['image'],$x_image,181,$x, $y) , 1, 'C');
                
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetY(177);
                $pdf->SetX(90);
                $pdf->MultiCell(120,10, $data_images[$i]['name'] , 1, 'L');
        
        
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetY(187);
                $pdf->SetX(90);
                $pdf->MultiCell(0,6, $data_images[$i]['description'] , 0, 'L');
                $pdf->SetY(177);
                $pdf->SetX(90);
                $pdf->MultiCell(120, 58, '' , 1, 'J');
                $this->tr_footer($pdf, $ot_id);
                $cont = 0; */
            /* }
            $cont++; */
        //}

        /* Página conclusion y recomendacion*/
        $this->tr_header($pdf, $ot_id);


        $pdf->SetFont('Arial', 'B', 15);
        $pdf->SetTextColor(19,66,115);
        $pdf->Cell(200, 5,  utf8_decode('Conclusión y Recomendación'), 0, 0, 'C');     
        $pdf->Ln(10);


        $pdf->SetTextColor(19,66,115);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50,6,utf8_decode('Conclusión'),0,0,'J');
        $pdf->Ln(10);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf-> MultiCell(0, 6 , utf8_decode($conclusion) ,1 ,'J'); // 
        $pdf->Ln(10);

        $pdf->SetTextColor(19,66,115);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50,6,utf8_decode('Recomendación'),0,0,'J');
        $pdf->Ln(10);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf-> MultiCell(0, 6 , utf8_decode($recommendation) ,1 ,'J'); // 
        $pdf->Ln(10);


        //footer PDF
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(19,66,115);
        $this->tr_footer($pdf, $ot_id);
        $pdf->output("F", $name);
        return $name;
    }

    public function tr_header($pdf, $ot_id){
        $pdf->AddPage('PORTRAIT','LETTER');
        /*Header*/
        $pdf->Image('http://localhost/hidrat/assets/upload/technicalReport/tr_img_cabecera.png',10,8,50,0,'png'); 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(19,66,115);
        $pdf->SetX(-50);
        $pdf->Write(10, 'Fecha: 12/05/20121');
        $pdf->SetDrawColor(19,66,115);
        $pdf->Line(10,22,200,22);
        $pdf->Ln(20);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', 'BU', 15);
        $pdf->Cell(0, 5,  utf8_decode('Informe Técnico Orden de Trabajo '.$ot_id), 0, 0, 'C');
        $pdf->Ln(10);
    }

    public function tr_footer($pdf, $ot_id){
        //footer PDF
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(19,66,115);
        $pdf->SetY(-28);
        $pdf->SetX(-28);
        $pdf->Write(5, utf8_decode('Página '.$pdf->PageNo()));
    }
}




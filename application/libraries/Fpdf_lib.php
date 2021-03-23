<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once APPPATH.'third_party/fpdf/fpdf.php';


class Fpdf_lib 
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
       
    }
    
    public function pdfEvaluation($data)
    {

      //$pdf = new PDF();
        $url="http://localhost/hidrat/";
        $pdf->AliasNbPages();
        $pdf->AddPage();
        //$pdf->Image( $url."assets/img/icon_hidratec.png", 70, 8, 60);
        //$pdf->Ln(60);
        $pdf->header->Image( $url."assets/img/icon_hidratec.png", 70, 8, 60);
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
        $pdf->Cell(50, 6, $data['id'], 1, 0, 'C', 1);
        $pdf->Cell(50, 6, $data['technical'], 1, 0, 'C', 1);
        $pdf->Cell(50, 6, $data['date_evaluation'], 1, 1, 'C', 1);

        $pdf->Ln(10);
        $pdf-> MultiCell(0, 10 , $data['description'] ,1 ,'C'); // 
        $pdf->Ln(30);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->Cell(40, 6, 'Telefono', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, utf8_decode('Dirección'), 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Presupuesto', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Vigencia', 1, 1, 'C', 1);

        $random = rand(0,100000);
        $name = "assets/upload/evaluation" . $random . ".pdf";
        $pdf->output("F", $name);
        return $name;
    }
}

 

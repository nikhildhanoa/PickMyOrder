<?php

 include_once('fpdf/fpdf.php');

 class PDF extends FPDF
        {
                // Page header
                function Header()
                {
                    // Logo
                   //$this->Image('logo.png',10,-1,70);
                    $this->SetFont('Arial','B',13); 
                    // Move to the right
                    $this->Cell(80);
                    // Title
                    $this->Cell(50,10,'VANS DETAILS',1,0,'C');
                    // Line break
                    $this->Ln(20);
                }
        
                // Page footer
                function Footer()
                {
                    // Position at 1.5 cm from bottom
                    $this->SetY(-15);
                    // Arial italic 8
                    $this->SetFont('Arial','I',8);
                    // Page number
                    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
                }
        }
$pdf = new PDF();




//header
$pdf->AddPage();

//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);




$pdf->Cell(30,10,'DRIVER NAME',1);
$pdf->Cell(40,10,'VEHICLE REGISTRATION',1);
$pdf->Cell(25,10,'MAKE',1);
$pdf->Cell(25,10,'MODEL',1);
$pdf->Cell(25,10,'TYPE',1);
$pdf->Cell(40,10,'ENGINEER',1,1);

foreach($values as $value)
{
			
				
				$pdf->Cell(30,10,$value['driver_name'],1);
				$pdf->Cell(40,10,$value['vehicle_registration'],1);
				$pdf->Cell(25,10,$value['make'],1);
				$pdf->Cell(25,10,$value['model'],1);
				$pdf->Cell(25,10,$value['type'],1);
				$pdf->Cell(40,10,$value['user_name'],1,1);
			
}

		



$pdf->Output();
?>
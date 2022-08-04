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
                    $this->Cell(60,10,'STORES DETAILS',1,0,'C');
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



$pdf->Cell(55,15,' NAME',1);
$pdf->Cell(30,15,'USER_NAME',1);
$pdf->Cell(55,15,'EMAIL ADDRESS',1,1);

foreach($values as $value)
{
	

	

				
				$pdf->Cell(55,15,$value['name'],1);
				$pdf->Cell(30,15,$value['user_name'],1);
				$pdf->Cell(55,15,$value['email'],1,1);
			
}

		



$pdf->Output();
?>
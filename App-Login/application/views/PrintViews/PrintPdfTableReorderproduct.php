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
                    $this->Cell(50,10,'REORDER PRODUCTS',1,0,'C');
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


$pdf->Cell(23,15,'PO NUMBER',1);
$pdf->Cell(20,15,'DATE',1);
$pdf->Cell(30,15,'PROJECT',1);
$pdf->Cell(35,15,'ORDER DESCRIPTION',1);
$pdf->Cell(29,15,'TOTAL EX VAT',1);
$pdf->Cell(29,15,'TOTAL INC VAT',1);
$pdf->Cell(30,15,'ORDER TYPE',1,1);

foreach($values as $value)
{
$order="Reorder";
	
				$pdf->Cell(23,15,$value['po_number'],1);
				$pdf->Cell(20,15,$value['date'],1);
				$pdf->Cell(30,15,$value['givenprojectname'],1);
				$pdf->Cell(35,15,$value['odrdescrp'],1);
				$pdf->Cell(29,15,$value['total_ex_vat'],1);
				$pdf->Cell(29,15,$value['total_inc_vat'],1);
				$pdf->Cell(30,15,$order,1,1);		
}

		



$pdf->Output();
?>
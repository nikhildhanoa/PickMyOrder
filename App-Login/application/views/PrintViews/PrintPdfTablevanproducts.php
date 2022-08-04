<?php
if(isset($driverdata))
{
	$driver_name=$driverdata[0]['driver_name'];
	$vehicle_registration=$driverdata[0]['vehicle_registration'];
	
}
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
                    $this->Cell(55,10,'VANPRODUCT DETAILS',1,0,'C');
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

$pdf->Cell(20,5,'driver name:',1);
$pdf->Cell(35,5,$driverdata[0]['driver_name'],1);
$pdf->Ln(8);
$pdf->Cell(30,5,'Vehicle Registration:',1);
$pdf->Cell(35,5,$driverdata[0]['vehicle_registration'],1);
$pdf->Ln(20);
$pdf->Cell(35,15,' PRODUCT TITLE',1);
$pdf->Cell(35,15,'SKU',1);
$pdf->Cell(28,15,'STOCKLEVEL',1);
$pdf->Cell(28,15,'REORDERLEVEL',1);
$pdf->Cell(28,15,'IN STOCK',1);
$pdf->Cell(28,15,'ON ORDER ',1,1);

foreach($values as $value)
{
	
			
				
				$pdf->Cell(35,15,$value['title'],1);
				$pdf->Cell(35,15,$value['SKU'],1);
				$pdf->Cell(28,15,$value['stocklevel'],1);
				$pdf->Cell(28,15,$value['recordlevel'],1);
				$pdf->Cell(28,15,$value['in_stock'],1);
				$pdf->Cell(28,15,$value['toback_instock'],1,1);
			
}

		



$pdf->Output();
?>
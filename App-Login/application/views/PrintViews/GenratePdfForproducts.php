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
                    $this->Cell(50,10,'PRODUCTS DETAILS',1,0,'C');
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



$pdf->Cell(50,15,'PRODUCT TITLE',1);
$pdf->Cell(50,15,'SKU',1);
$pdf->Cell(50,15,'STATUS',1,1);

foreach($values as $value)
{
	$text = explode(' ', $value['title']);
	for($i=0;$i<count($text);$i++)
	{
		if($i%3==0)
		{
			$text[$i]='\n'.$text[$i];
		}	
	}
	$value['title']=implode(' ',$text);
	
				if($value['publish_status']=='1'){ $satus= "publish";}else{$satus= "Unpublish";}
				
				$pdf->Cell(50,15,$value['title'],1);
				$pdf->Cell(50,15,$value['SKU'],1);
				$pdf->Cell(50,15,$satus,1,1);
			
}

		



$pdf->Output();
?>
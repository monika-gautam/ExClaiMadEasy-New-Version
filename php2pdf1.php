<?php

require( 'fpdf.php'); 
class PDF extends FPDF {
 function Header() {
     $this->Image("start.jpg", 2.5, 0.0, 4, 1, "JPG", "http://www.athenaguru.com");
     $this->SetY(0.50);
    $this->Cell(0,0.25, "                     visit us at http://www.athenaguru.com", '', "j");
   $this->SetFont('Times','',12);
    $this->SetY(0.25);
    $this->Cell(0, .25, $this->PageNo(), '', 2, "R");
    //reset Y
    $this->SetY(1);}
 function Footer() {
//This is the footer; it's repeated on each page.
//enter filename: phpjabber logo, x position: (page width/2)-half the picture size,
//y position: rough estimate, width, height, filetype, link: click it!
    $this->Image("start.jpg", (8.5/2)-1.5, 9.8, 3, 1, "JPG", "http://www.phpjabbers.com");
}
}
 //class instantiation
$pdf=new PDF("P","in","Letter");
$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$lipsum1="Name";
$lipsum4="Ram";
//$lipsum2="Nibh lectus, pede fusce ullamcorper vel porttitor.";
//$lipsum3 ="Duis maecenas et curabitur, felis dolor.";
$pdf->SetFillColor(240, 100, 100);
$pdf->SetFont('Times','BU',12);
//Cell(float w[,float h[,string txt[,mixed border[,
//int ln[,string align[,boolean fill[,mixed link]]]]]]])
$pdf->Cell(0, .25, "Your Details", 1, 2, "C", 1);  
$pdf->SetFont('Times','',12);
//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
$pdf->SetFont('Times','B',12);
$pdf->Cell(0, 0.25, $lipsum1, 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
 $pdf->Cell(0,0.25, $lipsum4, 'R', "j");

$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(1.50);
$pdf->Cell(0,0.25, "Emailid", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(1.75);

$pdf->Cell(0,0.25, "Parents Name", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(2);

$pdf->Cell(0,0.25, "Sex", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(2.25);

$pdf->Cell(0,0.25, "Your Address", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(2.50);

$pdf->Cell(0,0.25, "DOB", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(2.75);

$pdf->Cell(0,0.25, "Applying For Class", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");

$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(3);
$pdf->Cell(0,0.25, "School Name", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(3.25);

$pdf->Cell(0,0.25, "School Address", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");

$pdf->SetFont('Times','B',12); 
$pdf->SetX(2);
$pdf->SetY(3.50);
$pdf->Cell(0,0.25, "Board", 'L', "L");
$pdf->SetFont('Times','',12);
$pdf->SetX(4);
$pdf->Cell(0,0.25, $lipsum4, 'R', "j");
//$pdf->SetX(2);
//$pdf->SetY(15);
//$pdf->Cell(0,0.25, "                     visit us at http://www.athenaguru.com", '', "j");

//$pdf->AddPage();

$pdf->Output();
?>
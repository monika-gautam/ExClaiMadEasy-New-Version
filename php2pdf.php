<?php
require( 'fpdf.php'); 
class PDF extends FPDF {
 function Header() {
     //$this->Image("start.jpg", 1.0, 1.0, 3, 1, "JPG", "http://www.athenaguru.com");
   $this->SetFont('Times','',12);
    $this->SetY(0.25);
    $this->Cell(0, .25, "John Doe ".$this->PageNo(), 'T', 2, "R");
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
$lipsum1="Lorem ipsum dolor sit amet, nam aliquam dolore est, est in eget.";
$lipsum2="Nibh lectus, pede fusce ullamcorper vel porttitor.";
$lipsum3 ="Duis maecenas et curabitur, felis dolor.";
$pdf->SetFillColor(240, 100, 100);
$pdf->SetFont('Times','BU',12);
//Cell(float w[,float h[,string txt[,mixed border[,
//int ln[,string align[,boolean fill[,mixed link]]]]]]])
$pdf->Cell(0, .25, "lipsum", 1, 2, "C", 1);  
$pdf->SetFont('Times','',12);
//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
$pdf->MultiCell(0, 0.5, $lipsum1, 'LR', "L");
$pdf->MultiCell(0, 0.25, $lipsum2, 1, "R");
$pdf->MultiCell(0, 0.15, $lipsum3, 'B', "J");
$pdf->AddPage();
$pdf->Write(0.5, $lipsum1.$lipsum2.$lipsum3);
$pdf->Output();
?>
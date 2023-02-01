<?php
include 'db_conn.php';
require('fpdf/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$pdf = new FPDF();

if(isset($_POST['invoice_order']))
{
    $customer_firstname = $_POST['customer_firstname'] ;
    $customer_address = $_POST['customer_address'] ;
    $customer_number = $_POST['customer_number'] ;
    $customer_lastname = $_POST['customer_lastname'];
    $fullname = $customer_firstname.' '.$customer_lastname;
    $date_analytics = $_POST['date_analytics'];
    $ordered_product_id = $_POST['ordered_product_id'];
    $customer_id = $_POST['customer_id'];
    $ordered_product = $_POST['ordered_product'];
    $sub_total = $_POST['sub_total'];


$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Cell(130,5, 'Heavens Plate', 0,0);
$pdf->Cell(59,5, 'Invoice', 0, 1);

$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Fidel St. Tondo',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Manila',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5, $date_analytics,0,1);//end of line

$pdf->Cell(130	,5,'Phone# [09186538193]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$ordered_product_id,0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'CustomerID',0,0);
$pdf->Cell(34	,5,$customer_id,0,1);//end of line

//billing address
$pdf->SetFont('Arial','B',14);
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->SetFont('Arial','',12);
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$fullname ,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$customer_address,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$customer_number,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line
//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'products',1,0);
$pdf->Cell(34	,5,'Total',1,1);//end of line

$pdf->SetFont('Arial','',12);
//summary
$pdf->Cell(130	,5,$ordered_product,1,0);
$pdf->Cell(34	,5,$sub_total,1,1);//end of line

$pdf->SetFont('Arial','B',12);
//summary
$pdf->Cell(130	,5,'Sub Total',1,0);
$pdf->Cell(34	,5, number_format($sub_total,2),1,1);//end of line


$pdf->Output();
}
?>
<?php
require('../fpdf186/fpdf.php');
include('../connection.php');

$id = $_GET['driver_id'];

$sql = mysqli_query($con, "SELECT * FROM drivers WHERE driver_id = '$id'");
$row = mysqli_fetch_assoc($sql);

$name1=$row['driver_name'];
$age1=$row['driver_age'];
$address1=$row['driver_address'];
$contact1=$row['driver_contact'];
$image1=$row['driver_image'];

$pdf = new FPDF();
$pdf->AddPage('L','A4','0');

$pdf->Ln(10);

//------------------------------------------------------------------------------------------------------------

$pdf->SetFont('Arial','B',30);
$pdf->Cell(0,10,'Driver Details',0,1,'C');

//------------------------------------------------------------------------------------------------------------

$pdf->Ln(20);

$pdf->setFillColor(169,169,169);
$pdf->Cell(100,60,' ',0,0,'C'); 
$pdf->Cell(78,65,' ',1,0,'C',true);
$pdf->Cell(20,60,' ',0,1,'C');

//------------------------------------------------------------------------------------------------------------

$pdf->Ln(20);

//------------------------------------------------------------------------------------------------------------

$pdf->SetFont('Arial','B',20);

$pdf->Cell(137.5,10,"Name",0,0,'C');
$pdf->Cell(137.5,10,"Age",0,1,'C');

$pdf->SetFont('Arial','',20);

$pdf->Cell(137.5,10,"$name1",0,0,'C');
$pdf->Cell(137.5,10,"$age1",0,1,'C');

//------------------------------------------------------------------------------------------------------------

$pdf->Ln(15);

$pdf->SetFont('Arial','B',20);

$pdf->Cell(137.5,10,"Address",0,0,'C');
$pdf->Cell(137.5,10,"Contact Number",0,1,'C');

$pdf->SetFont('Arial','',20);

$pdf->Cell(137.5,10,"$address1",0,0,'C');
$pdf->Cell(137.5,10,"$contact1",0,1,'C');

//------------------------------------------------------------------------------------------------------------

$pdf->Image('../images/drivers/'.$image1,103.5,54.5,90,60);

$pdf->Output();
?>

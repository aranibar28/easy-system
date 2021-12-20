<?php
$pdf->setXY(2, 1.5);
$pdf->MultiCell(73, 4.2, $empresa, 0, 'C', 0, 1);

$pdf->setXY(2, 10);
$pdf->SetFont('Arial', '', 6.9);
$pdf->MultiCell(73, 4.2, $direccion, 0, 'C', 0, 1);

$get_YD = $pdf->GetY();

$pdf->setXY(2, 6);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(73, 4.2, $propietario, 0, 'C', 0, 1);


$pdf->setXY(2, $get_YD);
$pdf->MultiCell(73, 4.2, 'NIT : ' . $nrc, 0, 'C', 0, 1);

/*INGRESAR EN ESTA LINEA EL TELEFONO DEL TICKET*/

$pdf->setXY(2, $get_YD + 4);
$pdf->MultiCell(73, 4.2, 'Telefono : 940994003', 0, 'C', 0, 1);


$pdf->setXY(2, $get_YD + 8);
$pdf->MultiCell(73, 4.2, 'Horario de Atencion:', 0, 'C', 0, 1);

$pdf->setXY(2, $get_YD + 12);
$pdf->MultiCell(73, 4.2, 'Lun - Sab 08:00 - 18:30', 0, 'C', 0, 1);

$pdf->setXY(2, $get_YD + 16);
$pdf->MultiCell(73, 4.2, 'Domingo de 10:00 - 14:00', 0, 'C', 0, 1);

//$pdf->setXY(2,$get_YD + 12);
//$pdf->MultiCell(73, 4.2, 'Fecha Resolucion : '.$fecha_resolucion, 0,'C',0 ,1);

$pdf->setXY(2, $get_YD + 21);
$pdf->MultiCell(73, 4.2, 'No se aceptan devoluciones', 0, 'C', 0, 1);


$get_YH = $pdf->GetY();

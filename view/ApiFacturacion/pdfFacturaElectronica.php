<?php

//librerias de PDF Y QR
require_once('fpdf/fpdf.php');

//librerias de AD
require_once('ado/clsCliente.php');
require_once('ado/clsCompartido.php');
require_once('ado/clsVenta.php');
require_once('ado/clsEmisor.php');

//otras librerias
require_once('cantidad_en_letras.php');

//crear objetos de AD
$objVenta = new clsVenta();
$objEmisor = new clsEmisor();
$objCliente = new clsCliente();
$objCompartido = new clsCompartido();

$id = $_GET['id']; //obteniendo el id de la venta

$venta = $objVenta->obtenerComprobanteId($id);
$venta = $venta->fetch(PDO::FETCH_NAMED);

$detalle = $objVenta->listarDetalleComprobanteId($id);

$emisor = $objEmisor->obtenerEmisor($venta['idemisor']);
$emisor = $emisor->fetch(PDO::FETCH_NAMED);

$tipo_comprobante = $objCompartido->obtenerComprobante($venta['tipocomp']);
$tipo_comprobante = $tipo_comprobante->fetch(PDO::FETCH_NAMED);

$cliente = $objCliente->consultarClientePorCodigo($venta['codcliente']);
$cliente = $cliente->fetch(PDO::FETCH_NAMED);

//Crear PDF - INICIO
$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Arial', 'B', 12);

$pdf->Image('logo_empresa.jpg', 60, 2, 25, 25);
$pdf->ln(20);

$pdf->SetFont('Arial', '', 8);
$pdf->cell(100,6, $emisor['ruc'] . ' - ' . $emisor['razon_social']);

$pdf->SetFont('Arial', 'B', 12);
$pdf->cell(80, 6, $emisor['ruc'], 'LRT', 1, 'C', 0);

$pdf->SetFont('Arial', '', 8);
$pdf->cell(100,6, $emisor['direccion']);

$pdf->SetFont('Arial', 'B', 12);
$pdf->cell(80, 6, $tipo_comprobante['descripcion'] . ' ELECTRONICA', 'LR', 1, 'C', 0);
$pdf->Cell(100);
$pdf->cell(80, 6, $venta['serie'] . ' - ' . $venta['correlativo'], 'BLR', 0, 'C', 0);

$pdf->SetAutoPageBreak('auto', 2);
$pdf->SetDisplayMode(75);

$pdf->Ln();

$pdf->SetFont('Arial', 'B', 8);
$pdf->cell(30 , 6, 'RUC/DNI:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', '', 8);
$pdf->cell(30 , 6, utf8_decode($cliente['nrodoc']), 0, 1, 'L', 0);

$pdf->SetFont('Arial', 'B', 8);
$pdf->cell(30 , 6, 'CLIENTE:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', '', 8);
$pdf->cell(30 , 6, utf8_decode($cliente['razon_social']), 0, 1, 'L', 0);

$pdf->SetFont('Arial', 'B', 8);
$pdf->cell(30 , 6, 'DIRECCION:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', '', 8);
$pdf->cell(30 , 6, utf8_decode($cliente['direccion']), 0, 1, 'L', 0);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 8);
$pdf->cell(10, 6, 'ITEM', 1, 0, 'C', 0);
$pdf->cell(20, 6, 'CANTIDAD', 1, 0, 'C', 0);
$pdf->cell(100, 6, 'PRODUCTO', 1, 0, 'C', 0);
$pdf->cell(20, 6, 'V.U.', 1, 0, 'C', 0);
$pdf->cell(25, 6, 'SUBTOTAL', 1, 1, 'C', 0);

$pdf->SetFont('Arial', '', 8);
while ($fila = $detalle->fetch(PDO::FETCH_NAMED)) {
    $pdf->Cell(10, 6, $fila['item'],1, 0, 'C', 0);
    $pdf->Cell(20, 6, $fila['cantidad'],1, 0, 'R', 0);
    $pdf->Cell(100, 6, $fila['nombre'],1, 0, 'L', 0);
    $pdf->Cell(20, 6, $fila['valor_unitario'],1, 0, 'R', 0);
    $pdf->Cell(25, 6, $fila['valor_total'], 1, 1, 'R', 0);
}

$pdf->cell(150, 6, 'OP. GRAVADAS', '', 0, 'R', 0);
$pdf->cell(25, 6, $venta['op_gravadas'], 1, 1, 'R', 0);

$pdf->cell(150, 6, 'OP. EXONERADAS', '', 0, 'R', 0);
$pdf->cell(25, 6, $venta['op_exoneradas'], 1, 1, 'R', 0);

$pdf->cell(150, 6, 'OP. INAFECTAS', '', 0, 'R', 0);
$pdf->cell(25, 6, $venta['op_inafectas'], 1, 1, 'R', 0);

$pdf->cell(150, 6, 'IGV', '', 0, 'R', 0);
$pdf->cell(25, 6, $venta['igv'], 1, 1, 'R', 0);

$pdf->cell(150, 6, 'TOTAL', '', 0, 'R', 0);
$pdf->cell(25, 6, $venta['total'], 1, 1, 'R', 0);

$pdf->ln(10);

$pdf->cell(160, 6, utf8_decode('SON: ' . CantidadEnLetra($venta['total'])), 0, 0, 'C', 0);

$pdf->ln(20);

//CODIGO QR
//RUC|TIPO DOC|SERIE|CORRELATIVO|IGV|TOTAL|FECHA EMISION|TIPO DOC CLIENTE|NUMERO DOC CLI|
$ruc = $emisor['ruc'];
$tipo_documento = $venta['tipocomp'];
$serie = $venta['serie'];
$correlativo = $venta['correlativo'];
$igv = $venta['igv'];
$total = $venta['total'];
$fecha = $venta['fecha_emision'];
$tipo_doc_cliente = $cliente['tipodoc'];
$nro_doc_cliente = $cliente['nrodoc'];

$nombrexml = $ruc . '-' . $tipo_documento . '-' . $serie . '-' . $correlativo;
$texto_qr = $ruc . '|' . $tipo_documento . '|' . $serie . '|' . $correlativo . '|' . $igv . '|' . $total . '|' . $fecha . '|' . $tipo_doc_cliente . '|' . $nro_doc_cliente;

$ruta_qr = $nombrexml . '.png';

require_once('phpqrcode/qrlib.php');
QRcode::png($texto_qr, $ruta_qr, 'Q', 15, 0);

$pdf->Image($ruta_qr, 80, $pdf->GetY(), 25,25);


$pdf->Ln(30);
$pdf->cell(160, 6, utf8_decode('Representación Impresa de la factura electrónica'), 0, 0, 'C', 0);
$pdf->Ln(10);
$pdf->cell(160, 6, utf8_decode('Este comprobante puede ser consultado en ceti.org.pe'), 0, 0, 'C', 0);

$pdf->Output('I', $nombrexml  . 'pdf');
//Crear PDF - FIN

?>
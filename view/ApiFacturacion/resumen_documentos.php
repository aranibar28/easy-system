<?php

require_once('xml.php');
require_once('ApiFacturacion.php');

$emisor = array(
    'tipodoc'       =>  '6',
    'ruc'           =>  '20123456789',
    'razon_social'  =>  'EMPRESA EMISORA S.A.',
    'nombre_comercial'  =>  'EMISOR S.A',
    'direccion'     =>  'SURCO - LIMA',
    'pais'          =>  'PE',
    'departamento'  =>  'LIMA',
    'provincia'     =>  'LIMA',
    'distrito'      =>  'LIMA',
    'ubigeo'        =>  '010101',
    'usuario_secundario'        =>  'MODDATOS',
    'clave_usuario_secundario'  =>  'MODDATOS'
);

$cabecera = array(
    'tipodoc'       =>  'RC', //RC: Resumen diario, RA: Resumen de anulaciones o bajas
    'serie'         =>  date('Ymd'), //fecha de envío
    'correlativo'   =>  1, //Numero de envio en el día
    'fecha_emision' =>  date('Y-m-d'),
    'fecha_envio'   =>  date('Y-m-d'),
);

$detalle = array();

$cant = 100;

for ($i=1; $i <= $cant; $i++) { 
    $item_total = rand(100, 600);
    $item_valor = $item_total / 1.18;
    $item_valor = (float) number_format($item_valor, 2,'.', 1);
    $item_igv = $item_total - $item_valor;

    $detalle[] = array(
        'item'              =>  $i,
        'tipodoc'           =>  '03',
        'serie'             =>  'B00' . rand(1,9),
        'correlativo'       =>  rand(1, 400000),
        'condicion'         =>  rand(1, 3),
        'moneda'            =>  'PEN',
        'importe_total'     =>  $item_total,
        'valor_total'       =>  $item_valor,
        'igv_total'         =>  $item_igv,
        'tipo_total'        =>  '01', //01: gravadas, 02:exo, 03: ina
        'codigo_afectacion' =>  '1000',
        'nombre_afectacion' =>  'IGV',
        'tipo_afectacion'   =>  'VAT'
    );
}

//PASO 01 CREAR EL XML DE RC - INICIO
$objXML = new GeneradorXML();
$nombreXML = $emisor['ruc'] . '-' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'];

$rutaXML = 'xml/';

$objXML->CrearXMLResumenDocumentos($emisor, $cabecera, $detalle, $rutaXML . $nombreXML);
echo 'PASO 01: XML DE RC(RESUMEN DIARIO) CREADO';

//PASO 01 CREAR EL XML DE RC - FIN

//PASO CONSUMO DE APIFACURACION
$objApi = new ApiFacturacion();
$ticket = $objApi->EnviarResumenComprobantes($emisor, $nombreXML);

//CONSULTAR TICKET
$objApi->ConsultarTicket($emisor, $cabecera, $ticket);

?>

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
    'tipodoc'       =>  'RA',
    'serie'         =>  date('Ymd'),
    'correlativo'   =>  1,
    'fecha_emision' =>  date('Y-m-d'),
    'fecha_envio'   =>  date('Y-m-d'),
);

$detalle = array();

$cant = 10;

for ($i=1; $i <= $cant ; $i++) { 
    $detalle[] = array(
        'item'      =>  $i,
        'tipodoc'   =>  '01',
        'serie'     =>  'F00' . rand(1, 9),
        'correlativo'   => rand(1, 50000),
        'motivo'    =>  'ERROR EN EL DOCUMENTO'
    );
}


//CREAR EL XML
$objXML = new GeneradorXML();
$nombreXML = $emisor['ruc'] . '-' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'];
$rutaXML = 'xml/';

$objXML->CrearXmlBajaDocumentos($emisor, $cabecera, $detalle, $rutaXML . $nombreXML);
echo '</br> PASO 01: XML DE BAJAS DE FACTURAS (RA - RESUMEN DE ANULACIONES) CREADA';

//ENVIAR A SUNAT
$objApi = new ApiFacturacion();
$ticket = $objApi->EnviarResumenComprobantes($emisor, $nombreXML);

//CONSULTAR EL TICKET
$objApi->ConsultarTicket($emisor, $cabecera, $ticket);
?>
<?php
  require('fpdf/fpdf.php');
  $idventa =  base64_decode(isset($_GET['venta']) ? $_GET['venta'] : '');

  class PDF_MC_Table extends FPDF
  {
  var $widths;
  var $aligns;

  function SetWidths($w)
  {
      //Set the array of column widths
      $this->widths=$w;
  }
  function SetAligns($a)
  {
      //Set the array of column alignments
      $this->aligns=$a;
  }

  function Row($data)
  {
      //Calculate the height of the row
      $nb=0;
      for($i=0;$i<count($data);$i++)
          $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
      $h=5*$nb;
      //Issue a page break first if needed
      $this->CheckPageBreak($h);
      //Draw the cells of the row
      for($i=0;$i<count($data);$i++)
      {
          $w=$this->widths[$i];
          $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
          //Save the current position
          $x=$this->GetX();
          $y=$this->GetY();
          //Draw the border
          $this->Rect($x,$y,$w,$h);
          //Print the text
          $this->MultiCell($w,5,$data[$i],0,$a);
          //Put the position to the right of the cell
          $this->SetXY($x+$w,$y);
      }
      //Go to the next line
      $this->Ln($h);
  }

  function CheckPageBreak($h)
  {
      //If the height h would cause an overflow, add a new page immediately
      if($this->GetY()+$h>$this->PageBreakTrigger)
          $this->AddPage($this->CurOrientation);
  }

  function NbLines($w,$txt)
  {
      //Computes the number of lines a MultiCell of width w will take
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
          $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r",'',$txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
          $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
          $c=$s[$i];
          if($c=="\n")
          {
              $i++;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
              continue;
          }
          if($c==' ')
              $sep=$i;
          $l+=$cw[$c];
          if($l>$wmax)
          {
              if($sep==-1)
              {
                  if($i==$j)
                      $i++;
              }
              else
                  $i=$sep+1;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
          }
          else
              $i++;
      }
      return $nl;
  }
  }

  try
  {
  function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

    $objVenta = new Venta();

    if($idventa == ""){
        $detalle = $objVenta->Imprimir_Factura_DetalleVenta('0');
        //$detalle = $objVenta->Imprimir_Ticket_DetalleVenta('0');
        $datos = $objVenta->Imprimir_Ticket_Venta('0');
    } else {
        $detalle = $objVenta->Imprimir_Factura_DetalleVenta($idventa);
        //$detalle = $objVenta->Imprimir_Ticket_DetalleVenta($idventa);
        $datos = $objVenta->Imprimir_Ticket_Venta($idventa);
    }

        foreach ($datos as $row => $column) {

            $tipo_comprobante = $column["p_tipo_comprobante"];
            $empresa = $column["p_empresa"];
            $propietario = $column["p_propietario"];
            $direccion = $column["p_direccion"];
            $numero_cedula = $column["p_numero_nit"];

            $fecha_resolucion = $column["p_fecha_resolucion"];
            $numero_resolucion = $column["p_numero_resolucion"];
            $serie = $column["p_serie"];
            $numero_comprobante = $column["p_numero_comprobante"];
            $empleado = $column["p_empleado"];
            $numero_venta = $column["p_numero_venta"];
            $fecha_venta = $column["p_fecha_venta"];
            $sumas = $column["p_sumas"];
            $iva = $column["p_iva"];
            $subtotal = $column["p_subtotal"];
            $exento = $column["p_exento"];
            $retenido = $column["p_retenido"];
            $descuento = $column["p_descuento"];
            $total = $column["p_total"];
            $numero_productos = $column["p_numero_productos"];
            $tipo_pago = $column["p_tipo_pago"];
            $efectivo = $column["p_pago_efectivo"];
            $pago_tarjeta = $column["p_pago_tarjeta"];
            $numero_tarjeta = $column["p_numero_tarjeta"];
            $tarjeta_habiente = $column["p_tarjeta_habiente"];
            $cambio = $column["p_cambio"];
            $moneda = $column["p_moneda"];
            $estado = $column["p_estado"];
      $nombre_cliente = $column["p_nombre_cliente"];
      $direccion_cliente = $column["p_direccion_cliente"];
      $telefono_cliente = $column["p_telefono_cliente"];
      $numero_cedula_c = $column["p_cedula_cliente"];
      $telefono_cliente =  substr($telefono_cliente, 0, 4).'-'.substr($telefono_cliente, 4);
      $sonletras = $column["p_sonletras"];
        }

        /*
        * AQUI SE DEBE CAMBIAR PARA EL FACTOR DE CAMBIO DE DOLAR A COLON
        */

        $cambio_dolar = 563.00;

      $numero_tarjeta = substr($numero_tarjeta,0,4).'-XXXX-XXXX-'.substr($numero_tarjeta,12,16);

    $pdf = new PDF_MC_Table('L','mm',array(150,234));
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',16);
    $pdf->setXY(10,6);
    $pdf->Cell(40,10,$empresa);


    $pdf->setXY(150,6);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(34,10,'NO. FACTURA : ');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,10,$numero_comprobante);
    $pdf->SetFont('Arial','',10);

    /*Si esta linea no se ocupa solo comentarla*/
                                                /*MOVER HACIA LA DERECHA*/ /*MOVER ARRIBA Y ABAJO*/ /*ANCHO*/ /*ALTO*/
    $pdf->setXY(10,6);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(50,20,$propietario);
    $pdf->setX(10);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(2,30,$direccion);
    $pdf->setX(10);
    $pdf->SetFont('Arial','B',10);
    
    
    
    $pdf->SetFont('Arial','',10);
    $pdf->setXY(10,23);
    $pdf->Cell(38,7,'FECHA DE VENTA : ');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(38,7,$fecha_venta);



    $pdf->SetFont('Arial','',10);
    $pdf->setXY(10,28);
    $pdf->Cell(38,7,'CLIENTE : ');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,7,$nombre_cliente);
    $pdf->setXY(110,28);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10,7,$direccion_cliente);
    
    $pdf->setXY(10,33);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(2,7,'RUC : ');
    $pdf->setXY(22.5,33);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(2,7,$numero_cedula_c);
    
    $pdf->setXY(48,33);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(2,7,'TELEFONO : ');
    $pdf->SetFont('Arial','',10);
    $pdf->setXY(70,33);
    $pdf->Cell(2,7,$telefono_cliente);



    //$pdf->Line(210,60,10,60);
    $pdf->Ln(10);


    $pdf->SetFillColor(172,172,172);
    $pdf->Cell(23,5,'Cant.',1,0,'L',1);
    $pdf->Cell(85,5,'Producto',1,0,'L',1);
    $pdf->Cell(23,5,'Precio',1,0,'C',1);
    $pdf->Cell(23,5,'Exento',1,0,'C',1);
    $pdf->Cell(23,5,'Descuento',1,0,'C',1);
    $pdf->Cell(23,5,'Total',1,0,'C',1);
    $pdf->SetFillColor(255,255,255);
    $pdf->Ln(5);

    $pdf->SetWidths(array(23,85,23,23,23,23));

    if (is_array($detalle) || is_object($detalle))
    {
        foreach ($detalle as $row => $column) {
         $pdf->SetAligns('C');
         $pdf->setX(10);
        if($column['nombre_producto'] == null){
            $pdf->Row(array($column["cantidad"],$column["nombre_producto"],$column["precio_unitario"],$column["exento"],
            $column["descuento"],$column["importe"]));
          } else {
            $pdf->Row(array($column["cantidad"],$column["nombre_producto"],$column["precio_unitario"],$column["exento"],
            $column["descuento"],$column["importe"]));
          }
         $get_Y = $pdf->GetY();
      }



 $pdf->Text(11,$get_Y + 39,'GRACIAS POR SU COMPRA');
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(144,35,'',1,0,'C',1);
      $pdf->Text(60,$get_Y + 5,'SON');
      $pdf->SetFont('Arial','',12);
      $pdf->Text(15,$get_Y + 10,$sonletras);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'SUMAS',1,0,'R',1);
      $pdf->SetFont('Arial','',8.5);
      $pdf->SetFillColor(255,255,255);
      $pdf->Cell(23,5,$sumas,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'IVA',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$iva,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'SUBTOTAL',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$subtotal,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'RETENCION',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$retenido,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL EXENTO',1,0,'R',1);
      $pdf->SetFont('Arial','',8.5);
      $pdf->SetFillColor(255,255,255);
      $pdf->Cell(23,5,$exento,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL DESCUENTO',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$descuento,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL PAGAR',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$total,1,0,'C',1);


    }


      $pdf->Output('I','Factura_'.$numero_comprobante.'.pdf');

  } catch (Exception $e) {

    $pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR COTIZACION');
    $pdf->Output('I','COTIZACION_ERROR.pdf',true);

  }

$ruta_qr = $nombrexml . '.png';

require_once('../reportes/phpqrcode/qrlib.php');
QRcode::png($texto_qr, $ruta_qr, 'Q', 15, 0);

$pdf->Image($ruta_qr, 80, $pdf->GetY(), 25,25);


$pdf->Ln(30);
$pdf->cell(160, 6, utf8_decode('Representación Impresa de la factura electrónica'), 0, 0, 'C', 0);
$pdf->Ln(10);
$pdf->cell(160, 6, utf8_decode('Este comprobante puede ser consultado en ceti.org.pe'), 0, 0, 'C', 0);

$pdf->Output('I', $nombrexml  . 'pdf');
//Crear PDF - FIN
 ?>

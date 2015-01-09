<?php


require('./fpdf/fpdf.php');
$letra = 'Arial';
$tamaño = 10;
$pdf = new FPDF();
$pdf->AddPage();

////////Imagen
$pdf->Image('img/agua.png',56,20,100);

$fecha = $_POST["fecha_instalacion"];
$nombres = $_POST["txtnombres"];
$apellidos = $_POST["txtapellido"];
$dir = $_POST["txtdireccion"];
$telefono = $_POST["txttelefono"];


//$modelo_name = $modelo[1];

$tipo_modelo = $_POST["ocultartipo"];
$modelo  = $_POST["ocultarmodelo"];

//////////
$pdf->SetFont($letra,'B',$tamaño);
//$pdf->Cell(30);
$pdf->Cell(60,120,'Orden De Instalacion No.: ',0,0,'L');
$pdf->Cell(90,120,'Fecha:  '.$fecha,0,1,'C');
$pdf->Ln(3);
$pdf->Cell(200,-100,'Nombre Del Cliente: '.$nombres.' '.$apellidos,0,1,'L');
$pdf->Cell(60,120,'Direccion De Instalacion: '.$dir,0,1,'L');
$pdf->Cell(34,-100,'Telefono: '.$telefono,0,1,'L');
$pdf->Cell(74,120,'Modelo De Purificador Instalado: '.$modelo,0,1,'L');
$pdf->Cell(25,-100,'Tipo: '.$tipo_modelo,0,1,'L');
$pdf->Cell(43,120,'Observaciones:',0,1,'L');
$pdf->Cell(20,0,'Nombre Del Tecnico Instalador:',0,1,'L');
$pdf->Cell(120,20,'Recibido De Conformidad Por Parte Del Cliente:',0,1,'L');
$pdf->Cell(0,30,'Nombre: ',0,1,'L');$pdf->Cell(0,-30,'Firma Y Cedula: ',0,1,'C');
$pdf->Cell(0,50,' _______________________________ ',0,1,'L');$pdf->Cell(228,-50,'_________________________________',0,1,'C');
$pdf->Ln(3);
$pdf->Cell(0,60,'Calle 25A 12A-36 12 De Octubre   Tel. 5820752  5343857  CEL 3112234559  3165287675  Valledupar');
$pdf->Output();
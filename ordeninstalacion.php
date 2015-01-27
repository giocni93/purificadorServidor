<?php


require('./fpdf/fpdf.php');
include_once 'Conexion/conexion.php';
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

$tipo_modelo = $_POST["cboxCategoria"]; 
$modelo  = $_POST["cboxinventario"];


    $conn = new Conexion();
    $nombre_tipo = "";
    $nombre_inventario = "";
    if($conn->conectar()){

            $sql_str = "SELECT nombre FROM categoria where id = ".$tipo_modelo;
            $sql = $conn->getConn()->prepare($sql_str);
            $sql->execute();
            $resultado = $sql->fetchAll();
            
                foreach ($resultado as $row) {
                    $nombre_tipo = $row['nombre'];
                }

            $sql_con = "SELECT nombre FROM inventario where id = ".$modelo;
            $sql1 = $conn->getConn()->prepare($sql_con);
            $sql1->execute();
            $resultado1 = $sql1->fetchAll();
            
                foreach ($resultado1 as $row) {
                    $nombre_inventario = $row['nombre'];
                }
                
    }
    
$observacion = "Se instalara el purificador de agua a base de ozono funcionando en perfectas ";
$observacion1 = "condiciones, se dan las instrucciones de manejo, uso y funcionando a satifaccion del ";
$observacion2 = "cliente,se entrega manual de funciones y certificado de garantia.";
        /*. 
        . "condiciones, se dan las instrucciones de manejo, uso y funcionando a satifaccion del "
        . "cliente, se entrega manual de funciones y certificado de garantia.";*/

//////////
$pdf->SetFont($letra,'B',$tamaño);
//$pdf->Cell(30);
$pdf->Cell(80,120,'ORDEN DE INSTALACION No: ',0,0,'C');
$pdf->Cell(40,120,'FECHA:  ',0,0,'R');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Cell(0,120,$fecha,0,1,'L');

$pdf->Ln(0);
$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(72,-100,'NOMBRE DEL CLIENTE: ',0,0,'C');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Cell(1,-100,$nombres.' '.$apellidos,0,1,'L');
    
$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(84,120,'DIRECCION DE INSTALACION: ',0,0,'C');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Cell(1,120,$dir,0,1,'L');

$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(53,-100,'TELEFONO: ',0,0,'C');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Cell(1,-100,$telefono,0,1,'L');

$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(96,120,'MODELO PURIFICADOR INSTALADO: ',0,0,'C');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Cell(1,120,$nombre_tipo,0,1,'L');

$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(42,-100,'TIPO: ',0,0,'C');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Cell(1,-100,$nombre_inventario,0,1,'L');
    
$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(64,120,'OBSERVACIONES: ',0,0,'C');
    $pdf->SetFont($letra,'',$tamaño);
    $pdf->Ln(65);
    $pdf->Cell(153,0,$observacion,0,1,'C');
    
    $pdf->Cell(164,10,$observacion1,0,1,'C');
    $pdf->Cell(131,0,$observacion2,0,1,'C');
    $pdf->Ln(10);
    
$pdf->SetFont($letra,'B',$tamaño);
$pdf->Cell(97,0,'NOMBRE DEL TECNICO INSTALADOR:',0,1,'C');
$pdf->Cell(130,20,'RECIBIDO DE CONFORMIDAD POR PARTE DEL CLIENTE: ',0,1,'C');
$pdf->Cell(50,30,'NOMBRE: ',0,1,'C');$pdf->Cell(0,-30,'FIRMA Y CEDULA: ',0,1,'C');
$pdf->Cell(90,50,' _______________________________ ',0,1,'C');$pdf->Cell(228,-50,'_________________________________',0,1,'C');
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(158,60,'Calle 25A 12A-36 12 De Octubre   Tel. 5820752  5343857  CEL 3112234559  3165287675  Valledupar',0,0,'C');
$pdf->Output();
 <?php
    require('fpdf/fpdf.php');
    include_once 'Conexion/conexion.php';
    if(isset($_GET['idOrden'])){
        $id = $_GET['idOrden'];
    }
    // ########## CONSULTA DE DATOS ###########
        $conn = new Conexion();
        if($conn->conectar()){
                $idM = "";
                if(isset($_GET['idMan'])){
                    $idM = $_GET['idMan'];
                }
                else{
                    $sql_str = "SELECT MAX(id) as idMan FROM mantenimiento WHERE id_orden_pedido = ".$id;
                    $sql = $conn->getConn()->prepare($sql_str);
                    $sql->execute();
                    $resultado = $sql->fetchAll();

                    foreach ($resultado as $row) {
                        $idM = $row['idMan'];
                    }
                }
                $sql_str = "SELECT m.*,inv.nombre as nombreInv,ti.nombre as nombreTipo,CONCAT(c.nombre,' ',c.apellido) as nombreCliente,
                            c.direccion_oficina,c.telefono 
                            FROM mantenimiento m 
                            INNER JOIN orden_pedido op ON (op.id = m.id_orden_pedido) 
                            INNER JOIN cliente c ON (c.cedula = op.id_cliente) 
                            INNER JOIN inventario inv ON (inv.id = op.id_inventario)
                            INNER JOIN tipo_inventario ti ON (ti.id = inv.id_tipo_inventario) 
                            WHERE m.id = ".$idM;
                
                $sql = $conn->getConn()->prepare($sql_str);
                $sql->execute();
                $resultado = $sql->fetchAll();

            }
    // ########################################
    
    $letra  = 'Arial';
    $tamano = 8;  
    
    $pdf = new FPDF();
    $pdf->AddPage();
    $f = new DateTime();
    
    // ########## VARIABLES DE DATOS ###########
        foreach ($resultado as $row) {
            $idO = $row['id_orden_pedido'];
            $fecha_actual = $row['fecha'];
            $fechaProgramada = $row['fecha_programada'];
            $numMantenimiento = $row['id'];
            $nombre_cliente = $row['nombreCliente'];
            $ciudad = $row['ciudad'];
            $direccion = $row['direccion_oficina'];
            $telefono = $row['telefono'];
            $purificador = $row['nombreInv'];
            $tipo_purificador = $row['nombreTipo'];
            $nombre_tecnico = $row['nombre_tecnico'];
            $motivo_visita = $row['motivo'];
            $observacion = $row['observacion'];
            
            $asesor = '';
            if($row['asesor'] != null){
                $asesor = $row['asesor'];
            }
            
            $fechaRealizacion = '';
            if($row['fecha_realizacion' != null]){
                $fechaRealizacion = $row['fecha_realizacion'];
            }
        }
    // #########################################
    
    
    //################  Contenido  ###################
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(131,6,'PROGRAMADA PARA:   ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,6,$fechaProgramada,0,1,'L');
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(120,6,'No. TARJETA:   ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,6,$idO,0,1,'L');
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(108,6,'FECHA',0,1,'R');
        $pdf->Cell(119,1,'REALIZACION: ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,1,$fechaRealizacion,0,1,'L');
            
            $pdf->Ln(5);
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(131,0,'ASESOR PROGRAMA:   ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,0,$asesor,0,1,'L');
        
            $pdf->Ln(6);
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(127,0,'FECHA SOLICITUD:   ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,0,$fecha_actual,0,1,'L');
        $pdf->SetFont($letra,'B',$tamano+4);
        $pdf->Ln(4);
        $pdf->Cell(0,8,'ORDEN MANTENIMIENTO No. '.$numMantenimiento,1,1);
        
        $pdf->SetFont($letra,'B',$tamano+1);
        $pdf->Cell(10);
        $pdf->Cell(110,8,'NOMBRE DEL CLIENTE',0,0,'L');
        $pdf->Cell(110,8,'CIUDAD',0,1,'L');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(10);
            $pdf->Cell(110,2,$nombre_cliente,0,0,'L');
            $pdf->Cell(50,2,$ciudad,0,0,'L');
            
        $pdf->Ln(5);
            
        $pdf->SetFont($letra,'B',$tamano+1);
        $pdf->Cell(10);
        $pdf->Cell(110,8,'DIRECCION',0,0,'L');
        $pdf->Cell(100,8,'TELEFONO',0,1,'L');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(10);
            $pdf->Cell(110,2,$direccion,0,0,'L');
            $pdf->Cell(50,2,$telefono,0,0,'L');
            
        $pdf->Ln(5);
            
        $pdf->SetFont($letra,'B',$tamano+1);
        $pdf->Cell(10);
        $pdf->Cell(110,8,'MODELO PLANTA',0,0,'L');
        $pdf->Cell(100,8,'NOMBRE DEL TECNICO',0,1,'L');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(10);
            $pdf->Cell(110,2,$purificador,0,0,'L');
            $pdf->Cell(50,2,$nombre_tecnico,0,0,'L');
            
        $pdf->Ln(5);
            
        $pdf->SetFont($letra,'B',$tamano+1);
        $pdf->Cell(10);
        $pdf->Cell(110,8,'TIPO PLANTA',0,1,'L');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(10);
            $pdf->Cell(110,2,$tipo_purificador,0,0,'L');
            
        $pdf->Ln(5);
            
        $pdf->SetFont($letra,'B',$tamano+1);
        $pdf->Cell(10);
        $pdf->Cell(110,8,'MOTIVO VISITA',0,1,'L');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(10);
            $pdf->MultiCell(155,5,$motivo_visita);
            
        $pdf->Ln(5);
            
        $pdf->SetFont($letra,'B',$tamano+2);
        $pdf->Cell(0,6,'RESULTADOS',1,1,'C');
        
        $pdf->SetFont($letra,'B',$tamano+1);
        $pdf->Cell(10);
        $pdf->Cell(110,8,'OBSERVACIONES REVISION',0,1,'L');
        $pdf->Cell(10);
        $pdf->Cell(170,20,'',1,1,'L');
        
        $pdf->Ln(2);
        
        $pdf->SetFont($letra,'',$tamano);
        $pdf->Cell(20);
        $pdf->Cell(20,6,'BUENO',0,0,'C');
        $pdf->Cell(20,6,'REGULAR',0,0,'C');
        $pdf->Cell(20,6,'MALO',0,0,'C');
        
        $pdf->SetFont($letra,'',$tamano);
        $pdf->Cell(0,6,'RECIBIDO DE CONFORMIDAD POR PARTE DEL CLIENTE',0,1,'C');
        
        $pdf->SetFont($letra,'',$tamano);
        $pdf->Cell(20,6,'MALLAS');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(20,6,'',1,1,'C');
        
        $pdf->SetFont($letra,'',$tamano-3);
        $pdf->Cell(20,6,'ELECTROVALVULAS');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(20,6,'',1,1,'C');
        
        $pdf->SetFont($letra,'',$tamano);
        $pdf->Cell(20,6,'CIRCUITO');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(20,6,'',1,0,'C');
        
        $pdf->SetFont($letra,'',$tamano+2);
        $pdf->Cell(0,6,'FIRMA Y CEDULA',0,1,'C');
        
        $pdf->Ln(8);
        
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(0,6,'           CALLE 25A 12A 36 - 12 DE OCTUBRE - TEL 5820752 5849857 - CEL 3112234559 3165287675 VALLEDUPAR',1,0,'L');
        
    //################################################
        
    $pdf->Output();


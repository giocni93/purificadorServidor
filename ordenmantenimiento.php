 <?php
    require('fpdf/fpdf.php');
    $letra  = 'Arial';
    $tamano = 8;  
    
    $pdf = new FPDF();
    $pdf->AddPage();
    $f = new DateTime();
    
    // ########## VARIABLES DE DATOS ###########
        $fecha_actual = $f->format('Y-m-d');
        $numMantenimiento = '009009';
        $nombre_cliente = "Gilmar Ocampo Nieves";
        $ciudad = "Valledupar";
        $direccion = "Cra 6 # 18a - 72";
        $telefono = "3004061405 - 5841611";
        $purificador = "Punta negra";
        $tipo_purificador = "Acero";
        $nombre_tecnico = "Fabio Andres rojas gulloso";
        $motivo_visita = "Entrego purificador luego de reparacion, cambio de botones + mantenimiento del filtro. "
                . "y no se que mas colocar uwhwhwhwhhawhauehiwuhaiushaidusa asdada akhk hask asjdh kajshdk ajsd";
        $observacion = "jajjajjajaj";
        
    // #########################################
    
    
    //################  Contenido  ###################
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(131,6,'PROGRAMADA PARA:   ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,6,'26-01-2015',0,1,'L');
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(120,6,'No. TARJETA:   ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,6,'93',0,1,'L');
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(108,6,'FECHA',0,1,'R');
        $pdf->Cell(119,1,'REALIZACION: ',0,0,'R');
            $pdf->SetFont($letra,'',$tamano+2);
            $pdf->Cell(0,1,'03-01-2015',0,1,'L');
            
        $pdf->SetFont($letra,'B',$tamano);
        $pdf->Cell(131,13,'ASESOR PROGRAMA:   ',0,1,'R');
        
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


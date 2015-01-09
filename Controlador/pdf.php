<?php
    
require '../fpdf/fpdf.php';

class pdf extends FPDF{
    
    public function __construct()
    {
        parent::__construct();
    }
                
    public function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(30);
        $this->Cell(210,15, 'Respaldo Por Distribuidora Motor Del Cesar');
        $this->Ln('0');
        $this->SetFont('Arial','B',11);
        $this->Cell(270,25,'NIT. 900435935-3',0,0,'C');
        $this->Ln('0');
        $this->Ln(20);
    }
    
}

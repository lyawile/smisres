<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pdf
 *
 * @author User
 */
require_once 'fpdf181/fpdf.php';

class Pdf extends FPDF {

    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
    }

    function Header() {
        $file = 'public/img/MTISSlogo.png';
        $this->SetFont('Arial', 'B', 13);
        $this->Image($file, 85, 0, 30,30);
        $this->Cell('', 30, '', '', 1);
        $this->Cell(125,'', "Mtwara Islamic Secondary School", '');
        $this->Cell('','', "Student Report Card", '', 1);
        $this->Cell(125,15, 'Mmingano Street', '');
         $this->Cell('',15, "Hassan Ally Lyawile", '', 1);
          $this->Cell(125,'', 'Mtwara, Tanzania', '');
          $this->Cell('','', "Form I A", '', 1);
        $this->Cell('',10, '', '', 1);
    }

}

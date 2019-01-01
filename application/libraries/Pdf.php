<?php

require_once 'fpdf181/fpdf.php';

class Pdf extends FPDF {

    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
    }

    function Header() {
        
    }

    function Footer() {
        
    }

}

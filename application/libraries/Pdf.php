<?php

require_once 'fpdf181/fpdf.php';

class Pdf extends FPDF {

    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
    }

    function Header() {
        $logoFile = 'public/img/MTISSlogo.png';
        $bismillahiFile = 'public/img/bismillahi_image.jpg';
        $studentImage = 'public/img/student.jpg';
        $this->SetFont('Arial', 'B', 13);
        $this->Image($bismillahiFile, 75, 0, 60);
        $this->Image($studentImage, 170, 10, 25, 30);
        $this->Image($logoFile, 8, 10, 30, 30);
        $this->Cell(45, 0, '', '');
        $this->Cell(100, 15, "MTWARA ISLAMIC SECONDARY SCHOOL", '', 1, 'C');
        $this->Cell(45, 0, '', '');
        $this->Cell(100, 0, "TAARIFA YA MAENDELEO YA MWANAFUNZI", '', 1, 'C');
        $this->Cell(45, 0, '', '');
        $this->Cell(100, 15, "MATOKEO YA MTIHANI WA MUHULA WA I & II", '', 1, 'C');
        $this->Cell(189, 10, "Anuani: S.L.P 261, Mtwara | Simu: 0718440572 | Barua Pepe: headmaster@mtiss.ac.tz", '', 1, 'c');


//        $this->Line(0,0,10,0);
        //  $this->Line(55,70,150,70);
    }

    function Footer() {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell('', 5, "SEHEMU E: MAAGIZO MUHIMU", '', 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell('', 5, "Shule Imefungwa tarehe: 14/06/2018 na itafunguliwa tarehe 17/07/2018", '', 1);
        $this->Cell('', 5, "Shule ifunguliwapo aje na: 1. Pesa ya ada ya T-Shirt 15,000 2. Fagio la "
                . "chelewa la mnazi 3. Sare zinazokubalika na shule", '', 1);
        $this->Cell('',5,'','',1);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell('', 5, "Wako Katika Maendeleo ya Uislamu na Elimu,", '', 1);
        $this->Cell('', 5, "SHAFII RAMADHANI JUMBE", '', 1);
        $this->Cell('',5,'.....................','',1);
        $this->Cell('', 5, "Mkuu wa Shule", '', 1);
    }

}

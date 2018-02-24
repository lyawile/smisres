<?php

class HandlePdf extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }

    public function show() {
//        for ($i = 0; $i < 3; $i++) {
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 15);
//        }
        $this->pdf->Cell(189, 10, "KWA MZAZI / MLEZI WA: OMARI RAMADHAN DURU ", 1, 1, 'C');
        $this->pdf->SetFont('Arial', 'B', 10);

        $this->pdf->Cell('', 8, "SEHEMU A: MATOKEO (08 Juni 2018)", '', 1);
//        $this->pdf->Cell('', 8, date("M, Y"), '', 1);
        $this->pdf->Cell(10, 10, "NA", 1, '', "C");
        $this->pdf->Cell(40, 10, "SOMO", 1, '', 'C');
        $this->pdf->Cell(60, 5, "ALAMA ZA", 1, '', "C");
        $this->pdf->Cell(54, 5, "NAFASI", 1, '', "C");
        $this->pdf->Cell(26, 10, "MAONI", 1, 1, "C");
        $this->pdf->Cell(50);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(20, -5, "MAENDELEO", 1);
        $this->pdf->Cell(20, -5, "MUHULA", 1);
        $this->pdf->Cell(20, -5, "WASTANI", 1);
//        $this->pdf->Cell(110);
        $this->pdf->Cell(18, -5, "NAFASI", 1);
        $this->pdf->Cell(18, -5, "KATI YA", 1);
        $this->pdf->Cell(18, -5, "DARAJA", 1, 1);
//        $this->pdf->Cell(20, 7.5, "WASTANI",1);
        $this->pdf->Cell('', 5, '', '', 1);
        $this->pdf->SetFont('Arial', '', 8);
        for ($i = 1; $i <= 14; $i++) {
            $this->pdf->Cell(10, 5, "$i", 1, '', "C");
            $this->pdf->Cell(40, 5, "1", 1, '', "C");
            $this->pdf->Cell(20, 5, "1", 1, '', "C");
            $this->pdf->Cell(20, 5, "1", 1, '', "C");
            $this->pdf->Cell(20, 5, "1", 1, '', "C");
            $this->pdf->Cell(18, 5, "1", 1, '', "C");
            $this->pdf->Cell(18, 5, "1", 1, '', "C");
            $this->pdf->Cell(18, 5, "1", 1, '', "C");
            $this->pdf->Cell(26, 5, "1", 1, 1, "C");
        }
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell('', 10, "SEHEMU B: TATHMINI YA MATOKEO", '', 1);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell('', 10, "Jumla ya alama ni:   ", '');
        $this->pdf->Cell(-150);
        $this->pdf->Cell('', 10, "|  Wastani wa alama ni:   ", '');
        $this->pdf->Cell(-105);
        $this->pdf->Cell('', 10, " |  Nafasi yake darasani ni ya  ", '');
        $this->pdf->Cell(-56);
        $this->pdf->Cell('', 10, " kati ya   ", '');
        $this->pdf->Cell(-43);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell('', 10, "150", '');
        $this->pdf->Cell(-58);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell('', 10, "5");
        $this->pdf->Cell(-112);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell('', 10, "54");

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(-160);
        $this->pdf->Cell('', 10, "682", '', 1);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell('', 10, "SEHEMU C: UFUNGUO", '', 1);
        $this->pdf->Cell(20, 10, "Na", 1, '', 'C');
        $this->pdf->Cell(30, 10, "Alama", 1, '', 'C');
        $this->pdf->Cell(30, 10, "Daraja", 1, '', 'C');
        $this->pdf->Cell(30, 10, "Maoni", 1, '', 'C');
        $this->pdf->Cell(79, 5, "Viwango Vya Ufaulu", 1, 1, 'C');
        $this->pdf->Cell(110);
        $this->pdf->Cell(49, 5, "Na", 1, '', 'C');
        $this->pdf->Cell(30, 5, "Na", 1, 1, 'C');
        // the data portion of the table listing the keys and their meanings 
        for ($i = 1; $i <= 5; $i++) {
            $this->pdf->Cell(20, 5, $i, 1, '', 'C');
            $this->pdf->Cell(30, 5, $i, 1, '', 'C');
            $this->pdf->Cell(30, 5, $i, 1, '', 'C');
            $this->pdf->Cell(30, 5, $i, 1, '', 'C');
            $this->pdf->Cell(49, 5, $i, 1, '', 'C');
            $this->pdf->Cell(30, 5, $i, 1, 1, 'C');
        }

        $this->pdf->Cell('', 10, "SEHEMU D: TAARIFA ZA MWALIMU WA DARASA", '', 1);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell('', 5, "Jina: Rashid Ramadhan | Namba ya Simu: 0745122525 | Sahihi: ............. ", '', 1);
        $this->pdf->Cell('', 5, "Maoni: Aongeze juhudi ya kujifunza zaidi ", '', 1);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell('', 5, '', '', 1);
        $this->pdf->Output();
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HandlePdf
 *
 * @author User
 */
class HandlePdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }

    public function show() {
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', '', 13);
        $this->pdf->Cell(40, 0, "20 May, 2018");
        $this->pdf->Output();
    }
}

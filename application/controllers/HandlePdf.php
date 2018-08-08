<?php

class HandlePdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }

    public function show() {
        $this->load->model('result_model');
        $class = 1;
        $queryStudentDetails = $this->result_model->getResults($class);


//        $studentNames = strtoupper($queryStudentDetails[0][0]) . " " . strtoupper($queryStudentDetails[0][1]) . " " . strtoupper($queryStudentDetails[0][2]);
////        $numberOfStudents = $queryStudentDetails[0][3]; // get the number of students
//        for ($i = 0; $i < $numberOfStudents; $i++) {
//            // create the table page and start display data on it
//
//            foreach ($results as $data) {
//                // the table to display results of the student

//            }

        // the data portion of the table listing the keys and their meanings 
      

       
        $this->pdf->Output("files.pdf", 'F');
        $data['content'] = 'score/results';
        $this->load->view('main', $data);
    }

}

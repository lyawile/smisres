<?php

require (APPPATH . 'vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

    public function index() {
        if(file_exists('problems.txt')){ // check if error file exists, if yes, remove it
            unlink('problems.txt');
        }
        $data['content'] = 'score/load_score';
        $data['result'] = $this->db->get('subject'); //TODO: not good practise to issue queries directly in controller, I will remove it
        $subjectNameFromForm = $this->input->post('subjectName'); // grab subject name
        $streamIdFromForm = $this->input->post('streamId'); // grab stream id
        if (!empty($_FILES['scoreFile']['name'])) {
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = '1024000';
//                $config['max_width'] = '1024';
//                $config['max_height'] = '768';
            $config['overwrite'] = FALSE;
            $this->load->library('upload', $config);
            $this->upload->do_upload('scoreFile');
            $data['files'] = $this->upload->data();
            $fileAndLocation = $data['files']['file_path'] . $this->upload->data()['file_name'];
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($fileAndLocation);
            $streamId = $studentId = $spreadsheet->getActiveSheet()->getCell('B2')->getValue(); // grab the streamId
            $subjectName = $studentId = $spreadsheet->getActiveSheet()->getCell('B4')->getValue(); // grab the subject name
            if ($subjectName == $subjectNameFromForm && $streamId == $streamIdFromForm) {
                for ($i = 6; $i > 0; $i++) {
                    $studentId = $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue();
                    $examType = $spreadsheet->getActiveSheet()->getCell('B3')->getValue();
                    $attendance = $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue();
                    $score = $spreadsheet->getActiveSheet()->getCell('G' . $i)->getValue();
                    if(trim($score)==""){
                        $score='NULL';
                    }
                    if ($studentId != "") {
                        $this->load->model("result_model");
                        $this->result_model->load_score($streamId, $studentId, $score, $examType, $subjectName, $attendance);
                    } else {
                        break; // the loop halts when in the file the studenntId starts to be empty
                    }
                }
            } else {
                $data['messageError'] = '<div class="alert-warning error-mismatch" style="padding: 15px; margin-left: 10px; margin-bottom: 10px; margin-right: 10px;">'
                        . 'Make sure stream and subject selection matches with tempalate'
                        . '</div>';
            }

            unlink($fileAndLocation); // remove currently uploaded file from directory.
        }
        $this->load->view('main', $data); // display the view on index action call
    }
    public function show(){
        $data['content']='score/results';
        $this->load->view('main',$data);
//        echo "The results of all students per class will be shown here";
    }

}

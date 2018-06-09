<?php

require (APPPATH . 'vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

    public function index() {
        $data['content'] = 'score/load_score';
        $data['result'] = $this->db->get('subject'); //TODO: not good practise to issue queries directly in controller, I will remove it
        $subjectNameFromForm = $this->input->post('subjectName'); // grab subject id
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
//                    $firstName = $spreadsheet->getActiveSheet()->getCell('B' . $i)->getValue();
//                    $middleName = $spreadsheet->getActiveSheet()->getCell('C' . $i)->getValue();
//                    $surname = $spreadsheet->getActiveSheet()->getCell('D' . $i)->getValue();
//                    $gender = $spreadsheet->getActiveSheet()->getCell('E' . $i)->getValue();
                    $score = $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue();
                    if ($studentId == "") {
                        break;
                    }
                }
            } else {
                echo "Wrong";
            }
            unlink($fileAndLocation); // remove currently uploaded file from directory.
        }
//        var_dump($_FILES['scoreFile']);
        $this->load->view('main', $data); // display the view on index action call action call
    }

}

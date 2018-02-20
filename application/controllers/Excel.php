<?php

require (APPPATH . 'vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Class Excel extends CI_Controller {

    public function getExcel() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $data = $this->db->get('student');
        $sheet->setCellValue('A1', "STUDENT NUMBER");
        $sheet->setCellValue('B1', "FIRST NAME");
        $sheet->setCellValue('C1', "MIDDLE NAME");
        $sheet->setCellValue('D1', "SURNAME");
        $sheet->setCellValue('E1', "GENDER");
        $sheet->setCellValue('F1', "SUBJECT");
        $sheet->setCellValue('G1', "SCORE");
        $counter = 2;
        foreach ($data->result() as $item) {
            $sheet->setCellValue('A' . $counter, $item->id);
            $sheet->setCellValue('B' . $counter, strtoupper($item->firstname));
            $sheet->setCellValue('C' . $counter, strtoupper($item->middlename));
            $sheet->setCellValue('D' . $counter, strtoupper($item->surname));
            $sheet->setCellValue('E' . $counter, strtoupper($item->gender));
            $sheet->setCellValue('F' . $counter, 'GEOGRAPHY');
            $sheet->setCellValue('G' . $counter, '');
            $counter++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }

    public function readExcel() {
        $query = $this->db->query("select count(id) as idadi from student");
        foreach ($query->result() as $value) {
            $numberOfCands = $value->idadi;
        }
    }

    public function loadData() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('userfile', 'FILE', 'required');
            if ($this->form_validation->run() === FALSE) {
                $message['content'] = 'student/load';
                $message['msg'] = "<p> Plese select a file</p>";
                $this->load->view('main', $message);
            }
            $config['upload_path'] = './excelFiles/';
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 100;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload() == false) {
                $file['mpunga'] = $this->upload->data();
//           $this->load->view('student/data', $data);
                echo $filepath = $file['mpunga']['file_path'] . $file['mpunga']['file_name'];
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $reader->setReadDataOnly(true);
                $spreadsheet = $reader->load($filepath);
                echo $classId = $spreadsheet->getActiveSheet()->getCell('B4')->getValue();
                echo '<table border="1">';

                for ($i = 11; $i > 0; $i++) { // made an endless loop, and break inside in case it finds empty cell
                    $firstName = $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue();
                    if ($firstName == "")
                        break;
                    $data['classId']=$classId;
                    $data['firstname'] = $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue();
                    $data['middlename'] = $spreadsheet->getActiveSheet()->getCell('B' . $i)->getValue();
                    $data['surname'] = $spreadsheet->getActiveSheet()->getCell('C' . $i)->getValue();
                    $data['vision'] = $spreadsheet->getActiveSheet()->getCell('D' . $i)->getValue();
                    $data['gender'] = $spreadsheet->getActiveSheet()->getCell('E' . $i)->getValue();
                    $data['birthDate'] = $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue();
                    $data['address'] = $spreadsheet->getActiveSheet()->getCell('G' . $i)->getValue();
                    $data['phoneNumber'] = $spreadsheet->getActiveSheet()->getCell('H' . $i)->getValue();
                    $data['standardSeven'] = $spreadsheet->getActiveSheet()->getCell('I' . $i)->getValue() . '</td>';
                    $data['medium'] = $spreadsheet->getActiveSheet()->getCell('J' . $i)->getValue();
                    $data['dateRegistered'] = date("Y-m-d");
                    $data['year']=$spreadsheet->getActiveSheet()->getCell('K' . $i)->getValue();
                    $this->db->insert('student',$data);
                }
                $r = $this->db->query("SELECT COUNT(id) numberOfRecords FROM student");
                foreach ($r->result() as $value) {
                    $value = $value->numberOfRecords;
                    if(isset($value)){
                        $message = "<p> ".$value." Records upload is succcessful</p>";
                    }
                }
                echo $message;
            } else {
                $data['mpunga'] = $this->upload->display_errors();
                //$this->load->view('student/data', $data);
            }
        }
    }

}

<?php

require (APPPATH . 'vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Class Excel extends CI_Controller {

    public function getExcel($stream, $subjectId) {
//        echo $dateTimeNow = date("Y-m-d");
//        echo $dateTimeNow = "1986/04/04";
//        echo "<br/>";
        // echo $excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($dateTimeNow);
//        echo $excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp(31506);
//        echo "<br/> the real date using date function". date("d/m/Y", $excelDateValue);
//        echo "<br/>";
        //echo $excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(3150);
//        exit();
        sleep(2);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "STREAM ID");
        $sheet->setCellValue('B1', $stream);
        $sheet->setCellValue('A2', "SUBJECT ID");
        $sheet->setCellValue('B2', $subjectId);
        $data = $this->db->query("SELECT  s.id,firstname, middlename, surname, gender FROM student s inner join stream st on st.id = s.classId where st.id = $stream");
        $sheet->setCellValue('A3', "STUDENT NUMBER");
        $sheet->setCellValue('B3', "FIRST NAME");
        $sheet->setCellValue('C3', "MIDDLE NAME");
        $sheet->setCellValue('D3', "SURNAME");
        $sheet->setCellValue('E3', "GENDER");
        $sheet->setCellValue('F3', "SCORE");
        $counter = 4;
        foreach ($data->result() as $item) {
            $sheet->setCellValue('A' . $counter, $item->id);
            $sheet->setCellValue('B' . $counter, strtoupper($item->firstname));
            $sheet->setCellValue('C' . $counter, strtoupper($item->middlename));
            $sheet->setCellValue('D' . $counter, strtoupper($item->surname));
            $sheet->setCellValue('E' . $counter, strtoupper($item->gender));
            $sheet->setCellValue('F' . $counter, '');
            $counter++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }

//    public function readExcel() {
//        $query = $this->db->query("select count(id) as idadi from student");
//        foreach ($query->result() as $value) {
//            $numberOfCands = $value->idadi;
//        }
//    }

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
                $records = '';
                for ($i = 11; $i > 0; $i++) { // made an endless loop, and break inside in case it finds empty cell
                    $firstName = $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue();
                    if ($firstName == "")
                        break;
                    $data['classId'] = $classId;
                    $data['firstname'] = $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue();
                    $data['middlename'] = $spreadsheet->getActiveSheet()->getCell('B' . $i)->getValue();
                    $data['surname'] = $spreadsheet->getActiveSheet()->getCell('C' . $i)->getValue();
                    $data['vision'] = $spreadsheet->getActiveSheet()->getCell('D' . $i)->getValue();
                    $data['gender'] = $spreadsheet->getActiveSheet()->getCell('E' . $i)->getValue();
                    //$data['birthDate'] = $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue();
                    $excelDateValue = $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue();
                    $timeStamp = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($excelDateValue);
                    $data['birthDate'] = date("Y-m-d", $timeStamp);
                    $data['address'] = $spreadsheet->getActiveSheet()->getCell('G' . $i)->getValue();
                    $data['phoneNumber'] = $spreadsheet->getActiveSheet()->getCell('H' . $i)->getValue();
                    $data['standardSeven'] = $spreadsheet->getActiveSheet()->getCell('I' . $i)->getValue();
                    $data['medium'] = $spreadsheet->getActiveSheet()->getCell('J' . $i)->getValue();
                    $data['dateRegistered'] = date("Y-m-d");
                    $data['year'] = $spreadsheet->getActiveSheet()->getCell('K' . $i)->getValue();
                    $this->db->insert('student', $data);
                    $studentId = $this->db->insert_id(); // get the id of the currently inserted student
                    $querySubjectId = $this->db->query("SELECT `subjectName` FROM subject");
                    foreach ($querySubjectId->result() as $subArray) {
                        $queryStud = $this->db->query("SELECT COUNT(studentId) studNo from students_masomo where `studentId` = $studentId;");
                        foreach ($queryStud->result() as $v) {
                            $studNo = $v->studNo;
                        }
                        if ($studNo == 0) {
                            // insert the records of the currently inserted student id and subject codes into the student_takes_subjects table 
                            $this->db->query("INSERT INTO mtiss_db.students_masomo VALUES( NULL, $studentId, 1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL) ;");
                        } else {
                            // if student exists, update subjects records. It is assumed that initially all students takes all subjects
                            $status = $subArray->subjectName;
                            var_dump($v);
                            $this->db->query("UPDATE mtiss_db.students_masomo SET $status = 1 where `studentId` = $studentId");
                        }
                    }
                    $records += $this->db->affected_rows();
                }
                $r = $this->db->query("SELECT COUNT(id) numberOfRecords FROM student");
                foreach ($r->result() as $value) {
                    $value = $value->numberOfRecords;
                    if (isset($value)) {
                        $message = "<p> " . $records . " Records uploaded successfully</p>";
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

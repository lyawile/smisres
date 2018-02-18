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
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("excelFiles/smis__template.xlsx");
        echo $spreadsheet->getActiveSheet()->getCell('B4')->getValue();
        echo '<table border="1">';

        for ($i = 11; $i <= 16; $i++) {
            echo '<tr>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('A' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('B' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('C' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('D' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('E' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('F' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('G' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('H' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('I' . $i)->getValue() . '</td>';
            echo '<td>' . $spreadsheet->getActiveSheet()->getCell('J' . $i)->getValue() . '</td>';
            echo '<tr>';
        }
        echo '</table>';
    }

}

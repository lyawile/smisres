<?php

class Result_model extends CI_Model {

    public function load_score($streamId, $studentId, $score, $examType, $subjectName, $attendance) {
        echo $month = $this->getExamType($examType);
        $year = date('Y');
        $this->db->select('id,subjectName');
        $out = $this->db->get_where('subject', array('subjectName' => $subjectName));
        foreach ($out->result() as $v) {
            echo $subjectId = $v->id;
        }
        $result = $this->db->query("SELECT `studId` "
                . "FROM score "
                . "WHERE `studId` = $studentId AND `streamId` = $streamId AND `subjectID` = $subjectId");
        $recordsNum = $result->num_rows();
        if ($score >= 0 && $score <= 100) { // check if the score is between 0 and 100 otherwise log the problem into text file
            if ($attendance == 'V' && !empty(trim($score))) {
                if ($recordsNum == 0) {
                    // insert the record for the very first time 
                    return $this->db->query("INSERT INTO `score` (`id`, `studId`, `examYear`, `streamId`, `subjectID` ,`attendance`,`$month`, `dateInserted`) "
                                    . "VALUES (NULL, '$studentId', '$year', '$streamId', '$subjectId','$attendance', $score, CURRENT_TIMESTAMP);");
                } else {
                    // update the records if already the student has marks in the respective subject
                    $this->db->query("UPDATE score SET `streamId` = $streamId, `subjectID` = $subjectId, $month = $score where `studId` = $studentId  AND`streamId` = $streamId AND `subjectID` = $subjectId;");
                }
            } else {
                echo "V should have marks <br/>";
            }
        } else {
            $handle = fopen('problems.txt', 'a');
            fwrite($handle, "$score is out bound" . "\n");
            fclose($handle);
        }
    }

    public function getResults($class) {
        $this->db->where('streamId', $class);
        $this->db->order_by('studId', 'DESC');
        $result = $this->db->get('score');
        foreach ($result->result() as $r) {
            $recId = $r->id;
            $avgJune = ($r->march + $r->june) / 2;

            $this->db->query("UPDATE `score` SET `avgJune` = $avgJune WHERE `score`.`id` = $recId;");
            $studentId = $r->studId;
            $studIds[] = $studentId; // store all student ids in array for next retrieval 
        }
//        var_dump($studIds);
        $uniqStudId = array_unique($studIds);
        $studParticulars = array();
        $studResults = array();
        foreach ($uniqStudId as $studId) {
            $this->db->where('id', $studId);
            $result = $this->db->select(['firstname', 'middlename', 'surname'])->get('student');

            foreach ($result->result() as $studDetails) {
//                $studentDetails = array($studDetails->firstname, $studDetails->middlename, $studDetails->surname);
                $studentNames = $studDetails->firstname . " " . $studDetails->middlename . " " . $studDetails->surname;
                $this->pdf->AddPage();
                $this->pdf->SetFont('Arial', 'B', 15);
//        }
                $this->pdf->Cell(189, 10, "KWA MZAZI / MLEZI WA: " . $studentNames, 1, 1, 'C');
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
            }

            $studentResult = $this->db->query("select student.id,`streamId`, `subjectName`, march, june, `avgJune` "
                    . "from student "
                    . "INNER JOIN score ON student.id =  score.`studId` "
                    . "INNER JOIN subject s ON s.id = score.subjectID "
                    . "where `streamId` = $class and score.studId= $studId"
                    . " ORDER BY student.id");
            $i = 0;
            foreach ($studentResult->result() as $studDetails) {

                // Portion for displaying results
                $this->pdf->Cell(10, 5, "$i", 1, '', "C");
                $this->pdf->Cell(40, 5, "$studDetails->subjectName", 1, '', "C");
                $this->pdf->Cell(20, 5, "$studDetails->march", 1, '', "C");
                $this->pdf->Cell(20, 5, "$studDetails->june", 1, '', "C");
                $this->pdf->Cell(20, 5, "$studDetails->avgJune", 1, '', "C");
                $this->pdf->Cell(18, 5, "1", 1, '', "C");
                $this->pdf->Cell(18, 5, "1", 1, '', "C");
                $this->pdf->Cell(18, 5, "1", 1, '', "C");
                $this->pdf->Cell(26, 5, "1", 1, 1, "C");
                $i += 1;
            }
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 10, "SEHEMU B: TATHMINI YA MATOKEO", '', 1);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell('', 10, "Alama Muhula I:   ", '');
            $this->pdf->Cell(-150);
            $this->pdf->Cell('', 10, "|  Alama Muhula II:   ", '');
            $this->pdf->Cell(-110);
            $this->pdf->Cell('', 10, "|  Wastani wa alama ni:   ", '', 1);
            $this->pdf->Cell('', 10, "Nafasi yake darasani ni ya  ", '');
            $this->pdf->Cell(-145);
            $this->pdf->Cell('', 10, " kati ya   ", '');
            $this->pdf->Cell(-130);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 10, "150", '');
            $this->pdf->Cell(-147);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 10, "5");
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(-163);
            $this->pdf->Cell('', -10, "700", '');
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(-120);
            $this->pdf->Cell('', -10, "682", '');
            $this->pdf->Cell('',10,"",'', 1);
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
        }
//       return array($studParticulars, $studResults);
    }

// Get exam month using the exam type parameter passed over getExamType function
// values are integers from 1 to 4, blank returns march exam as default.
    public function getExamType($examType) {
        switch ($examType) {
            case 1:
                return $examMonth = 'march';
            case 2:
                return $examMonth = 'june';

            case 3:
                return $examMonth = 'september';
            case 4 :
                return $examMonth = 'december';
            default :
                return $examMonth = 'march';
        }
    }

}

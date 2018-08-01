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
        $result = $this->db->get('score');
        foreach ($result->result() as $r) {
            $recId = $r->id;
            $avgJune = ($r->march + $r->june) / 2;
            $this->db->query("UPDATE `score` SET `avgJune` = $avgJune WHERE `score`.`id` = $recId;");
        }
       $result = $this->db->query("select student.id, CONCAT(firstname,' ', middlename, ' ', surname) as studNames,`streamId`, `subjectID`, march, june, `avgJune` "
               . "from student INNER JOIN score ON student.id =  score.`studId` where `streamId` = $class");
       return $result;
    }

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

<?php

class Result_model extends CI_Model {

    public function load_score($streamId, $studentId, $examType = 1, $score, $examType) {
        $month = $this->getExamType($examType);
        $year = date('Y');
        $result = $this->db->query("SELECT `studId` "
                . "FROM score "
                . "WHERE `studId` = $studentId AND `streamId` = $streamId");
        $recordsNum = $result->num_rows();
        if ($recordsNum == 0) {
            // insert the record for the very first time 
            return $this->db->query("INSERT INTO `score` (`id`, `studId`, `examYear`, `streamId`, `subjectID`,$month, `dateInserted`) "
                            . "VALUES (NULL, '$studentId', '$year', '$streamId', '2', $score, CURRENT_TIMESTAMP);");
        } else {
            // update the records if already the student has marks in the respective subject
            $this->db->query("UPDATE score SET `streamId` = $streamId, `subjectID` = 2, $month = $score where `studId` = $studentId;");
        }
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

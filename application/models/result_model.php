<?php

class Result_model extends CI_Model {

    public function load_score($streamId, $studentId, $score, $examType, $subjectName, $attendance) {
        $month = $this->getExamType($examType);
        $year = date('Y');
        $this->db->select('id,subjectName');
        $out = $this->db->get_where('subject', array('subjectName' => $subjectName));
        foreach ($out->result() as $v) {
            $subjectId = $v->id;
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
        // get stream name by class id 
        $this->db->where(['id' => $class]);
        $className = $this->db->get('stream')->row()
                ->streamName;
        // get the active term
        $getTerm = $this->getActiveTerm();
        $termDisplay = ucfirst($getTerm[1]);
        // get the score details 
        $this->db->where('streamId', $class);
        $this->db->order_by('studId', 'DESC');
        $result = $this->db->get('score');
        foreach ($result->result() as $r) {
            $recId = $r->id;
            $march = $r->march;
            $june = $r->june;
            $september = $r->september;
            $december = $r->december;
//          Get the average scores for each set of marks 
            $avgJune = $this->avgJune($march, $june);
            $avgDec = $this->avgDec($september, $december);
            // Update the average marks 
            $this->db->query("UPDATE `score` SET `avgJune` = $avgJune, `avgDec` = $avgDec WHERE `score`.`id` = $recId;");
            $studentId = $r->studId;
            $studIds[] = $studentId; // store all student ids in array for next retrieval 
        }
        // get the number of students in the class
        $query = $this->db->where('classId', $class)->get('student');
        $numberOfStudentsInClass = $query->num_rows();
//        var_dump($studIds);
        $uniqStudId = array_unique($studIds);
        $studParticulars = array();
        $studResults = array();
        foreach ($uniqStudId as $studId) {
            $this->db->where('id', $studId);
            $result = $this->db->select(['firstname', 'middlename', 'surname', 'picUrl'])->get('student');

            foreach ($result->result() as $studDetails) {
                //Taking student picture 
                if ($studDetails->picUrl == '') {
                    $studentImage = 'public/img/student.jpg';
                } else {
                    $studentImage = 'files/' . $studDetails->picUrl;
                }
                // Query active term i.e June or December trough the function call 
                $resultData = $this->getActiveTerm();
                $active = $resultData[0];
                $term = $resultData[1];
                // Display personal information
                $logoFile = 'public/img/MTISSlogo.png';
                $bismillahiFile = 'public/img/bismillahi_image.jpg';
                $this->pdf->addPage();
                $this->pdf->SetFont('Arial', 'B', 13);
                $this->pdf->Image($bismillahiFile, 75, 0, 60);
                $this->pdf->Image($studentImage, 170, 10, 25, 30);
                $this->pdf->Image($logoFile, 8, 10, 30, 30);
                $this->pdf->Cell(45, 0, '', '');
                $this->pdf->Cell(100, 15, "MTWARA ISLAMIC SECONDARY SCHOOL", '', 1, 'C');
                $this->pdf->Cell(45, 0, '', '');
                $this->pdf->Cell(100, 0, "TAARIFA YA MAENDELEO YA MWANAFUNZI", '', 1, 'C');
                $this->pdf->Cell(45, 0, '', '');
                $this->pdf->Cell(100, 15, "MATOKEO YA MTIHANI WA MUHULA WA " . strtoupper($term) . " " . date("Y"), '', 1, 'C');
                $this->pdf->Cell(189, 10, "Anuani: S.L.P 261, Mtwara | Simu: 0718440572 | Barua Pepe: headmaster@mtiss.ac.tz", '', 1, 'c');
//                $studentDetails = array($studDetails->firstname, $studDetails->middlename, $studDetails->surname);
                $studentNames = $studDetails->firstname . " " . $studDetails->middlename . " " . $studDetails->surname;
                $this->pdf->SetFont('Arial', 'B', 15);
                $this->pdf->Cell(189, 10, "KWA MZAZI / MLEZI WA: " . $studentNames. "($className)", 1, 1, 'C');
                $this->pdf->SetFont('Arial', 'B', 10);

                $this->pdf->Cell('', 8, "SEHEMU A: MATOKEO ($termDisplay, " . date("Y") . ")", '', 1);
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
            $studentResult = $this->db->query("select student.id studentId,`streamId`,s.id 'subjectIdentification',gradeJune,gradeDec, `subjectName`, march, june, `avgJune`, september, december, `avgDec` "
                    . "from student "
                    . "INNER JOIN score ON student.id =  score.`studId` "
                    . "INNER JOIN subject s ON s.id = score.subjectID "
                    . "where `streamId` = $class and score.studId= $studId"
                    . " ORDER BY student.id");
            $i = 1;
            $sumOfAverageMarks = 0;
            $totalJune = 0;
            // Truncate tables for rankings 
            $this->db->query('truncate subject_position;');
            $this->db->query('truncate subject_rank;');
            foreach ($studentResult->result() as $studDetails) {
                // get the avgJune
                $avgJuneIndividual = $studDetails->avgJune;
                // get the total average scores for June 
                $totalJune += $studDetails->avgJune;
                // get the total scores based on the selected term
                $score1 = ($active = 1 && $term == 'june') ? $studDetails->march : $studDetails->september;
                $score2 = ($active = 1 && $term == 'june') ? $studDetails->june : $studDetails->december;
                $score3 = ($active = 1 && $term == 'june') ? $studDetails->avgJune : $studDetails->avgDec;
                $subjectIdentification = $studDetails->subjectIdentification; // su
                $studentIdentification = $studDetails->studentId; // Im going to use it to check student positon in subject
                //Get the position of each candidate in respective subject
                $this->generateSubjectRankingStores($subjectIdentification, $class);
                // get the average score grade for the term
                if (empty($score3))
                    $score3 = -1; // fake the score value
                $termGrade = $this->getGrade($score3);
                $score3 = ($active = 1 && $term == 'june') ? $studDetails->avgJune : $studDetails->avgDec;
                $studentIdententificationNumber = $studDetails->studentId;
                // get sum of the total score 
                $sumOfAverageMarks += $score3;
                // update the score based on the current term
                if ($term === 'june') {
                    //update June Grade
                    $this->db->set('gradeJune', $termGrade)->where(['studId' => $studentIdententificationNumber, 'subjectID' => $subjectIdentification])->update('score');
                    // set the June score grade to display
                    $scoreGrade = $studDetails->gradeJune;

                    // set display name muhula I and set the muhulaI total score
                    $termDisplayJune = "Muhula I";
                    $termTotalJune = $sumOfAverageMarks;
                }
                if ($term === 'december') {
                    //Update December grade
                    $this->db->set('gradeDec', $termGrade)->where(['studId' => $studentIdententificationNumber, 'subjectID' => $subjectIdentification])->update('score');
                    // set the December score grade to display
                    $scoreGrade = $studDetails->gradeDec;
                    // set display name muhula I and set the muhulaI total score
                    $termDisplayDec = "Muhula II";
                    $termTotalDec = $sumOfAverageMarks;
                    $avgJunePerCand = $avgJuneIndividual;
                    $totalAverageAnnual = ($score3 + $avgJunePerCand) / 2; // $score3 stores the avgDec for if term is DEC
                    $this->db->set('totalAnnual', $totalAverageAnnual)->where(['studId' => $studentIdententificationNumber, 'subjectID' => $subjectIdentification])->update('score');
                    if (empty($totalAverageAnnual))
                        $totalAverageAnnual = -1; // fake the score value
                    $avTotalAnnualGrade = $this->getGrade($totalAverageAnnual);
                    // update grade
                    $this->db->set('gradeTotalAnnual', $avTotalAnnualGrade)->where(['studId' => $studentIdententificationNumber, 'subjectID' => $subjectIdentification])->update('score');
                    $termTotalAnnual = $sumOfAverageMarks;
                }
                // Initialize loop in order to run once 
                $index = 0;
                while ($index < 1) {
                    if (!empty($termTotalJune)) {
                        // truncate the june_ranking table
                        $this->db->query("truncate june_ranking");
                        // populate data into ranking table for June
                        $this->db->query("INSERT INTO june_ranking(studId, totalScore, averageScore) "
                                . "SELECT studId, sum(avgJune) totalAvg, avg(avgJune) averageJune FROM score  "
                                . "WHERE streamId = $class GROUP BY studId ORDER BY averageJune DESC; ");
                    }

                    if (!empty($termTotalAnnual)) {
                        // truncate the june_ranking table
                        $this->db->query("truncate annual_ranking");
                        // populate data into ranking table for Annual
                        $this->db->query("INSERT INTO annual_ranking(studId, totalScore) SELECT studId, sum(totalAnnual) totalAvg FROM score   WHERE streamId = $class GROUP BY studId ORDER BY totalAvg DESC;");
                    }
                    $index += 20;
                }

                // Portion for displaying results

                $this->pdf->Cell(10, 5, "$i", 1, '', "C");
                $this->pdf->Cell(40, 5, "$studDetails->subjectName", 1, '', "C");
                $this->pdf->Cell(20, 5, "$score1", 1, '', "C");
                $this->pdf->Cell(20, 5, "$score2", 1, '', "C");
                $this->pdf->Cell(20, 5, "$score3", 1, '', "C");
                $this->pdf->Cell(18, 5, $this->getSubjectPosition($studentIdentification, $subjectIdentification,$class), 1, '', "C");
                $this->pdf->Cell(18, 5, "$numberOfStudentsInClass", 1, '', "C");
                $this->pdf->Cell(18, 5, "$scoreGrade", 1, '', "C");
                $this->pdf->Cell(26, 5, "1", 1, 1, "C");
                $i += 1;
            }
            // set position values 
            // get the position of the student from the ranking table
            if (!empty(@$termTotalAnnual) || @$termTotalAnnual === 0) {
                $rankingDetails = $this->db->where('studId', $studId)->select('id')->get('annual_ranking');
                foreach ($rankingDetails->result() as $rankData) {
                    $position = $rankData->id;
                }
            }
            if (!empty($termTotalJune) || @$termTotalJune === 0) {
                // get the position of the student from the ranking table
                $rankingDetails = $this->db->where('studId', $studId)->select('id')->get('june_ranking');
                foreach ($rankingDetails->result() as $rankData) {
                    $position = $rankData->id;
                }
            }

            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 10, "SEHEMU B: TATHMINI YA MATOKEO", '', 1);
            $this->pdf->SetFont('Arial', '', 10);
            if (!empty($termTotalJune)) {
                $this->pdf->Cell('', 10, "Alama Muhula I:   ", '');
            }
            if (!empty($termTotalDec)) {
                $this->pdf->Cell('', 10, "Alama Muhula I:   ", '');
            }
            $this->pdf->Cell(-150);
            if (!empty($termTotalDec)) {
                $this->pdf->Cell('', 10, "Alama Muhula II:   ", '');
            }
            $this->pdf->Cell(-110);
            $this->pdf->Cell('', 10, "|  Wastani wa alama ni:   ", '', 1);
            $this->pdf->Cell('', 10, "Nafasi yake darasani ni ya: ", '');
            $this->pdf->Cell(-145);
            $this->pdf->Cell('', 10, " kati ya   ", '');
            $this->pdf->Cell(-130);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 10, "$numberOfStudentsInClass", '');
            $this->pdf->Cell(-147);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 10, "$position");
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(-163);
            if (!empty($termTotalJune)) {
                $this->pdf->Cell('', -10, "$termTotalJune", '');
            }
            if (!empty($termTotalDec)) {
                $this->pdf->Cell('', -10, "$totalJune", '');
            }
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(-120);
            if (!empty($termTotalDec)) {
                $this->pdf->Cell('', -10, "$termTotalDec", '');
            }
            $this->pdf->Cell('', 10, "", '', 1);
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
            // Query the grade configuration to pupulate the table 
            $this->db->where(['stream_id' => $class]);
            $gradesInfo = $this->db->get('grade_config');
            $this->pdf->SetFont('Arial', '', 10);
            $i = 1;
            foreach ($gradesInfo->result() as $grades) {
                $this->pdf->Cell(20, 5, $i, 1, '', 'C');
                $this->pdf->Cell(30, 5, $grades->low . "-" . $grades->high, 1, '', 'C');
                $this->pdf->Cell(30, 5, $grades->grade, 1, '', 'C');
                $this->pdf->Cell(30, 5, $grades->remarks, 1, '', 'C');
                $this->pdf->Cell(49, 5, '', 1, '', 'C');
                $this->pdf->Cell(30, 5, '', 1, 1, 'C');
                $i += 1;
            }
            $this->pdf->Cell('', 10, "SEHEMU D: TAARIFA ZA MWALIMU WA DARASA", '', 1);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell('', 5, "Jina: Rashid Ramadhan | Namba ya Simu: 0745122525 | Sahihi: ............. ", '', 1);
            $this->pdf->Cell('', 5, "Maoni: Aongeze juhudi ya kujifunza zaidi ", '', 1);
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 5, '', '', 1);

            // Old footer starts here 
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell('', 5, "SEHEMU E: MAAGIZO MUHIMU", '', 1);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell('', 5, "Shule Imefungwa tarehe: 14/06/2018 na itafunguliwa tarehe 17/07/2018", '', 1);
            $this->pdf->Cell('', 5, "Shule ifunguliwapo aje na: 1. Pesa ya ada ya T-Shirt 15,000 2. Fagio la "
                    . "chelewa la mnazi 3. Sare zinazokubalika na shule", '', 1);
            $this->pdf->Cell('', 5, '', '', 1);
            $this->pdf->SetFont('Arial', 'I', 10);
            $this->pdf->Cell('', 5, "Wako Katika Maendeleo ya Uislamu na Elimu,", '', 1);
            $this->pdf->Cell('', 5, "SHAFII RAMADHANI JUMBE", '', 1);
            $this->pdf->Cell('', 5, '.....................', '', 1);
            $this->pdf->Cell('', 5, "Mkuu wa Shule", '', 1);
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

    public function getActiveTerm() {
        // Query active term i.e June or December 
        $this->db->where("active", 1);
        $queryActiveTerm = $this->db->get('system_setup');
        foreach ($queryActiveTerm->result() as $resultSet) {
            $active = $resultSet->active;
            $term = $resultSet->muhula;
        }
        return array($active, $term);
    }

    public function updateTerm($term) {
        // change the active value to 1 for selected term
        $this->db->where('muhula', $term);
        $this->db->set('active', 1);
        $this->db->update('system_setup');
        // reset all terms active status not equal to selected term to 0
        $this->db->where('muhula !=', $term);
        $this->db->set('active', 0);
        $this->db->update('system_setup');
        return 'OK';
    }

    public function getGrade($marks) {
        $gradesInfo = $this->db->get('grade_config');
        foreach ($gradesInfo->result() as $grades) {
            $lowMark = $grades->low;
            $highMark = $grades->high;
            $grade = $grades->grade;
            if (($marks >= $lowMark && $marks <= $highMark) === true)
                return $grades->grade;
        }
    }

    public function getSubjectPosition($studentId, $subjectId, $classId) {
        $query = $this->db->get_where('subject_position', ['studentId' => $studentId, 'subjectId' => $subjectId, 'classId'=>$classId]);
        foreach ($query->result() as $data) {
            return $data->position;
        }
    }

    public function generateSubjectRankingStores($subjectId, $classId) {
        // drop the specific subject ranking table 
        $this->db->query("drop table if exists subject_rank");
        // delete ranking data from subject_position table corresponding to the respective subject
        $this->db->delete('subject_position', array('subjectId' => $subjectId, 'classId' => $classId));
        // create table for storing each subject ranking
        $this->db->query("create  table subject_rank ( id int primary key auto_increment, studentId int not null, subjectId int not null,marks int not null)");
        // insert data of the specific subject to the subject ranking table
        $this->db->query("insert into  subject_rank(studentId, subjectID, marks)
                          select score.studId, score.subjectID , score.avgJune 
                          from score 
                          where score.subjectID = $subjectId and streamId = $classId
                          order by score.avgJune desc ");
        // insert into the general table storing the subject ranking 
        $this->db->query("insert into subject_position(studentId, subjectId,marks, position, classId)
                          select studentId, subjectId, marks,id, $classId 'classId'   from subject_rank; ");
    }

    public function avgJune($march, $june) {
        if ($march == '' && $june != '') {
            return $avgJune = $june;
        } elseif ($march != '' && $june == '') {
            return $avgJune = $march;
        } else {
            return $avgJune = ($march + $june) / 2;
        }
    }

    public function avgDec($september, $december) {
        if ($september == '' && $december != '') {
            return $avgDec = $december;
        } elseif ($september != '' && $december == '') {
            return $avgDec = $december;
        } else {
            return $avgDec = ($september + $december) / 2;
        }
    }

    public function getTheBatchResults($streamId) {
        $data = array();
        $this->db->select(['studId']);
        $juneRanks = $this->db->get('june_ranking');
        foreach ($juneRanks->result() as $result) {
            $studId = $result->studId;
            // get the scores of each subject 
            $query = "SELECT studId,concat(s.firstname,' ', s.surname) as studNames,
                                MAX(CASE
                                    WHEN
                                        subjectID = 1
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 1 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Chemistry',
                                MAX(CASE
                                    WHEN
                                        subjectID = 2
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 2 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Mathematics',
                                MAX(CASE
                                    WHEN
                                        subjectID = 3
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 3 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Physics',
                                MAX(CASE
                                    WHEN
                                        subjectID = 4
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 4 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Civics',
                                MAX(CASE
                                    WHEN
                                        subjectID = 5
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 5 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Geography',
                                MAX(CASE
                                    WHEN
                                        subjectID = 6
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 6 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Islamic_knowledge',
                                MAX(CASE
                                    WHEN
                                        subjectID = 7
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 7 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Quran',
                                MAX(CASE
                                    WHEN
                                        subjectID = 8
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 9 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Kiswahili',
                                MAX(CASE
                                    WHEN
                                        subjectID = 9
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 9 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'English',
                                MAX(CASE
                                    WHEN
                                        subjectID = 10
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 10 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Biology',
                                MAX(CASE
                                    WHEN
                                        subjectID = 11
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 11 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Arabic_knowledge',
                                MAX(CASE
                                    WHEN
                                        subjectID = 12
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 12 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'History',
                                MAX(CASE
                                    WHEN
                                        subjectID = 13
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 13 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Commerce',
                                MAX(CASE
                                    WHEN
                                        subjectID = 14
                                    THEN
                                        (SELECT 
                                                avgJune
                                            FROM
                                                mtiss_db.score
                                            WHERE
                                                subjectID = 14 AND studId = $studId)
                                    ELSE NULL
                                END) AS 'Book_keeping'
                            FROM
                              score inner join student s ON s.id = score.studId
                            WHERE
                                studId = $studId and score.streamId = $streamId 
                            GROUP BY studId;";
            $result = $this->db->query($query);
            if (!$result) {
                return '';
            } else {
                foreach ($result->result() as $data) {
                    $resultRow[] = $data;
                }
            }
        }
        // get the class name by stream id 
        $this->db->where(['id' => $streamId]);
        $className = $this->db->get('stream')->row()
                ->streamName;
        // get the current exam term month
        $this->db->where(['active' => 1]);
        $term = $this->db->get('system_setup')->row()->muhula;
        return array(@$resultRow, $className, $term);
    }

}

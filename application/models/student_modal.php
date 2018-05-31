<?php

date_default_timezone_set('Africa/Dar_es_Salaam');

class Student_modal extends CI_Model {

    public function insertData() {
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'middlename' => $this->input->post('middlename'),
            'surname' => $this->input->post('surname'),
            'dateRegistered' => $this->input->post('date'),
            'gender' => $this->input->post('gender'),
            'birthDate' => $this->input->post('dateOfBirth'),
            'phoneNumber' => $this->input->post('phonenumber'),
            'picUrl' => $this->upload->data()['file_name'],
            'vision' => $this->input->post('vision'),
            'standardSeven' => $this->input->post('stdSeven'),
            'year' => $this->input->post('stdSevenYear'),
            'medium' => $this->input->post('medium'),
            'address' => $this->input->post('address'),
            'classId' => $this->input->post('classId')
        );
        $results = $this->db->insert('student', $data);
        $studentId = $this->db->insert_id(); // get the id of the currently inserted student
        // check if the student exists in the students_masomo table 
        $querySubjectId = $this->db->query("SELECT `subjectName` FROM subject");
        foreach ($querySubjectId->result() as $subArray) {
            $queryStud = $this->db->query("SELECT COUNT(studentId) studNo from students_masomo where `studentId` = $studentId;");
            foreach ($queryStud->result() as $v) {
                "Number of students:" . $studNo = $v->studNo;
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

        if (isset($results)) {
            $data['successMessage'] = '<div class="success">data successfully saved</div>';
            $data['error'] = "";
            $data['content'] = 'student/register';
            $this->form_validation->unset_field_data();
            $this->load->view('main', $data);
        } else {
            $data['successMessage'] = '<div class="success" style="color: red;">There is an error</div>';
            $data['content'] = 'student/register';
            $this->load->view('main', $data);
        }
    }

    public function getStudents($id) {
        $query = $this->db->query("select * from mtiss_db.student where `classId` = $id");
        foreach ($query->result() as $data) {
            $t['id'] = $data->id;
            $t['firstname'] = $data->firstname;
            $t['middlename'] = $data->middlename;
            $t['surname'] = $data->surname;
            $t['dateRegistered'] = $data->dateRegistered;
            $t['phoneNumber'] = $data->phoneNumber;
            $t['gender'] = $data->gender;
            $t['birthDate'] = $data->birthDate;
            $mdobaji[] = $t;
        }
        foreach ($mdobaji as $key => $value) {
            $student_data = '';
?>
            <?php

            if ($value['gender'] == 1) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }
            $student_data .= '<tr id="dataIn">';
            $student_data .= '<td>' . $value['id'] . '</td>';
            $student_data .= '<td>' . strtoupper($value['firstname']) . ' ' . strtoupper($value['middlename']) . ' ' . strtoupper($value['surname']) . '</td>';
            $student_data .= '<td>' . $gender . '</td>';
            $student_data .= '<td><a  href="searchStudent/' . $value['id'] . '">Edit</a> |<a id="delete" onclick="return deleteStudent(this)"  href="delete/' . $value['id'] . '"> Delete</a></td>';
            $student_data .= '</tr>';
            echo $student_data;
            ?>
            <?php

        }
    }

    public function listStudentSubjects($classId) {
        $result = $this->db->query("select s.id studId, s.firstname, s.surname, Chemistry, Physics, Mathematics, Civics, Geography, Islamic_Knowledge,Quran, Kiswahili, English "
                . "from student s, students_masomo sm "
                . "where s.id = sm.`studentId`  and s.`classId` = $classId");
        return $result;
    }

    public function changeSubject($studentId, $subject, $selectedSubject) {
        // all magics of subjects selection update is done over here 
        $this->db->query("UPDATE mtiss_db.students_masomo SET $subject = $selectedSubject where `studentId` = $studentId");
    }

    public function delete($id) {
        $msg = $this->db->delete('student', array('id' => $id));
        if ($msg == 1) {
            echo "Student number: $id is successfully deleted";
        }
    }

}

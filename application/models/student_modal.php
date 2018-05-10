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
            'address' => $this->input->post('address')
        );
        $results = $this->db->insert('student', $data);
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
        // $query = $this->db->get('student');
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

//        $mdobaji = array();
//        sleep(5);
        //  echo json_encode($mdobaji);
//      var_dump($mdobaji);
        foreach ($mdobaji as $key => $value) {
//            echo $value['firstname'];
            $student_data = '';
            ?>
            <?php

            $student_data .= '<tr id="dataIn">';
            $student_data .= '<td>' . $value['id'] . '</td>';
            $student_data .= '<td>' . $value['firstname'] . ' ' . $value['middlename'] . ' ' . $value['surname'] . ' (' . $value['gender'] . ')' . '</td>';
            $student_data .= '<td><a  href="searchStudent/' . $value['id'] . '">Edit</a> |<a id="delete" onclick="return deleteStudent(this)"  href="delete/' . $value['id'] . '"> Delete</a></td>';
            $student_data .= '</tr>';
            echo $student_data;
            ?>
            <?php

        }
    }

    public function delete($id) {
        $msg = $this->db->delete('student', array('id' => $id));
        if ($msg == 1) {
            echo "Student number: $id is successfully deleted";
        }
    }

}

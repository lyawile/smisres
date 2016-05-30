<?php

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
        );
        $results = $this->db->insert('student', $data);
        if (isset($results)) {
            echo 'data successfully saved';
        }
        else{
            echo 'no data saved';
        }
    }

}

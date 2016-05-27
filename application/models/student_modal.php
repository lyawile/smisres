<?php

class Student_modal extends CI_Model {

    public function insertData() {
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'middlename' => $this->input->post('middlename'),
            'surname' => $this->input->post('surname'),
            'dateRegistered' => $this->input->post('date')
        );
        $results = $this->db->insert('student', $data);
        if (isset($results)) {
            
        }
    }

}

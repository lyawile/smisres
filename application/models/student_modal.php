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
            'vision' => $this->input->post('vision')
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

}

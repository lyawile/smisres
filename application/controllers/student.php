<?php

class Student extends CI_Controller {

    public function register() {
//        $data['records'] = $this->student_modal->getData();
        $data['content'] = 'student/register';
        $this->load->view('main', $data);
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

    public function ingizaData() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('middlename', 'Middle Name', 'required');
            $this->form_validation->set_rules('surname', 'Last Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required');
            $this->form_validation->set_rules('dateOfBirth', 'Date of Birth', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['content'] = 'student/register';
                $this->load->view('main', $data);
            } else {
                $this->student_modal->insertData();
            }
        }
       
    }
    public function check_rule($input = 'accept'){
            
        }

}

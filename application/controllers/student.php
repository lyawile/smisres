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
            $this->form_validation->set_rules('surname', 'Last Name', 'required|callback_check_rule');
            if ($this->form_validation->run() == FALSE) {
                $data['content'] = 'student/register';
                $this->load->view('main', $data);
            } else {
                $this->student_modal->insertData();
            }
        }
       
    }
    public function check_rule(){
            
        }

}

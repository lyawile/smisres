<?php

class Student extends CI_Controller {

    public function register() {
        $data['successMessage'] = '';
        $data['error'] = '';
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
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);
            if ($this->form_validation->run() == TRUE && $this->upload->do_upload() == TRUE) {
                $this->student_modal->insertData();
            } else {
                $data['successMessage'] = '';
                $data['error'] = "No file selected";
                $data['content'] = 'student/register';
                $this->load->view('main', $data);
            }
        }
    }

//    public function check_rule($input = 'accept') {
//        
//    }
}

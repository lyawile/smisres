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
//            $this->form_validation->set_rules('firstname', 'First Name', 'required');
//            $this->form_validation->set_rules('middlename', 'Middle Name', 'required');
//            $this->form_validation->set_rules('surname', 'Last Name', 'required');
//            $this->form_validation->set_rules('gender', 'Gender', 'required');
//            $this->form_validation->set_rules('date', 'Date', 'required');
//            $this->form_validation->set_rules('address', 'Address', 'required');
//            $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required');
//            $this->form_validation->set_rules('dateOfBirth', 'Date of Birth', 'required');
//            $this->form_validation->set_rules('vision', 'Vision', 'required');
            //$this->form_validation->set_rules('pic', 'Picture URL', 'required');
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['overwrite'] = FALSE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('pic')) {
                echo "successfull uploaded";
//                $data = $this->upload->data();
//                session_start();
//                $picUrl = $data['upload_data']['file_name'];
//                $_SESSION['picUrl'] = $picUrl;
//                $this->load->model('student_modal');
//                $this->student_modal->insertData();
//                session_commit();
            } else {
                echo "Nothing works like a charm";
                echo $this->upload->display_errors();
            }
        }
    }

    public function load() {
        $data['content'] = 'student/load';
        $this->load->view('main', $data);
    }
    public function loadData() {
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 100;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload() == false) {
            $data['mpunga'] = $this->upload->data();
//           $this->load->view('student/data', $data);
         echo  $data['mpunga']['file_name'];
        } else {
            $data['mpunga'] = $this->upload->display_errors();
            $this->load->view('student/data', $data);
            
        }
    }

}

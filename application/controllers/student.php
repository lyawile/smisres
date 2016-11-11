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
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('userfile','FILE', 'required');
            if ($this->form_validation->run() === FALSE) {
                $message['content'] = 'student/load';
                $message['msg'] = "<p> Plese select a file</p>";
                $this->load->view('main', $message);
            }
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 100;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload() == false) {
                $data['mpunga'] = $this->upload->data();
//           $this->load->view('student/data', $data);
                $filepath = $data['mpunga']['file_path'] . $data['mpunga']['file_name'];
                $file = fopen($filepath, "r");
                $count = 0;
                while (($data = fgetcsv($file)) != false) {
                    if ($count != 0) {
                        $data = array(
                            'firstName' => $data[0],
                            'middleName' => $data[1],
                            'surname' => $data[2],
                            'birthDate' => $data[3],
                            'phoneNumber' => $data[4],
                            'Gender' => $data[5],
                            'vision' => $data[6],
                            'standardSeven' => $data[7],
                            'year' => $data[8],
                            'medium' => $data[9],
                            'dateRegistered' => date("Y-m-d h:i:s")
                        );
                        $this->db->insert('student', $data);
                    }
                    $count = $count + 1;
                }
                fclose($file);
                unlink($filepath);
                $message['content'] = 'student/load';
                $message['msg'] = "<p> Data upload is succcessful</p>";
                $this->load->view('main', $message);
            } else {
                $data['mpunga'] = $this->upload->display_errors();
                //$this->load->view('student/data', $data);
            }
        }
    }

}

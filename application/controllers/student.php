<?php

class Student extends CI_Controller {

    public function register() {
        $data['successMessage'] = '';
        $data['error'] = '';
        $data['content'] = 'student/register';
        $this->load->view('main', $data);
    }
    public function viewStudents(){
        $file['content'] = 'student/viewStudents';
        $this->load->view('main',$file);
    }
    public function searchStudent() {
//        $data = $this->db->get('student', array(766));
       $studentId =  $this->input->post('studentId');
        $data = $this->db->query("SELECT * FROM student WHERE id = '$studentId'");
        foreach ($data->result() as $arr) {
            $firstname =  $arr->firstname;
            $middlename =  $arr->middlename;
            $surname =  $arr->surname;
            $dateRegistered = $arr->dateRegistered;
            $gender = $arr->gender;
            $birthDate = $arr->birthDate;
            $phoneNumber = $arr->phoneNumber;
            $picUrl = $arr->picUrl;
            $vision = $arr->vision;
            $standardSeven = $arr->standardSeven;
            $year = $arr->year;
            $medium = $arr->medium;
        }
        $editData['username'] = $surname;
        $editData['firstname'] = $firstname;
        $editData['middlename'] = $middlename;
        $editData['dateRegistered'] =$dateRegistered;
        $editData['gender'] = $gender;
        $editData['birthDate'] = $birthDate;
        $editData['phoneNumber'] = $phoneNumber;
        $editData['picUrl'] = $picUrl;
        $editData['vision'] = $vision;
        $editData['standardSeven'] = $standardSeven;
        $editData['year'] = $year;
        $editData['medium'] = $medium;
        $editData['content'] = 'student/editRegistration';
        var_dump($editData);
        $this->load->view('main', $editData);
    }

    public function delete() {
        
    }

    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('middlename', 'Middle Name', 'required');
            $this->form_validation->set_rules('surname', 'Last Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required');
            $this->form_validation->set_rules('dateOfBirth', 'Date of Birth', 'required');
            $this->form_validation->set_rules('vision', 'Vision', 'required');
//            $this->form_validation->set_rules('pic', 'Picture URL', 'required');
            $this->form_validation->set_rules('stdSeven', 'Standard Seven School', 'required');
            $this->form_validation->set_rules('stdSevenYear', 'Standard Seven  Year', 'required');
            $this->form_validation->set_rules('medium', 'School medium', 'required');
            $config['upload_path'] = './files/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['overwrite'] = FALSE;
            $this->load->library('upload', $config);
            if ($this->form_validation->run() === TRUE) {
                $this->upload->do_upload('pic');
                $data = $this->upload->data();
                $this->load->model('student_modal');
                $this->student_modal->insertData();
                session_commit();
            } else {
                $data['content'] = 'student/register';
                $this->load->view('main', $data);
            }
        } else {
            $data['content'] = 'student/register';
            $this->load->view('main', $data);
        }
    }

    public function load() {
        $data['content'] = 'student/load';
        $this->load->view('main', $data);
    }
//    public function searchStudent(){
//        echo $this->input->post('studentId');
//    }

    public function loadData() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('userfile', 'FILE', 'required');
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
                $message = "<p> Data upload is succcessful</p>";
                echo $message;
            } else {
                $data['mpunga'] = $this->upload->display_errors();
                //$this->load->view('student/data', $data);
            }
        }
    }

}

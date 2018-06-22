<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller {

    public function register() {
        $data['successMessage'] = '';
        $data['error'] = '';
        $data['content'] = 'student/register';
        $this->load->view('main', $data);
    }

    public function viewStudents() {
        $class = $this->db->get('stream');
        $file['class'] = $class;
        $file['content'] = 'student/viewStudents';
        $this->load->view('main', $file);
    }

    public function searchStudent($studentIdFromEdit = null) {
//        if(null === $studentIdFromEdit){
//            $studentIdFromEdit = 1;
//        }
//        $data = $this->db->get('student', array(766));
        if ($studentIdFromEdit <> null) {
            $studentId = $studentIdFromEdit;
        } else {
            $studentId = $this->input->post('studentId');
        }
        $data = $this->db->query("SELECT * FROM student WHERE id = '$studentId'");
        foreach ($data->result() as $arr) {
            $firstname = $arr->firstname;
            $middlename = $arr->middlename;
            $surname = $arr->surname;
            $dateRegistered = $arr->dateRegistered;
            $gender = $arr->gender;
            $birthDate = $arr->birthDate;
            $phoneNumber = $arr->phoneNumber;
            $picUrl = $arr->picUrl;
            $vision = $arr->vision;
            $standardSeven = $arr->standardSeven;
            $year = $arr->year;
            $medium = $arr->medium;
            $address = $arr->address;
        }
        $editData['username'] = $surname;
        $editData['firstname'] = $firstname;
        $editData['middlename'] = $middlename;
        $editData['dateRegistered'] = $dateRegistered;
        $editData['gender'] = $gender;
        $editData['birthDate'] = $birthDate;
        $editData['phoneNumber'] = $phoneNumber;
        $editData['picUrl'] = $picUrl;
        $editData['vision'] = $vision;
        $editData['standardSeven'] = $standardSeven;
        $editData['year'] = $year;
        $editData['medium'] = $medium;
        $editData['address'] = $address;
        $editData['studentId'] = $studentId;
        $editData['content'] = 'student/editRegistration';
        //  var_dump($editData); // for debugging 
        $this->load->view('main', $editData);
    }

    public function delete($studentId) {
        $this->load->model('student_modal');
        $result = $this->student_modal->delete($studentId);
    }

    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'required|callback_validateHumanName');
            $this->form_validation->set_rules('middlename', 'Middle Name', 'required|callback_validateHumanName');
            $this->form_validation->set_rules('surname', 'Last Name', 'required|callback_validateHumanName');
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


    function path() {
        echo APPPATH . 'other part of url';
    }

    public function listStudent($data) {
        $this->load->model('student_modal');
        $this->student_modal->getStudents($data);
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->input->post();
            if (!empty($_FILES['picUrl']['name'])) {
                $config['upload_path'] = './files/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $config['overwrite'] = FALSE;
                $this->load->library('upload', $config);
                $this->upload->do_upload('picUrl');
                $data['picUrl'] = $this->upload->data()['file_name'];
            }
            $id = $data['id'];
            $this->db->where('id', $id);
            $result = $this->db->update('student', $data);
            if ($result == TRUE) {
                $editData['success_update'] = '<div class="success">data successfully updated</div>';
            }
            $editData['picUrl'] = $data['picUrl'];
            $editData['username'] = $data['surname'];
            $editData['firstname'] = $data['firstname'];
            $editData['middlename'] = $data['middlename'];
            $editData['dateRegistered'] = $data['dateRegistered'];
            $editData['gender'] = $data['gender'];
            $editData['birthDate'] = $data['surname'];
            $editData['phoneNumber'] = $data['phoneNumber'];
            $editData['birthDate'] = $data['birthDate'];
            $editData['vision'] = $data['vision'];
            $editData['standardSeven'] = $data['standardSeven'];
            $editData['year'] = $data['year'];
            $editData['medium'] = $data['medium'];
            $editData['address'] = $data['address'];
            $editData['studentId'] = $data['studentId'];
            $editData['content'] = 'student/editRegistration';
            $editData['content'] = 'student/editRegistration';
            $editData['medium'] = $data['medium'];
            $this->load->view('main', $editData);
            ?>
            <pre>
                <?php // print_r($editData);   ?>
            </pre>

            <?php
        }
    }

    public function scoreTemplate() {
        $data['content'] = 'student/scoreTemplate';
        $data['result'] = $this->db->get('subject');
        $this->load->view('main', $data);
    }

    public function loadListView() {
        $data['content'] = 'student/liststudentsubjects';
        $this->load->view('main', $data);
    }

    public function listStudentSubjects($classId = 2) {
//        $data['content'] = 'student/liststudentsubjects';
//        $data['result'] = $this->db->get('subject');
        $this->load->model('student_modal');
        $t = $this->student_modal->listStudentSubjects($classId);
        // $this->load->view('main', $data);
//       var_dump($t);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Names</th>
                    <th scope="col">Chemistry</th>
                    <th scope="col">Physics</th>
                    <th scope="col">Mathematics</th>
                    <th scope="col">Civics</th>
                    <th scope="col">Geography</th>
                    <th scope="col">Islamic Knowledge</th> <!-- In the  database Islamic_Knowledge-->
                    <th scope="col">Quran</th>
                    <th scope="col">Kiswahili</th>
                    <th scope="col">English</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($t->result() as $data) {
                    ?>
                    <tr>
                        <td scope="row"><?php echo $data->firstname . " " . $data->surname; ?></td>
                        <td>
                            <div >
                                <label><input id="Chemistry" type="checkbox" <?php if ($data->Chemistry == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Physics" type="checkbox" <?php if ($data->Physics == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Mathematics" type="checkbox" <?php if ($data->Mathematics == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Civics" type="checkbox" <?php if ($data->Civics == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Geography" type="checkbox" <?php if ($data->Geography == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Islamic_Knowledge" type="checkbox" <?php if ($data->Islamic_Knowledge == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Quran" type="checkbox" <?php if ($data->Quran == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="Kiswahili" type="checkbox" <?php if ($data->Kiswahili == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <div >
                                <label><input id="English" type="checkbox" <?php if ($data->English == 1) echo "checked" ?> value="" ></label>
                            </div>
                        </td>
                        <td>
                            <a href="" id="<?php echo $data->studId ?>"  class="changeSub">Change</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function changeSub($studentId, $subject, $selectedSubject) {
        $this->load->model('student_modal');
        $this->student_modal->changeSubject($studentId, $subject, $selectedSubject);
    }

    public function validateHumanName($name) {
        if (preg_match('/^[A-Za-z\']+$/', $name)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validateHumanName', 'The %s is invalid');
            return FALSE;
        }
    }

}
?>

<?php

class result_config extends CI_Controller {

    public function index($result = false) {

        $this->load->model('result_model');
        $resultForTerm = $this->result_model->getActiveTerm();
        $data['active'] = $resultForTerm[0];
        $data['term'] = $resultForTerm[1];
        $data['result'] = $result;
        $data['content'] = 'config/grade_config';
        $this->load->view('main', $data);
    }

    public function updateTerm() {
        if (count($_POST) > 0) {
            $term = $this->input->post('term');
            $this->load->model('result_model');
            $result = $this->result_model->updateTerm($term);
            if ($result == 'OK') {
                $this->index($result);
            }
        } else {
            $this->index();
        }
    }

    // dsplay grades configuration per class 
    public function displayGrades($classId) {
         $this->db->where(['stream_id'=>$classId]);
        $grades = $this->db->get('grade_config');
        foreach ($grades->result() as $grades){
            $scoreRanges[]=$grades;
        }
        $params['grades'] = $scoreRanges; 
        $data = 'config/display_grades';
        $this->load->view($data,$params);
    }

}

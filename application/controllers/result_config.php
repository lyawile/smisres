<?php
class result_config extends CI_Controller{
    public function index(){
        $data['content'] = 'config/grade_config';
        $this->load->view('main', $data);
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|callback_validateHumanName');
            $this->form_validation->set_rules('middlename', 'Middle Name', 'trim|required|callback_validateHumanName');
            $this->form_validation->set_rules('surname', 'Surname', 'trim|required|callback_validateHumanName');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password','Password', 'trim|min_length[5]|required');
            $this->form_validation->set_rules('cpassword', 'Password confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() === TRUE) {
                $data['content'] = 'user/register';
                $post = 1; // assumed value to be passed to the model action register to help inserting data into the database
                $this->load->model('user_model');
                $data['user_category'] = $this->user_model->register($post);
                $this->form_validation->unset_field_data();
                $data['success'] = '<div class="success" style="margin-bottom: 20px;">User is successfully created</div>';
                $data['content'] = 'user/register';
                $this->load->view('main', $data);
            } else {
                $data['content'] = 'user/register';
                $this->load->model('user_model');
                $data['user_category'] = $this->user_model->register();
                $this->load->view('main', $data);
            }
        } else {
            $data['content'] = 'user/register';
            $this->load->model('user_model');
            $data['user_category'] = $this->user_model->register();

            $this->load->view('main', $data);
        }
    }

    public function edit() {
        
    }

    public function changePassword() {
        
    }
    public function login(){
        $this->load->view('user/login');
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

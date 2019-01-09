<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|callback_validateHumanName');
            $this->form_validation->set_rules('middlename', 'Middle Name', 'trim|required|callback_validateHumanName');
            $this->form_validation->set_rules('surname', 'Surname', 'trim|required|callback_validateHumanName');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|required');
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

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // if submit button is pressed
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $this->load->model('user_model');
            $data = $this->user_model->login($username, $password);
            $numberOfRows = $data->num_rows(); // number of rows after submitting username and password
            if ($numberOfRows == 1) {
                $newdata = array(
                    'username' => $username,
                    'email' => 'johndoe@some-site.com',
                    'logged_in' => TRUE,
                    'login_time' => date("Y-M-d H:i:s")
                );
                $this->session->set_userdata($newdata); // set session values
                redirect('student/register');
            } else {
                $message['loginError'] = "Username or password is incorrect";
                $this->load->view('user/login', $message);
            }
        } else {
            $this->load->view('user/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy(); // destroy the session values 
        redirect('user/login'); // redirect to login page 
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

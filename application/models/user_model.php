<?php

class user_model extends CI_Model {

    public function register($post = NULL) {
        if ($post == 1) { // pos is set in the controller on successful form submit.  If form was not successfully submitted, 
            //the pos is by default NULL
            $data['firstname'] = $this->input->post('firstname');
            $data['middlename'] = $this->input->post('middlename');
            $data['surname'] = $this->input->post('surname');
            $data['category'] = $this->input->post('group');
            $data['password'] = md5($this->input->post('password'));
            $data['gender'] = $this->input->post('gender');
            $data['username'] = $this->input->post('username');
            $username = $this->input->post('username');
            $data['active'] = 1;
            $query = $this->db->query("SELECT `UserID` FROM `user`  WHERE username ='$username'");
            $numberOfUsers = $query->num_rows();
            if ($numberOfUsers == 0) {
                // if 0 insert data into the database
                $this->db->insert('user', $data);
            } else {
                $data['usernameErrpr'] = "the user " . $username . " exists"; // the form data repopulate is required, will be implemented in the future 
                $data['content'] = 'user/register';
                return $this->db->query("SELECT id, `group` FROM user_category ");
                $this->load->view('main', $data);
            }
        }
        return $this->db->query("SELECT id, `group` FROM user_category ");
    }
    public function login($username, $password){
        return $this->db->query("SELECT `UserID` FROM `user`  WHERE username = '$username' and password = '$password'"); 
    }

}

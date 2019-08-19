<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author Admin
 */
class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->add_package_path(APPPATH . 'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }
    
    

}

<?php
if (!defined('BASEPATH')) exit('No direct script access allowed.');
class MY_Form_validation extends CI_Form_validation {

 public function MY_Form_validation() {
    parent::__construct();
  }

  public function unset_field_data()
    {    
        unset($this->_field_data);    
    }
}
<?php 
class Person{
    public function __construct() {
        echo 'Constructed';;
    }
}

$obj = new Person();
return $obj;
<?php 
class Person{
    public function __construct() {
        echo rand(100, 300);
    }
}
$obj = new Person();
return $obj;
<?php

class Config{
    private $url = 'http://3.134.11.97:8112';
    private $db = 'ODOO';
    private $username = 'admin';
    private $password = 'admin';


    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
    }
    
    public function __set($property, $value) {
    if (property_exists($this, $property)) {
        $this->$property = $value;
        }
    }
    
    public function __construct($url , $db , $username , $password){
        $this->url = $url;
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }

}


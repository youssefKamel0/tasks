<?php 

namespace App\Config;

class Config {

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'ecommerce_nti';

    public $conn;

    public function __construct() {

        $this->conn = new \mysqli($this->host,$this->user, $this->password, $this-> database);


        // if ($this->conn->connect_error) {

        //     echo "bad";

        // } else {

        //     echo "sucsess";

        // }

    }


}

// new connection;

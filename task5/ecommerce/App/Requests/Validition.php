<?php

namespace App\Requests;
use App\Models\model;

class Validition {

    private $input_value;
    private $input_name;
    private $errors_list = [];

    private $file =[];

    public function required() {

        if (empty($this->input_value)) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Is Required ";

        }
        
        return $this;
    }

    public function string() { 

        if (!is_string($this->input_value) ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Should Be String ";

        }
        return $this;

    }

    public function unique($table, $col) {

        $query = "SELECT * FROM {$table} WHERE {$col} = ?";
        $model = new model;
        $statment = $model->conn->prepare($query);
        if (!$statment) {

            $this->errors_list[$this->input_name][__FUNCTION__] = "unexpected Error, Please Try Again";
        }
        $statment->bind_param("s", $this->input_value);
        $statment->execute();
        if ( $statment->get_result()->num_rows == 1 ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Already In Use, Please Select Another " . $this->input_name;

        }

        return $this;
    }

    public function exists($table, $col) {

        $query = "SELECT * FROM {$table} WHERE {$col} = ?";
        $model = new model;
        $statment = $model->conn->prepare($query);
        if (!$statment) {

            $this->errors_list[$this->input_name][__FUNCTION__] = "unexpected Error, Please Try Again";
        }
        $statment->bind_param("s", $this->input_value);
        $statment->execute();
        if ( $statment->get_result()->num_rows == 0 ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Not Exist ";

        }

        return $this;
    }
    public function between(int $min, int $max) {

        if ( !strlen($this-> input_value) >= $min && ! strlen($this->input_value) < $max  ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Should Be between " . $min . " Characters and " . $max . " Characters" ;

        }
        return $this;

    }

    public function in(array $values) {

        if (!in_array($this->input_value, $values)) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " accepted values " . implode(", ", $values) ;

        }
        return $this;

    }

    public function pass_confirm(string $sec_pass) {

        if ($this->input_value !== $sec_pass) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Not Match" ;


        }

        return $this;

    }
    public function regex(string $pattern, $message = null) {

        if (!preg_match($pattern, $this->input_value ) ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $message ?? $this->input_name . " pattern not valid";

        }

        return $this;

    }

    public function validate_email() {

        if (! filter_var($this->input_value, FILTER_VALIDATE_EMAIL) ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Not Valid" ;

        }

        return $this;
    }

    
    public function numirc() { 

        if (!is_numeric($this->input_value) ) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $this->input_name . " Should Be number ";

        }
        return $this;

    }


    /**
     * Set the value of input_value
     */
    public function setInputValue($input_value): self
    {
        $this->input_value = $input_value;

        return $this;
    }

    /**
     * Set the value of input_name
     */
    public function setInputName($input_name): self
    {
        $this->input_name = $input_name;

        return $this;
    }

    /**
     * Get the value of errors_list
     */
    public function getErrorsList()
    {
        return $this->errors_list;
    }

    public function error($input_name){

        if (isset($this->errors_list[$input_name])) {

            foreach ($this->errors_list[$input_name] as $error) {

                $message = "<div class='alert alert-danger'> {$error} </div>";
                return $message;
    
            }
    
        }

        
    }



    /**
     * Set the value of file
     */
    public function setFile(array $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function size(int $maxSize) {

        if ($this->file['size'] > $maxSize) {

            $this->errors_list[$this->input_name][__FUNCTION__] = " Image Should Be less than " . $maxSize ;


        }

        return $this;

    }

    public function extensions(array $availableExtension) {

        $extension = explode('/',$this->file['type'])[1];

        if (!in_array($extension, $availableExtension)) {

            $this->errors_list[$this->input_name][__FUNCTION__] = $extension . " not supported" ;


        }


        return $this;

    }



}












?>
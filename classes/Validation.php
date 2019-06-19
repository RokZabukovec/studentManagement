<?php
require_once 'core/init.php';


class Validation{
    private $_passed = false;
    private $_errors = array();
    private $_db = null;

    public function _construct(){
        $this->_db = DB::getInstance();
}
    public function check($data, $items = array()){
        foreach($items as $input => $rules){
            $input = escape($input);
            foreach($rules as $rule => $expected_value){
                $input_data = trim($data[$input]);
                if(array_key_exists('required', $rules) && $rule === 'required' && empty($input_data)){
                    $this->addError($rules['input_name'], "The ? is required.");
                }else if(!empty($input_data)){
                    switch ($rule){
                        case 'min_length':
                            if(strlen($input_data) < $expected_value){
                                $this->addError($rules['input_name'], "The ? must be at least {$expected_value} characters long.");
                        }
                            break;
                        case 'max_length':
                            if(strlen($input_data) > $expected_value){
                                $this->addError($rules['input_name'], "The ? must not exceed {$expected_value} characters.");
                            }
                            break;
                        case 'unique':
                            $unique = DB::getInstance()->get($expected_value, array($input, '=', $input_data))->all();
                            if($unique){
                                $this->addError($input_data, "Username '?' already taken.");
                            }
                            break;
                        case 'matches':
                                if($input_data != $data['password']){
                                    $this->addError($rules['input_name'], "Passwords doesn't match.");
                                }
                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }

    public function addError($field_name, $message){
        $error_message = str_replace('?',$field_name,$message);
        array_push($this->_errors, $error_message);
    }
}
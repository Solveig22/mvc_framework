<?php

namespace Enway\App\Core;

class Validate {


    private $passed;
    private $errors = [];
    private $db;


    public function __construct() {
        $this->db = Database::getInstance();
    }

    public static function check($source, $items) {
        $this->errors = [];

        foreach($items as $item => $rules) {
            $item = Input::sanitize($item);
            $display = $rules['display'];

            foreach($rules as $rule => $rule_value) {

                $value = Input::sanitize(trim($source[$item]));

                if($rule === 'required' && empty($value)) {
                    $this->addError([" Le {$display} est un champ requis!", $item]);
                }else {

                    switch($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError(["{$display} doit contenire au mois {$rule_value} caractères!", $item]);
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError(["{$display} ne doit pas dépasser {$rule_value} caractres!", $item]);
                            }
                        break;
                        case 'matches':
                            $match = Input::sanitize(trim($source[$rule_value]));
                            $match_display = $items[$rule_value]['display'];
                            if($value !== $match) {
                                $this->addError(["{$display} et {$match_display} ne sont pas identiques!", $item]);
                            }
                        break;
                        case 'unique':
                            $check = $this->db->query("SELECT {$item} FROM $rule_value WHERE {$item} = ?", [$value]);
                            if($check->rowCount()) {
                                $this->addError(["{$display} existe déjà!", $item]);
                            }
                        break;
                    }

                }
            }
        }

    }

    protected function addError($error) {
        $this->errors[] = $error;
        $this->passed = empty($error);
    }

}
<?php

namespace Overland\Core;

class Validator {
    protected array $input = [];
    protected array $rules = [];
    protected array $errors = [];

    private function __construct($input, $rules)
    {
        $this->input = $input;
        $this->rules = $rules;   
    }

    public static function make($input, $rules) {
        return new static($input, $rules);
    }

    public function validate() {
        $validInput = [];
        foreach($this->rules as $key => $value) {
            if(!isset($this->input[$key]) && $value['required']) {
                $this->errors[] = "{$key} is required";
                continue;
            }
            if(!isset($this->input[$key])) continue;

            $is_valid = rest_validate_value_from_schema($this->input[$key], $value, $key);
            if($is_valid !== true) {
                $this->errors = [...$this->errors, ...$is_valid->get_error_messages()];
                continue;
            }
            $validInput[] = $this->input[$key];
        }
        $this->showErrors();
        return $validInput;
    }

    protected function showErrors() {
        if(count($this->errors)) {
            echo json_encode($this->errors);
            exit;
        }
    }
}

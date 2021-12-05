<?php

namespace Overland\Core;

class Controller {
    protected function validate($input, $rules) {
        return Validator::make($input, $rules)->validate();
    }
}

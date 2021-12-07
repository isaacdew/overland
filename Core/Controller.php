<?php

namespace Overland\Core;

abstract class Controller {
    
    protected function validate($input, $rules) {
        return Validator::make($input, $rules)->validate();
    }

    protected function authorize($capability) {
        if ( ! current_user_can( $capability ) ) {
            status_header( 403 );
            exit;
        }
        return true;
    }
}

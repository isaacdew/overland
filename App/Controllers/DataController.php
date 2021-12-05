<?php

namespace Overland\App\Controllers;

use Overland\Core\Controller;
use WP_REST_Request;

class DataController extends Controller {
    public function test(WP_REST_Request $request) {
        $valid = $this->validate($request->get_params(), [
            'test' => [
                'required' => true,
                'type' => 'integer'
            ]
        ]);
        
        var_dump($valid);
        return [
            'data' => true
        ];
    }
}

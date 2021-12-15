<?php

namespace Overland\App\Controllers;

use Overland\Core\Controller;
use Overland\Core\Facades\Auth;
use WP_REST_Request;

class ExampleController extends Controller {
    public function test(WP_REST_Request $request) {
        // Validation
        $valid = $this->validate($request->get_params(), [
            'test' => [
                'required' => true,
                'type' => 'integer'
            ]
        ]);
        
        return $valid;
    }

    public function wordpress() {
        return ['version' => get_bloginfo('version')];
    }

    public function authenticate(WP_REST_Request $request) {
        $username = $request->get_param('username');
        $password = $request->get_param('password');

        return Auth::authenticate($username, $password);
    }
}

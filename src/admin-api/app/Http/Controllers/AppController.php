<?php

namespace App\Http\Controllers;

use App\Util\Permission;

class AppController extends Controller
{
    protected function allowIf($actions, $user = null, $mode = 'all')
    {
        $allowed = Permission::checkAll($actions, $user, $mode);
        if (!$allowed) {
            $response = [
                'success' => false,
                'reason' => 'not_allowed'
            ];
            response()->json($response)->send();
            die();
        }
        return true;
    }
}

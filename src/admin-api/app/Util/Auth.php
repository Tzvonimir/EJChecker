<?php

namespace App\Util;

class Auth
{
    public static function user()
    {
        return \JWTAuth::parseToken()->toUser();
    }
}

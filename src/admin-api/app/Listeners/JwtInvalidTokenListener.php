<?php

namespace App\Listeners;

class JwtInvalidTokenListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle()
    {
        return response()->json([
            'success' => false,
            'reason' => 'invalid_token'
        ]);
    }
}
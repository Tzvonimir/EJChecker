<?php

namespace Tests;

use App\Console\Kernel;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected $user;
    protected $token;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Refresh database before every test.
     */
    public function setUp()
    {
        parent::setUp();
        // $exitCode = Artisan::call('migrate:refresh');
        // $this->assertEquals(0, $exitCode);
    }

    /**
     * Gets a token and logins a user.
     */
    public function login()
    {
        $this->user = User::first();
        $this->token = JWTAuth::fromUser($this->user);

        $login = [
            'email' => $this->user->email,
            'password' => 'secret'
        ];
        $this->token = JWTAuth::attempt($login);
    }

    /**
     * json() wrapper which also sends an auth token.
     */
    public function jsonAuth($method, $uri, $data = [], $headers = [])
    {
        if ($this->user) {
            $tokenHeader = 'Bearer: ' . $this->token;
            $headers['Authorization'] = $tokenHeader;
        }
        return $this->json($method, $uri, $data, $headers);
    }
}

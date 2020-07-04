<?php

namespace test;

use PHPUnit\Framework\TestCase;
use Slim\Http\Environment;
use Slim\Http\Request;

class BaseTestClass extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        $this->app = require __DIR__ . '/../bootstrap/app.php';
    }

    public function populateCreateData()
    {
        return [
            'name'  => "MD. Abdullah Al Mamun.",
            'email' => rand()."as@gmail.com",
            'pass'  => "1234"
        ];
    }

    public function populateUpdateData()
    {
        return [
            'id'  => 1,
            'name'  => "MD. Abdullah Al Mamun.",
            'email' => rand()."as@gmail.com",
            'pass'  => "1234"
        ];
    }
}
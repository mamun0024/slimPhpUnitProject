<?php

namespace test;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserModelTest extends TestCase
{
    private $userClass;

    protected function setUp(): void
    {
        $this->userClass = new User();
    }

    public function testCreateUserReturnStatusCode201(): void
    {
        $userData = [
            'name'  => "MD. Abdullah Al Mamun.",
            'email' => rand()."as@gmail.com",
            'pass'  => "1234"
        ];
        $this->assertEquals(201, $this->userClass->createOrUpdate($userData)['statusCode']);
    }
}

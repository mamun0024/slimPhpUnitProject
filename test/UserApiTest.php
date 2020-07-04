<?php

namespace test;

require_once 'BaseTestClass.php';

class UserApiTest extends BaseTestClass
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testBehavior(): void
    {
        $this->assertTrue(true);
    }
}
<?php

namespace test;

use App\Models\User;

require_once 'BaseTestClass.php';

class UserModelTest extends BaseTestClass
{
    protected $userClass;
    private $userUpdateData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userClass = new User();
    }

    public function testCreateUserReturnStatusCode201(): void
    {
        $userInsertData = $this->populateCreateData();
        $this->assertEquals(201, $this->userClass->createOrUpdate($userInsertData)['code']);
    }

    public function testUpdateUserReturnStatusCode200(): void
    {
        $this->userUpdateData = $this->populateUpdateData();
        $this->assertEquals(200, $this->userClass->createOrUpdate($this->userUpdateData)['code']);
    }

    public function testConflictRequestReturnStatusCode409(): void
    {
        $this->assertEquals(409, $this->userClass->createOrUpdate($this->userUpdateData)['code']);
    }
}

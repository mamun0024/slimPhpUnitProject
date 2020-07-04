<?php

namespace test;

use App\Models\User;

require_once 'BaseTestClass.php';

class UserModelTest extends BaseTestClass
{
    protected $userModel;
    private $userUpdateData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userModel = new User();
    }

    public function testCreateUserReturnStatusCode201(): void
    {
        $userInsertData = $this->populateCreateData();
        $this->assertEquals(201, $this->userModel->createOrUpdate($userInsertData)['code']);
    }

    public function testUpdateUserReturnStatusCode200(): void
    {
        $this->userUpdateData = $this->populateUpdateData();
        $this->assertEquals(200, $this->userModel->createOrUpdate($this->userUpdateData)['code']);
    }

    public function testConflictRequestReturnStatusCode409(): void
    {
        $this->assertEquals(409, $this->userModel->createOrUpdate($this->userUpdateData)['code']);
    }
}

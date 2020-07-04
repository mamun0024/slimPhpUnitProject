<?php

namespace test;

use App\Utils\Traits\HelperTrait;
use PHPUnit\Framework\TestCase;

class HelperTraitTest extends TestCase
{
    use HelperTrait;

    public function testCheckWithNull(): void
    {
        $this->assertFalse($this->emptyCheck(null));
    }

    public function testCheckWithEmptyValue(): void
    {
        $this->assertFalse($this->emptyCheck(''));
    }

    public function testCheckWithIsset(): void
    {
        $value = null;
        $this->assertFalse($this->emptyCheck($value));
    }

    public function testCheckWithValue(): void
    {
        $value = 1;
        $this->assertTrue($this->emptyCheck($value));
    }
}
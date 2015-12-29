<?php

class CTest extends PHPUnit_Framework_TestCase
{
    private function createPartialMock($class_name) {
        $mock = Mockery::mock($class_name);
        $mock->makePartial();
        $mock->shouldAllowMockingProtectedMethods();

        return $mock;
    }

    public function testPassthru()
    {
        require_once(__DIR__ . '/../src/usec.php');
        $mock_c2 = $this->createPartialMock('C2');
        $mock_c2->shouldReceive('bar')->andReturn('mock bar');
        $mock_usec = $this->createPartialMock('UseC2');
        $mock_usec->shouldReceive('getC')->andReturn($mock_c2);

        $mock_c2->shouldReceive('foo')->once(); // ->passthru(); が必要
        $mock_c2->shouldReceive('bar')->once();
        $mock_c2->shouldReceive('insideBar')->never();

        $this->assertEquals('mock bar', $mock_usec->complexFunction());
    }

    public function testShouldReceive()
    {
        require_once(__DIR__ . '/../src/usec.php');
        $mock_c2 = $this->createPartialMock('C2');
        $mock_c2->shouldReceive('bar')->andReturn('mock bar');
        $mock_usec = $this->createPartialMock('UseC2');
        $mock_usec->shouldReceive('getC')->andReturn($mock_c2);

        $mock_c2->shouldReceive('foo')->once()->passthru();
        $mock_c2->shouldReceive('bar')->once();
        $mock_c2->shouldReceive('noSuchMethod')->once();

        $this->assertEquals('mock bar', $mock_usec->complexFunction());
    }
}


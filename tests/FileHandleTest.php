<?php declare(strict_types = 1);

namespace App\Test;

use App\FileHandler;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Mockery;
use PHPUnit\Framework\TestCase;

class FileHandleTest extends TestCase{

    private $ctrl;
    private $lines = [];

    public function setUp() : void
    {
        $this->ctrl = new FileHandler;
    }

    public function testCanBeInstanced()
    {
        $this->assertTrue(Mockery::type(FileHandler::class)->match($this->ctrl));
    }
}
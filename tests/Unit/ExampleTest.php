<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Helpers;

class ExampleTest extends TestCase
{
    public function testSlugify(): void
    {
        $this->assertEquals('hello-world', Helpers::slugify('Hello World!'));
    }
}
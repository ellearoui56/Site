<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Helpers;

class HelpersTest extends TestCase
{
    public function testSlugifyRemovesSpecialChars(): void
    {
        $this->assertEquals('hello-world', Helpers::slugify('Hello World!'));
        $this->assertEquals('php-8-3', Helpers::slugify('PHP 8.3'));
    }

    public function testExcerptTrimsHtmlAndLength(): void
    {
        $html = '<p>This is a long text that exceeds the limit for excerpt testing purposes.</p>';
        $excerpt = Helpers::excerpt($html, 20);
        $this->assertStringNotContainsString('<p>', $excerpt);
        $this->assertLessThanOrEqual(23, strlen($excerpt)); // ... added
    }

    public function testRandomStringLength(): void
    {
        $str = Helpers::randomString(8);
        $this->assertEquals(16, strlen($str)); // hex, 8 bytes = 16 hex chars
    }

    public function testSanitizeFileName(): void
    {
        $this->assertEquals('my_file_1.jpg', Helpers::sanitizeFileName('my file (1).jpg'));
    }

    public function testFormatBytes(): void
    {
        $this->assertEquals('1 KB', Helpers::formatBytes(1024));
        $this->assertEquals('1 MB', Helpers::formatBytes(1048576));
    }
}
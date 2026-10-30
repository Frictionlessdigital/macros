<?php

namespace Fls\Macros\Tests\Str;

use Fls\Macros\Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class NcSlugTest extends TestCase
{
    #[Test]
    #[DataProvider('slugProvider')]
    public function it_will_create_a_slug(string $expected, string $value, string $separator = '-'): void
    {
        $this->assertSame($expected, Str::ncSlug($value, $separator));
    }

    public static function slugProvider(): array
    {
        return [
            'plain text retains its case' => ['Hello-World', 'Hello World'],
            'accented letters become ASCII' => ['Creme-brulee', 'Crème brûlée'],
            'underscores become default separators' => ['one-two-three', 'one_two three'],
            'repeated whitespace and separators collapse' => ['one-two', "  --one_ \t two--  "],
            'punctuation is removed' => ['RockRoll-2026', 'Rock&Roll! 2026'],
            'empty input' => ['', ''],
            'input without letters or numbers' => ['', ' !@# '],
            'underscore separator converts hyphens' => ['one_two_three', 'one-two three', '_'],
            'period separator escapes regex characters' => ['one.two', 'one-- two', '.'],
        ];
    }
}

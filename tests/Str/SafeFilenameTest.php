<?php

namespace Fls\Macros\Tests\Str;

use Fls\Macros\Tests\TestCase;
use Illuminate\Support\Str;

class SafeFilenameTest extends TestCase
{
    /**
     * @test
     * @dataProvider  it_will_handle_various_strings_provider
     */
    public function it_will_handle_various_strings(string $expected, string $string): void
    {
        $this->assertEquals($expected, Str::safeFilename($string, ' '));
    }

    /**
     * @return array[]
     */
    public function it_will_handle_various_strings_provider(): array
    {
        return [
            'regular string' => [
                'Sign-in sheet.pdf',
                'Sign-in sheet.pdf',
            ],

            'longer than 255 characters' => [
                'odzpcshFmRyOVHAJ3U3DT8dbkr4EDISpGQHJafNMMBsECGNuhvIEDAVVVV51tduBfADjibjwYyVNcg30BJDNDgLj7Kh7bnaKKtwICeo5zywnipZ6b08a2eMqXIhJx8pl5bY0QzehhrcjxTo05QcC31muxicpoqjxJdF2LX3SeoIMOXwL5J5lCfkTDTUFLUooRSmxBC18ivVLZFqkKJJqJJK1gDCyiJv9ygpc9LcrmuhWscVT2ibqvGXDC4o.pdf',
                'odzpcshFmRyOVHAJ3U3DT8dbkr4EDISpGQHJafNMMBsECGNuhvIEDAVVVV51tduBfADjibjwYyVNcg30BJDNDgLj7Kh7bnaKKtwICeo5zywnipZ6b08a2eMqXIhJx8pl5bY0QzehhrcjxTo05QcC31muxicpoqjxJdF2LX3SeoIMOXwL5J5lCfkTDTUFLUooRSmxBC18ivVLZFqkKJJqJJK1gDCyiJv9ygpc9LcrmuhWscVT2ibqvGXDC4oZP4Tv.pdf',
            ],
            'weird characters' => [
                'Sign-in sheet for July 14 2022.pdf',
                'Sign-in sheet for @ July 14, ~ /2022.pdf',
            ],
        ];
    }
}

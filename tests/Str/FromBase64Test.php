<?php

namespace Fls\Macros\Tests\Str;

use Fls\Macros\Tests\TestCase;
use Illuminate\Support\Str;

class FromBase64Test extends TestCase
{
    /**
     * @test
     * @dataProvider  it_will_handle_various_strings_provider
     */
    public function it_will_handle_various_strings(string $expected, string $string): void
    {
        $this->assertEquals($expected, Str::fromBase64($string));
    }

    /**
     * @return array[]
     */
    public function it_will_handle_various_strings_provider(): array
    {
        return [
            'regular string' => [
                '',
                '',
            ],

            'random 255 characters' => [
                'odzpcshFmRyOVHAJ3U3DT8dbkr4EDISpGQHJafNMMBsECGNuhvIEDAVVVV51tduBfADjibjwYyVNcg30BJDNDgLj7Kh7bnaKKtwICeo5zywnipZ6b08a2eMqXIhJx8pl5bY0QzehhrcjxTo05QcC31muxicpoqjxJdF2LX3SeoIMOXwL5J5lCfkTDTUFLUooRSmxBC18ivVLZFqkKJJqJJK1gDCyiJv9ygpc9LcrmuhWscVT2ibqvGXDC4o',
                'b2R6cGNzaEZtUnlPVkhBSjNVM0RUOGRia3I0RURJU3BHUUhKYWZOTU1Cc0VDR051aHZJRURBVlZWVjUxdGR1QmZBRGppYmp3WXlWTmNnMzBCSkRORGdMajdLaDdibmFLS3R3SUNlbzV6eXduaXBaNmIwOGEyZU1xWEloSng4cGw1YlkwUXplaGhyY2p4VG8wNVFjQzMxbXV4aWNwb3FqeEpkRjJMWDNTZW9JTU9Yd0w1SjVsQ2ZrVERUVUZMVW9vUlNteEJDMThpdlZMWkZxa0tKSnFKSksxZ0RDeWlKdjl5Z3BjOUxjcm11aFdzY1ZUMmlicXZHWERDNG8=',
            ],
        ];
    }
}

<?php

namespace Fls\Macros\Tests;

use Fls\Macros\Macros\Collection\Oxford;
use Fls\Macros\Tests\Fixtures\DummyModel;
use Illuminate\Support\Collection;

class CollectionMacrosTest extends TestCase
{
    /** @return void */
    public function setUp(): void
    {
        parent::setUp();
        // it is disabled by default, as it requires coduo/php-humanizer
        Collection::macro('ofxord', app(Oxford::class)());
    }

    /** @test */
    public function it_will_add_oxford_comma_to_list_of_simple_values()
    {
        $values = [
            'alpha',
            'bravo',
            'charlie',
            'foxtrot',
        ];

        $result = collect($values)->ofxord(null, 3);

        $this->assertEquals('alpha, bravo, charlie, and 1 other', $result);
    }

    /** @test */
    public function it_will_add_oxford_comma_to_list_of_plucked_values()
    {
        $values = [
            new DummyModel(['name' => 'alpha']),
            new DummyModel(['name' => 'bravo']),
            new DummyModel(['name' => 'charlie']),
            new DummyModel(['name' => 'foxtrot']),
        ];

        $result = collect($values)->ofxord('name', 2);

        $this->assertEquals('alpha, bravo, and 2 others', $result);
    }

    /** @test */
    public function it_will_skip_null_value_and_add_oxford_comma_to_list_of_plucked_values()
    {
        $values = [
            null,
            new DummyModel(['name' => 'alpha']),
            null,
            new DummyModel(['name' => 'bravo']),
            null,
            new DummyModel(['name' => 'charlie']),
            null,
            new DummyModel(['name' => 'foxtrot']),
        ];

        $result = collect($values)->ofxord('name', 2);

        $this->assertEquals('alpha, bravo, and 2 others', $result);
    }
}

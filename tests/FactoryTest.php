<?php

namespace Fls\Macros\Tests;

use Fls\Macros\Tests\Fixtures\DummyModel;

class FactoryTest extends TestCase
{
    /** @test */
    public function is_will_return_a_defined_factory_with_null_values()
    {
        $factory = DummyModel::factory()->empty()->make();

        $this->assertEquals([
            'name' => null,
            'word' => null,
            'charlie' => null,
        ], $factory->toArray());
    }

    /** @test */
    public function is_will_return_a_defined_factory_with_provided_values()
    {
        $factory = DummyModel::factory()->empty('a')->make();

        $this->assertEquals([
            'name' => 'a',
            'word' => 'a',
            'charlie' => 'a',
        ], $factory->toArray());
    }
}

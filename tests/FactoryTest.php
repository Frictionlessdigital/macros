<?php

namespace Fls\Macros\Tests;

use Fls\Macros\Tests\Fixtures\DummyModel;
use PHPUnit\Framework\Attributes\Test;

class FactoryTest extends TestCase
{
    #[Test]
    public function is_will_return_a_defined_factory_with_null_values()
    {
        $factory = DummyModel::factory()->empty()->make();

        $this->assertEquals([
            'name' => null,
            'word' => null,
            'charlie' => null,
        ], $factory->toArray());
    }

    #[Test]
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

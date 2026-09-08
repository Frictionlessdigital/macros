<?php

namespace Fls\Macros\Tests;

use Fls\Macros\Macros\Collection\Oxford;
use Fls\Macros\Macros\Collection\OxfordByKey;
use Fls\Macros\Tests\Fixtures\DummyModel;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;

class CollectionMacrosTest extends TestCase
{
    /** @return void */
    protected function setUp(): void
    {
        parent::setUp();
        // These macros are disabled by default, as they require coduo/php-humanizer.
        Collection::macro('oxford', app(Oxford::class)());
        Collection::macro('oxfordByKey', app(OxfordByKey::class)());
    }

    #[Test]
    public function it_will_add_oxford_comma_to_list_of_simple_values()
    {
        $values = [
            'alpha',
            'bravo',
            'charlie',
            'foxtrot',
        ];

        $result = collect($values)->oxford(3);

        $this->assertEquals('alpha, bravo, charlie, and 1 other', $result);
    }

    #[Test]
    public function it_will_add_oxford_comma_to_list_of_plucked_values()
    {
        $values = [
            new DummyModel(['name' => 'alpha']),
            new DummyModel(['name' => 'bravo']),
            new DummyModel(['name' => 'charlie']),
            new DummyModel(['name' => 'foxtrot']),
        ];

        $result = collect($values)->oxfordByKey('name', 2);

        $this->assertEquals('alpha, bravo, and 2 others', $result);
    }

    #[Test]
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

        $result = collect($values)->oxfordByKey('name', 2);

        $this->assertEquals('alpha, bravo, and 2 others', $result);
    }

    #[Test]
    public function it_will_handle_oxfordizing_the_values_by_key(): void
    {
        $stub = collect([
            ['name' => 'Anna'],
            ['name' => null],
            ['name' => 'Poster'],
            ['name' => 'Cyrill'],
        ]);

        $this->assertEquals('Anna, and 2 others', $stub->oxfordByKey('name', 1));
        $this->assertEquals('Anna, Poster, and 1 other', $stub->oxfordByKey('name', 2));
        $this->assertEquals('Anna, Poster, and Cyrill', $stub->oxfordByKey('name', 3));
        $this->assertEquals('Anna, Poster, and Cyrill', $stub->oxfordByKey('name', 4));
    }

    #[Test]
    public function it_will_handle_oxfordizing_the_values(): void
    {
        $stub = collect(['Anna', null, 'Poster', 'Cyrill']);

        $this->assertEquals('Anna, and 2 others', $stub->oxford(1));
        $this->assertEquals('Anna, Poster, and 1 other', $stub->oxford(2));
        $this->assertEquals('Anna, Poster, and Cyrill', $stub->oxford(3));
        $this->assertEquals('Anna, Poster, and Cyrill', $stub->oxford(4));
    }
}

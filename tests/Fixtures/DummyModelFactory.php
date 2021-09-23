<?php

namespace Fls\Macros\Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\Factory;

class DummyModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DummyModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'random_value-1',
            'word' => 'random_value-2',
            'charlie' => 'random_value-3',
        ];
    }
}

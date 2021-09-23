<?php

namespace Fls\Macros\Macros\Factory;

/**
 * @mixin \Illuminate\Database\Eloquent\Factories\Factory;
 */
class EmptyFactory
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        /*
         * Get the base defintion and null every value
         *
         * @return \Illuminate\Database\Eloquent\Factories\Factory
         */
        return function () {
            $keys = array_keys($this->definition());

            return $this->state(fn (array $attributes) => array_fill_keys($keys, null));
        };
    }
}

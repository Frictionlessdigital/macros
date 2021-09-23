<?php

namespace Fls\Macros\Macros\Router;

/**
 * @mixin \Illuminate\Routing\Router;
 */
class LiveResource
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        /*
         * Register a Livewire resource.
         *
         * @param  string  $name
         * @param  string  $controller
         * @param  array  $options
         * @return \Illuminate\Routing\PendingResourceRegistration
         */
        return function ($name, $controller, array $options = []) {
            $only = ['index', 'create', 'show', 'edit'];

            if (isset($options['except'])) {
                $only = array_diff($only, (array) $options['except']);
            }

            return $this->resource($name, $controller, array_merge([
                'only' => $only,
            ], $options));
        };
    }
}

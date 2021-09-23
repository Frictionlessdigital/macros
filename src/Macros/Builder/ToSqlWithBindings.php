<?php

namespace Fls\Macros\Macros\Builder;

use Illuminate\Support\Str;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder;
 */
class ToSqlWithBindings
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        /*
         * Get Sql string populated with placeholders
         *
         * @return string
         */
        return function () {
            $bindings = array_map(
                fn ($value) => is_numeric($value) ? $value : "'{$value}'",
                $this->getBindings()
            );

            return Str::replaceArray('?', $bindings, $this->toSql());
        };
    }
}

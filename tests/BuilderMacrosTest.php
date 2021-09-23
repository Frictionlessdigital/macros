<?php

namespace Fls\Macros\Tests;

use Fls\Macros\Tests\Fixtures\DummyModel;

class BuilderMacrosTest extends TestCase
{
    /** @test */
    public function it_will_resolve_builder_to_sql_with_bindings()
    {
        $builder = DummyModel::make()->newModelQuery();

        $builder->where('ALPHA', '=', 1)->whereIn('bravo', [2, 'b'])->whereNull('charlie');

        $expected = <<<END
select * from "dummy_models" where "ALPHA" = 1 and "bravo" in (2, 'b') and "charlie" is null
END;

        $this->assertEquals($builder->toSqlWithBindings(), $expected);
    }
}

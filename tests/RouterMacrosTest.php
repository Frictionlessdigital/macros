<?php

namespace Fls\Macros\Tests;

use Fls\Macros\Tests\Fixtures\LivewireResourceController;
use Illuminate\Support\Facades\Route;

class RouterMacrosTest extends TestCase
{
    /** @test */
    public function it_will_register_livewire_resource()
    {
        Route::livewireResource('tests', LivewireResourceController::class);

        $response = $this->get('/tests');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m index', $response->getContent());

        $response = $this->get('/tests/create');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m create', $response->getContent());

        $response = $this->get('/tests/1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m show', $response->getContent());

        $response = $this->get('/tests/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m edit', $response->getContent());

        $this->assertEquals(405, $this->post('/tests')->getStatusCode());
        $this->assertEquals(405, $this->put('/tests/1')->getStatusCode());
        $this->assertEquals(405, $this->patch('/tests/1')->getStatusCode());
        $this->assertEquals(405, $this->delete('/tests/1')->getStatusCode());
    }

    /** @test */
    public function it_will_register_livewire_resource_with_only()
    {
        Route::livewireResource('tests', LivewireResourceController::class)->only(['index']);

        $response = $this->get('/tests');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m index', $response->getContent());

        $this->assertEquals(404, $this->get('/tests/create')->getStatusCode());
        $this->assertEquals(404, $this->get('/tests/1')->getStatusCode());
        $this->assertEquals(404, $this->get('/tests/1/edit')->getStatusCode());
        $this->assertEquals(405, $this->post('/tests')->getStatusCode());
        $this->assertEquals(404, $this->put('/tests/1')->getStatusCode());
        $this->assertEquals(404, $this->patch('/tests/1')->getStatusCode());
        $this->assertEquals(404, $this->delete('/tests/1')->getStatusCode());
    }

    /** @test */
    public function it_will_register_livewire_resource_with_except_as_argument()
    {
        Route::livewireResource('tests', LivewireResourceController::class, [
            'except' => ['index'],
       ]);

        $this->assertEquals(404, $this->get('/tests')->getStatusCode());

        $response = $this->get('/tests/create');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m create', $response->getContent());

        $response = $this->get('/tests/1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m show', $response->getContent());

        $response = $this->get('/tests/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('I`m edit', $response->getContent());
    }
}

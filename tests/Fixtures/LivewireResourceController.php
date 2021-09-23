<?php

namespace Fls\Macros\Tests\Fixtures;

use Illuminate\Routing\Controller;

class LivewireResourceController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        return 'I`m index';
    }

    /**
     * @return string
     */
    public function create()
    {
        return 'I`m create';
    }

    /**
     * @return string
     */
    public function show()
    {
        return 'I`m show';
    }

    /**
     * @return string
     */
    public function edit()
    {
        return 'I`m edit';
    }
}

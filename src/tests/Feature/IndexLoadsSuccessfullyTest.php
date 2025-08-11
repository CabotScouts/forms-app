<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexLoadsSuccessfullyTest extends TestCase
{

    public function test_index_loads(): void
    {
        $response = $this->get(route('root'));
        $response->assertStatus(200);
    }

}
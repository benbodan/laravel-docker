<?php

namespace App\Http\Clients\Filters\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientLastPaymentFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();
        $this->artisan('db:seed');
    }

    public function test_it_displays_all_clients()
    {
        $response = $this->get('/clients');

        $response->assertSeeText('Phill');
    }

}

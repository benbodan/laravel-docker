<?php

namespace App\Http\Clients\Filters\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Clients\Models\Client;
use App\Http\Clients\Filters\ClientPaymentFilters;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsFiltersUnitTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();
        $this->artisan('db:seed');
    }

    /**
     * @dataProvider filtersProvider
     */
    public function test_it_filters_using_range(array $input, array $expected)
    {

        $request = new Request($input);
        $filters = new ClientPaymentFilters($request);

        $result = Client::select([
            'clients.id',
            'payments.amount',
            'payments.user_id'
        ])->withLastPayment()->filter($filters)->get()->unique('user_id')->pluck('amount', 'id');

        $this->assertSame($expected, $result->toArray());
    }

    public function filtersProvider()
    {
        return [
            [
                [],
                [
                    '3' => 3000,
                    '2' => 2000,
                    '1' => 1000,
                    '4' => null
                ]
            ],
            [
                [
                    'from_date' => '2020-01-01',
                    'to_date' => '2020-01-01'
                ],
                [
                    '1' => 500
                ]
            ],
            [
                [
                    'from_date' => '2020-01-01',
                    'to_date' => '2020-01-02'
                ],
                [
                    '1' => 1000
                ]
            ],
            [
                [
                    'from_date' => '2020-01-01',
                    'to_date' => '2020-02-01'
                ],
                [
                    '2' => 1500,
                    '1' => 1000
                ]
            ],
            [
                [
                    'from_date' => '2019-12-29',
                    'to_date' => '2019-12-29'
                ],
                []
            ],
        ];
    }
}

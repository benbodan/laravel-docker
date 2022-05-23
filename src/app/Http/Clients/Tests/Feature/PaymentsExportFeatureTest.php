<?php

namespace App\Http\Clients\Filters\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Tests\TestCase;
use App\Http\Clients\Tests\Helpers\Helpers;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsExportFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setup();
        $this->artisan('db:seed');
    }


    /**
     * @dataProvider datesProvider
     */
    public function test_it_exports_last_client_payment_in_the_last_30_days(string $input, array $expected)
    {
        $this->travelTo(Carbon::parse($input));
        $path = storage_path('payments.csv');
        File::delete($path);

        $this->artisan('export:payments')->assertSuccessful();

        // It Exports a csv in storage folder
        $this->assertTrue(File::exists($path));

        $result = Helpers::csvToArray($path);

        $this->assertSame($expected, $result);
    }

    public function datesProvider()
    {
        return [
            [
                '2020-01-01',
                [
                    [
                        'Taylor',
                        'Otwell',
                        '500',
                        '2020-01-01 17:25:52'
                    ]
                ]
            ],

            [
                '2020-01-02',
                [
                    [
                        'Taylor',
                        'Otwell',
                        '1000',
                        '2020-01-02 17:25:52'
                    ]
                ]
            ],


            [
                '2020-02-01',
                [
                    [
                        'Mohamed',
                        'Said',
                        '1500',
                        '2020-02-01 17:25:52'
                    ],
                    [
                        'Taylor',
                        'Otwell',
                        '1000',
                        '2020-01-02 17:25:52'
                    ]
                ]
            ],
        ];
    }
}

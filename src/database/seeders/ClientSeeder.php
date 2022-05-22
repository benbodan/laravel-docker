<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Clients\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = [
            [
                'name' => 'Taylor',
                'surname' => 'Otwell',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00'
            ],
            [
                'name' => 'Mohamed',
                'surname' => 'Said',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00'
            ],
            [
                'name' => 'Jeffrey',
                'surname' => 'Way',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00'
            ],
            [
                'name' => 'Phill',
                'surname' => 'Sparks',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00'
            ],
        ];

        Client::insert($clients);
    }
}

<?php

namespace App\Console\Commands;

use App\Http\Clients\Filters\ClientPaymentFilters;
use App\Http\Clients\Models\Client;
use App\Http\Clients\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ExportClientPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $csv = fopen(storage_path('payments.csv'), 'w');
        fputcsv($csv, ['name', 'surname', 'amount', 'date']);


        $request = new Request([
            'from_date' =>  Carbon::now()->subDays(30)->startOfDay(),
            'to_date' => Carbon::now()->endOfDay()
        ]);

        $filters = new ClientPaymentFilters($request);

        $clientPayments = Client::withLastPayment()
            ->filter($filters)
            ->orWhere('payments.created_at', null)
            ->get();

        foreach ($clientPayments as $clientPayment) {
            fputcsv($csv, [
                $clientPayment->name,
                $clientPayment->surname,
                $clientPayment->amount,
                $clientPayment->created_at
            ]);
        }

        fclose($csv);

        return 0;
    }
}

<?php

namespace App\Http\Clients\Controllers;

use App\Http\Clients\Filters\ClientPaymentFilters;
use App\Http\Clients\Models\Client;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function index(ClientPaymentFilters $filters)
    {

        $clientsPayment =  Client::withLastPayment()
            ->select([
                'clients.id',
                'clients.name',
                'clients.surname',
                'payments.amount',
                'payments.created_at'
            ])
            ->filter($filters)
            ->orWhere('payments.created_at', null)

            ->get();

        return view('clients.clients-payments', compact('clientsPayment'));
    }
}

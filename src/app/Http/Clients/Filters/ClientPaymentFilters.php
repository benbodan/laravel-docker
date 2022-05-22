<?php

namespace App\Http\Clients\Filters;

use App\Http\Core\Filters\QueryFilters;
use Carbon\Carbon;

class ClientPaymentFilters extends QueryFilters
{

    public function to_date($to = "")
    {
        $to = Carbon::parse($to)->endOfDay();
        return $this->builder->where('payments.created_at', '<=', $to);
    }

    public function from_date($from = "")
    {
        $from = Carbon::parse($from)->startOfDay();
        return $this->builder->where('payments.created_at', '>=', $from);
    }
}

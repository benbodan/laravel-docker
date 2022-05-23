<?php

namespace App\Http\Clients\Models;

use App\Http\Core\Filters\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    use HasFilters;

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function scopeWithLastPayment($query)
    {
        $query->leftJoin('payments', 'payments.user_id', 'clients.id')->orderBy('payments.created_at','desc');
    }
}

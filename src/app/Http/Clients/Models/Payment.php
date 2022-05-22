<?php

namespace App\Http\Clients\Models;

use App\Http\Core\Filters\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use HasFilters;

    protected $fillable = [
        'amount',
        'user_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPrice extends Model
{
    use HasFactory;

    protected $fillable = ['currency_id', 'price', 'price_date'];

    public function currency() {
        
        return $this->belongsTo(Currency::class);
    }
}

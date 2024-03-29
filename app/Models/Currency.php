<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'country_id'];

    public function country() {

        return $this->belongsTo(Country::class);
    }

    public function prices() {
        
        return $this->hasMany(CurrencyPrice::class);
    }
}

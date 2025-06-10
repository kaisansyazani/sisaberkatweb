<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteType extends Model
{
    protected $fillable = ['name', 'price_per_kg'];

    public function wastes()
    {
        return $this->hasMany(Waste::class);
    }
}

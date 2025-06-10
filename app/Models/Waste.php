<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    protected $fillable = [
    'user_id',
    'waste_type_id',
    'weight',
    'price',
    'food_quality',
    'status',
    'address',
    'description',
    'image', // ✅ Make sure this is included
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'latitude', 'longitude', 'street_id'];


    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}

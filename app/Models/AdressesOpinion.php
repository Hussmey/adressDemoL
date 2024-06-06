<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdressesOpinion extends Model
{
    use HasFactory;

    protected $table = 'adresses_opinion';

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'type',
        'user_name',
        'message',
        'active',
        'reviewed', 
    ];
}

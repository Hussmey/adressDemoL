<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function postalCodes()
    {
        return $this->hasOne(PostalCode::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}



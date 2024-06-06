<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city_id', 'post_code_area_id'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function streets()
    {
        return $this->hasMany(Street::class);
    }
    public function postCodeArea()
    {
        return $this->belongsTo(PostCodeArea::class, 'post_code_area_id');
    }
    
}

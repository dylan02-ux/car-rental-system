<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    //mass assigned
    protected $fillable = ['name', 'description'];

    //category can have many cars
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
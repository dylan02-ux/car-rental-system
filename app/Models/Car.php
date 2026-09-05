<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    //mass assigning
    protected $fillable = [
        'category_id',
        'brand',
        'model',
        'year',
        'color',
        'seats',
        'daily_rate',
        'transmission',
        'image',
        'description',
        'status',
    ];

    //a car belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //car can have multiple bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    //car can have multiple reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    //calculates the average rating for a car
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
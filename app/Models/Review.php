<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    //mass assignable
    protected $fillable = [
        'user_id',
        'car_id',
        'booking_id',
        'rating',
        'comment',
    ];

    //review belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //review belongs to one car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    //review belongs to one booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
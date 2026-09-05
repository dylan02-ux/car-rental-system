<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@carrental.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        // Create Customer
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('1234'),
            'role' => 'customer',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'SUV', 'description' => 'Sport Utility Vehicles'],
            ['name' => 'Sedan', 'description' => 'Standard sedans for comfort'],
            ['name' => 'Sports', 'description' => 'High-performance sports cars'],
            ['name' => 'Luxury', 'description' => 'Premium luxury vehicles'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Cars
        $cars = [
            [
                'category_id' => 1,
                'brand' => 'Toyota',
                'model' => 'RAV4',
                'year' => 2023,
                'color' => 'White',
                'seats' => 5,
                'daily_rate' => 75.00,
                'transmission' => 'automatic',
                'description' => 'Reliable and spacious SUV perfect for family trips',
                'status' => 'available',
            ],
            [
                'category_id' => 2,
                'brand' => 'Honda',
                'model' => 'Accord',
                'year' => 2023,
                'color' => 'Black',
                'seats' => 5,
                'daily_rate' => 60.00,
                'transmission' => 'automatic',
                'description' => 'Comfortable sedan with excellent fuel economy',
                'status' => 'available',
            ],
            [
                'category_id' => 3,
                'brand' => 'BMW',
                'model' => 'M4',
                'year' => 2023,
                'color' => 'Red',
                'seats' => 4,
                'daily_rate' => 150.00,
                'transmission' => 'automatic',
                'description' => 'High-performance sports car for thrill seekers',
                'status' => 'available',
            ],
            [
                'category_id' => 4,
                'brand' => 'Mercedes-Benz',
                'model' => 'S-Class',
                'year' => 2023,
                'color' => 'Silver',
                'seats' => 5,
                'daily_rate' => 200.00,
                'transmission' => 'automatic',
                'description' => 'Ultimate luxury and comfort',
                'status' => 'available',
            ],
            [
                'category_id' => 1,
                'brand' => 'Ford',
                'model' => 'Explorer',
                'year' => 2023,
                'color' => 'Blue',
                'seats' => 7,
                'daily_rate' => 85.00,
                'transmission' => 'automatic',
                'description' => 'Spacious SUV with third-row seating',
                'status' => 'available',
            ],
            [
                'category_id' => 2,
                'brand' => 'Nissan',
                'model' => 'Altima',
                'year' => 2023,
                'color' => 'Gray',
                'seats' => 5,
                'daily_rate' => 55.00,
                'transmission' => 'automatic',
                'description' => 'Fuel-efficient and reliable sedan',
                'status' => 'available',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
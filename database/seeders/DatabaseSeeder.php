<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Testimonial;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Omar',
            'email' => 'omar@gmail.com',
            'password' => bcrypt('omar1234'),
            'is_admin' => true,
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            TestimonialSeeder::class,
        ]);

        Testimonial::factory()->createMany([
            [
                'name' => 'Sarah Johnson',
                'content' => 'The quality of the products exceeded my expectations. Shipping was fast and the customer service was excellent!'
            ],
            [
                'name' => 'Michael Chen',
                'content' => "I've ordered multiple times and never been disappointed. Great prices and even better quality."
            ],
            [
                'name' => 'Emily Rodriguez',
                'content' => 'The return process was so easy when I needed to exchange a size. Will definitely shop here again!'
            ],
        ]);
    }
}

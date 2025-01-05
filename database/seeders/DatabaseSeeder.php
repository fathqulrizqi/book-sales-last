<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use App\Models\User;
use Faker\Provider\ar_EG\Payment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        UserSeeder::class,
        AuthorSeeder::class,
        GenreSeeder::class,
        BookSeeder::class,
        PaymentMethodSeeder::class
      ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'BCA',
            'account_number' => 1234567890,
            'image' => 'bca.png'
        ]);
        PaymentMethod::create([
            'name' => 'BRI',
            'account_number' => 4567890123,
            'image' => 'bri.png'
        ]);
        PaymentMethod::create([
            'name' => 'BNI',
            'account_number' => 7890123456,
            'image' => 'bni.png'
        ]);
    }
}

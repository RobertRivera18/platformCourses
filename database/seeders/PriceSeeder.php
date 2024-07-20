<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [0, 10, 20, 25, 30, 35];
        foreach ($prices as $price) {
            Price::create([
                'value' => $price,
            ]);
        }
    }
}

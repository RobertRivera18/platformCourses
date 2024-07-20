<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Principiante',
            'Intermedio',
            'Avanzado'
        ];
        foreach ($levels as $level) {
            Level::create([
                'name' => $level,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClickCounter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo một bản ghi mới trong bảng ClickCounter với giá trị mặc định là 0 cho current_click
        ClickCounter::create([
            'current_click' => 0
        ]);
    }
}

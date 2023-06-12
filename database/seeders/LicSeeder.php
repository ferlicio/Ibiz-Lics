<?php

namespace Database\Seeders;

use App\Models\Lic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lic::factory()->count(100)->create();
        //
    }
}

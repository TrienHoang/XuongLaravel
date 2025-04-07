<?php

namespace Database\Seeders;

use App\Models\AlbumProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlbumProduct::factory(5)->create();
    }
}
